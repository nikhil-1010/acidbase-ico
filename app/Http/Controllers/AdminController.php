<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\StudentExport;
use App\Exports\ReportExport;
use App\Imports\RestaurantImport;
use App\Imports\SaloonImport;

use Maatwebsite\Excel\Facades\Excel;


class AdminController extends Controller
{

    private static $bypass_url = ['getLogin', 'postLogin', 'getLogout', 'getMaintenance'];

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
            return view('undermaintenance');
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
    public function getLogout()
    {
        \Auth::guard('admin')->logout();
        $s = app('settings');
        return redirect("admin/login/" . $s['admin_login_url_token']);
    }
    public function getDashboard()
    {
        $view_data = [
            'header' => [
                "title" => 'Dashboard | Admin Panel ',
            ],
            'body' => [
                'id'    => 'dashboard',
                'label' => 'Dashboard',
                'header_title' => 'Dashboard',
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
