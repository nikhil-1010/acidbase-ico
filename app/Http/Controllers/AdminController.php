<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\StudentExport;
use App\Exports\ReportExport;
use App\Imports\RestaurantImport;
use App\Imports\SaloonImport;
use App\Models\User\Transaction;
use Maatwebsite\Excel\Facades\Excel;


class AdminController extends Controller
{

    private static $bypass_url = ['getLogin', 'postLogin', 'getForgotPassword','postForgotPassword','getResetPassword','postResetPassword','getLogout', 'getMaintenance'];

    public function __construct()
    {
        $this->middleware('AdminAuth', ['except' => self::$bypass_url]);
    }
    public function getMaintenance()
    {
        $settings = app('settings');
        if ($settings['maintenance_mode'] != 1) {
            return redirect('/');
            // return view('undermaintenance');
        } else {
            return view('site.undermaintenance');
        }
    }
    public function getLogin($sec_token = "")
    {
        $s = app('settings');

        if ($sec_token != $s['admin_login_url_token']) {
            return \Redirect::to("/");
        }
        // dd(\Auth::guard("admin")->check());
        if (\Auth::guard("admin")->check()) {
            return \Redirect::to("admin/dashboard");
        }
        $view_data = [
            'header' => [
                "title" => 'Login | Admin Panel ',
            ],
            'body' => [
                'title' => 'login',
            ],
            'js' => []
        ];
        return view('admin.login', $view_data);
    }
    public function postLogin()
    {
        $view_data = [
            'header' => [
                "title" => 'Login | Admin Panel ',
            ],
            'body' => [
                'title' => 'login',
            ],
            'js' => []
        ];
        $param = \Input::all();
        $validator = \Validator::make($param, \Validation::get_rules("admin", "login"));
        if ($validator->fails()) {
            $messages = $validator->messages();
            $error = $messages->all();

            return view('admin.login', $view_data)->withErrors($validator);
        }
        $res = \App\Models\Admin\Admin::do_login($param);

        if ($res['flag'] == 0) {
            return view('admin.login', $view_data)->withErrors('Wrong User Id or Password.');
        } elseif ($res['flag'] == 4) {
            return view('admin.login', $view_data)->withErrors('Your Account is not active currently.');
        } elseif ($res['flag'] == 5) {
            return view('admin.login', $view_data)->withErrors('Your Account is not Approved yet.');
        } elseif ($res['flag'] == 6) {
            return view('admin.login', $view_data)->withErrors('Your Account is Suspended.');
        }

        return \Redirect::to("admin/dashboard");
    }
    public function getForgotPassword()
    {
        $view_data = [
            'header' => [
                "title" => 'Forgot Password | Admin Panel ',
            ],
            'body' => [
                'title' => 'Forgot Password',
            ],
            'js' => []
        ];
        return view('admin.forgot_password', $view_data);
    }
    public function postForgotPassword()
    {
        $view_data = [
            'header' => [
                "title" => 'Forgot Password | Admin Panel ',
            ],
            'body' => [
                'title' => 'Forgot Password',
            ],
            'js' => []
        ];
        $param = \Input::all();
        $validator = \Validator::make($param, \Validation::get_rules("admin", "forgot_password"));
        if ($validator->fails()) {
            $messages = $validator->messages();
            $error = $messages->all();
            return view('admin.forgot_password', $view_data)->withErrors($validator);
        }
        $forgotpass_token = \App\Lib\General::generateResetPasswordKey();
        $user = \App\Models\Admin\Admin::where('email', $param['email'])->first();
        if(!is_null($user)){
            $user_detail = $user->toArray();
            $user_detail['forgotpass_token'] = $forgotpass_token;
            $user_detail['mail_subject'] = 'Forgot Password';
            $user_detail['mail_from_email'] = config('constant.SYSTEM_EMAIL');
            $user_detail['mail_from_name'] = config('constant.SYSTEM_EMAIL_NAME');
            $user_detail['to_email'] = $param['email'];
            $user_detail['name'] =  $user_detail['username'];
            $user->remember_token = $forgotpass_token;
            $user->save();
            \Mail::send('emails.forget_password', $user_detail, function ($message) use ($user_detail) {
                $message->from($user_detail['mail_from_email'], $user_detail['mail_from_name'])->to($user_detail['email'])->subject($user_detail['mail_subject']);
            });
        }
        return view('admin.forgot_password', $view_data)->withSuccess('We send forgot password link to your submitted email address.');
    }
    public function getResetPassword($token)
    {

        $user = \App\Models\Admin\Admin::get_by_pass_token($token);
        if(empty($user)){
            return \Response::view('errors.404', array('msg'=>'This Link is Expired!'), 404); 
        }
        $view_data = [
            'header' => [
                "title" => "Reset Password | Admin Panel",
                "desc"=>"",
                "js"    => [],
                "css"   => []
            ],
            'body' => [
                'title' => 'Reset Password',
                'token' => $token,
            ],
            "footer" => [
                'js' => []
            ]
        ];
        return view('admin.reset_password', $view_data);
    }
    public function postResetPassword()
    {
        $param = \Input::all();
        $validator = \Validator::make($param, \Validation::get_rules("admin", "reset_password"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        $user= \App\Models\Admin\Admin::get_by_pass_token($param['pass_token']);
        if(empty ($user)){
            return \General::error_res("Oops something went wrong !!!");
        }
        $hashPass = \Hash::make($param['confirm_password']);
        $user = \App\Models\Admin\Admin::where("remember_token",$param['pass_token'])->first();
        $user->password = $hashPass;
        $user->remember_token = "";
        if($user->save()){
            return \General::success_res('Your password reset successfully.');
        }else{
           return \General::error_res("Oops something went wrong !!!"); 
        }
    }
    public function getLogout()
    {
        \Auth::guard('admin')->logout();
        $s = app('settings');
        return redirect("admin/login/" . $s['admin_login_url_token']);
    }
    public function getDashboard()
    {
        $seed_balance=0;
        $private_balance=0;
        $public_balance=0;

        try {
            $response = \Http::post(env('NODE_URL').'/get-contract-balance');
            if($response['flag'] == 1) {
                $response = json_decode($response,true);
                $balance = $response['data'];
                $seed_balance = $balance['seed_balance'];
                $private_balance = $balance['private_balance'];
                $public_balance = $balance['public_balance'];
            }
        } catch (\Exception $e) {
            \Log::info('get-contract-balance Error');
            \Log::info($e->getMessage());
            // return \General::error_res("Something went to wrong");
        }
        $trx = \App\Models\User\Transaction::count();
        $view_data = [
            'header' => [
                "title" => 'Dashboard | Admin Panel ',
            ],
            'body' => [
                'id'    => 'dashboard',
                'label' => 'Dashboard',
                'header_title' => 'Dashboard',
                'transaction' => $trx,
                'seed_balance' => number_format($seed_balance,8,'.',''),
                'private_balance' => number_format($private_balance,8,'.',''),
                'public_balance' => number_format($public_balance,8,'.',''),
            ],
        ];
        return view('admin.dashboard', $view_data);
    }
    public function getWhitelistAccount()
    {
        $view_data = [
            'header' => [
                "title" => 'Whitelist Account | Admin Panel ',
            ],
            'body' => [
                'id'    => 'whitelist',
                'label' => 'Whitelist',
                'header_title' => 'Whitelist Account',
            ],
            "footer" => [
                'js' => ['admin/whitelist.min.js']
            ]
        ];
        return view('admin.whitelist', $view_data);
    }
    public function postWhitelistFilter()
    {
        $param = \Input::all();
        $data = \App\Models\User\Whitelist::filter($param);
        $res = \General::success_res();
        $res['blade'] = view("admin.whitelist_filter", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }
    public function getTransaction()
    {
        $view_data = [
            'header' => [
                "title" => 'Transaction | Admin Panel ',
            ],
            'body' => [
                'id'    => 'transaction',
                'label' => 'Transaction',
                'header_title' => 'Transaction',
            ],
            "footer" => [
                'js' => ['admin/transaction.min.js']
            ]
        ];
        return view('admin.transaction', $view_data);
    }
    public function postTransactionFilter()
    {
        $param = \Input::all();
        $data = \App\Models\User\Transaction::filter($param);
        $res = \General::success_res();
        $res['blade'] = view("admin.transaction_filter", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }
    public function getFaq()
    {
        $view_data = [
            'header' => [
                "title" => 'Faq | Admin Panel ',
            ],
            'body' => [
                'id'    => 'faq',
                'label' => 'Faq',
                'header_title' => 'Faq',
            ],
            "footer" => [
                'js' => ['admin/faq.min.js']
            ]
        ];
        return view('admin.faq', $view_data);
    }
    public function postAddFaq()
    {
        $param = \Input::all();

        $validator = \Validator::make(\Input::all(), \Validation::get_rules("admin", "add_faq"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }

        if(isset($param['update_id']) && $param['update_id'] != ''){
            return \App\Models\Admin\Faq::updateFaq($param);
        }else{
            return \App\Models\Admin\Faq::addFaq($param);
        }

    }
    public function postFaqFilter()
    {
        $param = \Input::all();
        $data = \App\Models\Admin\Faq::filter($param);
        $res = \General::success_res();
        $res['blade'] = view("admin.faq_filter", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }
    public function postContactFilter()
    {
        $param = \Input::all();
        $data = \App\Models\User\ContactUs::filter($param);
        $res = \General::success_res();
        $res['blade'] = view("admin.contact_filter", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }
    public function getProfile()
    {
        $view_data = [
            'header' => [
                "title" => 'Profile | Admin Panel ',
            ],
            'body' => [
                'id'    => 'profile',
                'label' => 'Profile',
                'header_title' => 'Profile',
            ],
            "footer" => [
                'js' => ['admin/profile.min.js']
            ]
        ];
        return view('admin.profile', $view_data);
    }
    public function getContacts()
    {
        $view_data = [
            'header' => [
                "title" => 'Contact | Admin Panel ',
            ],
            'body' => [
                'id'    => 'contact',
                'label' => 'Contact',
                'header_title' => 'Contact',
            ],
            "footer" => [
                'js' => ['admin/contact_us.min.js']
            ]
        ];
        return view('admin.contact', $view_data);
    }
    public function getSiteContent()
    {
        $view_data = [
            'header' => [
                "title" => 'Site Content | Admin Panel ',
            ],
            'body' => [
                'id'    => 'site_content',
                'label' => 'Site Content',
                'header_title' => 'Site Content',
            ],
            "footer" => [
                'js' => ["ckeditor/ckeditor.js",'admin/site_content.min.js']
            ]
        ];
        return view('admin.site_content', $view_data);
    }
    public function getSettings()
    {
        $setting = app('settings');
        $view_data = [
            'header' => [
                "title" => 'Setting | Admin Panel ',
            ],
            'body' => [
                'id'    => 'setting',
                'label' => 'Setting',
                'header_title' => 'Profile',
                'setting'=>$setting
            ],
            "footer" => [
                'js' => ['admin/setting.min.js']
            ]
        ];
        return view('admin.setting', $view_data);
    }
    public function postSaveSettings()
    {
        $param = \Input::all();
        // dd($param);
        $rule = array(
            'setting_type' => 'required|in:general,password,advance,credentials'
        );
        $validator = \Validator::make($param, $rule);
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }
        $setting_type = $param['setting_type'];
        if ($setting_type == 'general') {
            $res = \App\Models\Admin\Settings::edit_general_settings($param);
        } else if ($setting_type == 'credentials') {
            $res = \App\Models\Admin\Settings::set_config($param);
        } else if ($setting_type == 'password') {
            $validator = \Validator::make(\Input::all(), \Validation::get_rules("admin", "change_admin_password"));
            if ($validator->fails()) {
                $err_msg = $validator->errors()->first();
                return \General::error_res($err_msg);
            }
            $res = \App\Models\Admin\Admin::change_admin_password($param);
        }
        return $res;
    }
    public function postChangePassword()
    {
        $param = \Input::all();
        // dd($param);
        $validator = \Validator::make(\Input::all(), \Validation::get_rules("admin", "change_admin_password"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }

        $res = \App\Models\Admin\Admin::change_admin_password($param);

        return $res;
    }
    public function postChangeMaintenanceMode()
    {
        $param = \Input::all();
        $setting = \App\Models\Admin\Settings::where('name','maintenance_mode')->first();
        $setting->val = $param['maintenance_mode'];
        $setting->save();
        return \General::success_res('Change maintenance mode successfully.');
    }
    public function postGetContent()
    {
        $param = \Input::all();
        return \App\Models\Admin\SiteContent::getContent($param);
    }
    public function postSetContent()
    {
        $param = \Input::all();
        return \App\Models\Admin\SiteContent::setContent($param);
    }
    public function postUpdateProfile()
    {
        $param = \Input::all();
        // dd($param);
        $validator = \Validator::make(\Input::all(), \Validation::get_rules("admin", "update_profile"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }

        $res = \App\Models\Admin\Admin::updateProfile($param);

        return $res;
    }
}
