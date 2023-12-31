<?php

namespace App\Http\Controllers;

use App\Models\Admin\Faq;
use App\Models\Admin\Settings;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    static $platform =  "";
    public function __construct()
    {
        self::$platform = config('constant.PLATFORM_NAME');
        $this->middleware('maintenance');
    }
    public function getHome()
    {
        $faq = Faq::orderBy('sort_order','asc')->get()->toArray();
        $view_data = [
            "header" => [
                'title'=>'Home | '.self::$platform
            ],
            "body" => [
                'id' => 'home',
                'faq'=>$faq
            ],
            "footer" => [
                'js' => ['home.min.js']
            ]
        ];

        return view("site.home", $view_data);
    }
    public function getPortfolio()
    {
        $view_data = [
            "header" => [
                'title'=>'Portfolio | '.self::$platform
            ],
            "body" => [
                'id' => 'portfolio',
            ],
            "footer" => [
                'js' => ['web3.min.js','portfolio.min.js']
            ]
        ];

        return view("site.portfolio", $view_data);
    }
    public function getContactUs()
    {
        $view_data = [
            "header" => [
                'title'=>'Contact Us | '.self::$platform
            ],
            "body" => [
                'id' => 'contact_us',
            ],
            "footer" => [
                'js' => ['contact_us.min.js']
            ]
        ];

        return view("site.contact-us", $view_data);
    }
    public function getAbout()
    {
        $param['name'] = 'about_us';
        $about = \App\Models\Admin\SiteContent::getContent($param);
        $view_data = [
            "header" => [
                'title'=>'About Us | '.self::$platform
            ],
            "body" => [
                'id' => 'about_us',
                'about' => $about,
            ],
            "footer" => [
                'js' => ['home.min.js']
            ]
        ];
        
        return view("site.about_us", $view_data);
    }
    public function getPrivacyPolicy()
    {
        $param['name'] = 'privacy_policy';
        $privacy_policy = \App\Models\Admin\SiteContent::getContent($param);
        $view_data = [
            "header" => [
                'title'=>'Privacy Policy | '.self::$platform
            ],
            "body" => [
                'id' => 'privacy_policy',
                'privacy_policy' => $privacy_policy,
            ],
            "footer" => [
                'js' => ['home.min.js']
            ]
        ];
        
        return view("site.privacy_policy", $view_data);
    }
    public function getTermsCondition()
    {
        $param['name'] = 'terms';
        $terms = \App\Models\Admin\SiteContent::getContent($param);
        $view_data = [
            "header" => [
                'title'=>'Terms & Condition | '.self::$platform
            ],
            "body" => [
                'id' => 'terms',
                'terms' => $terms,
            ],
            "footer" => [
                'js' => ['home.min.js']
            ]
        ];
        
        return view("site.terms", $view_data);
    }
    public function getTransactionNotify()
    {
        $view_data = [
            "header" => [
                'title'=>'Portfolio | '.self::$platform
            ],
            "body" => [
                'id' => 'portfolio',
            ],
            "footer" => [
                'js' => ['web3.min.js','portfolio.min.js']
            ]
        ];

        return view("site.portfolio", $view_data);
    }
    public function postAddTransaction(){
        $param = \Input::all();
        $res = \App\Models\User\Transaction::addTransactionHistory($param);
        return $res;
    }
    public function postSeedTransactionFilter(){
        $param = \Input::all();
        $param['sale_type'] = config('constant.SALE_TYPE.SEED');
        $data = \App\Models\User\Transaction::filter($param);
        $res['blade'] = view("site.seed_transaction_history", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }
    public function postPrivateTransactionFilter(){
        $param = \Input::all();
        
        $param['sale_type'] = config('constant.SALE_TYPE.PRIVATE');
        $data = \App\Models\User\Transaction::filter($param);
        $res['blade'] = view("site.private_transaction_history", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }
    public function postPublicTransactionFilter(){
        $param = \Input::all();
        
        $param['sale_type'] = config('constant.SALE_TYPE.PUBLIC');
        $data = \App\Models\User\Transaction::filter($param);
        $res['blade'] = view("site.public_transaction_history", $data)->render();
        $res['total_record'] = $data['total_record'];
        return $res;
    }
    public function postAddWhitelist(){
        $param = \Input::all();
        
        return \App\Models\User\Whitelist::addWhitelist($param);
    }
    public function postCheckWhitelist(){
        $param = \Input::all();
        
        $data = \App\Models\User\Whitelist::where('address',$param['address'])->where('sale_type',$param['sale_type'])->first();
        if(is_null($data)){
            return \General::error_res('not whitelisted.');
        }else{
            return \General::success_res('whitelisted.');
        }
    }
    
    public function postAddInvestorEvent(){
        $param = \Input::all();
        
        $data = \App\Models\User\Transaction::where('trx_id',$param['trx_id'])->first();
        if(is_null($data)){
            $data = array(
                "trx_id"=>$param['trx_id'],
                "investor_address"=>$param['investor'],
                "paid_amount"=>$param['payin_amount'],
                "token_amount"=>$param['payout_amount'],
                "sale_type"=>$param['sale_type'],
                "status"=>1
            );
            return \App\Models\User\Transaction::addTransactionHistory($data);
        }else{
            $data->status = 1;
            $data->save();
            return \General::success_res('update transaction.');
        }
    }
    public function postContact(){
        $param = \Input::all();
        
        $validator = \Validator::make(\Input::all(), \Validation::get_rules("site", "contactus"));
        if ($validator->fails()) {
            $err_msg = $validator->errors()->first();
            return \General::error_res($err_msg);
        }

        return \App\Models\User\ContactUs::addContact($param);
        
    }
    public function postUpdateBlockNumber(){
        $param = \Input::all();
        
        $data = \App\Models\Admin\Settings::where('name','last_block')->first();
        $data->last_block = $param['last_block'];
        $data->save();
        \Log::info('Last updated Block is => '.$param['last_block']);
        return \General::success_res();
    }

    public function getPastEvents(){

        $last_block = app('settings')['last_block'];
        try {
            $response = \Http::post(env('NODE_URL').'/get-past-event', [
                'last_block' => $last_block
            ]);
            
        } catch (\Exception $e) {
            \Log::info('check-buy-token Error');
            \Log::info($e->getMessage());
            return \General::error_res("Something went to wrong");
        }
        if($response['flag'] != 1) {
            return \General::error_res("Something went to wrong!!");
        }
        
        $obj = \App\Models\Admin\Settings::where('name','last_block')->first();
        $obj->val = $response['data']['last_block'];
        $obj->save();
        \Log::info('last update block is '.$response['data']['last_block']);
        return \General::success_res('last update block is '.$response['data']['last_block']);
    }

    public function postTest(){
        // $obj = new \App\Models\Admin\Settings;
        // $obj->name = 'admin_login_url_token';
        // $obj->val = 'ico';
        // $obj->autoload = 1;
        // $obj->save();
        // $obj = new \App\Models\Admin\Settings;
        // $obj->name = 'exchange_rate';
        // $obj->val = '0.0001';
        // $obj->autoload = 1;
        // $obj->save();
        // $obj = new \App\Models\Admin\Settings;
        // $obj->name = 'maintenance_mode';
        // $obj->val = '0';
        // $obj->autoload = 1;
        // $obj->save();
        // $obj = new \App\Models\Admin\Settings;
        // $obj->name = 'last_block';
        // $obj->val = '3808836';
        // $obj->autoload = 1;
        // $obj->save();
        // $obj = new \App\Models\Admin\Admin;
        // $obj->email = 'a@a.com';
        // $obj->mobile = '1234569870';
        // $obj->password = \Hash::make('123456');
        // $obj->username = 'admin';
        // $obj->status = 1;
        // $obj->avatar = '';
        // $obj->save();
        $obj = new \App\Models\Admin\SiteContent;
        $obj->name = 'about_us';
        $obj->content = '';
        $obj->save();
        $obj = new \App\Models\Admin\SiteContent;
        $obj->name = 'terms';
        $obj->content = '';
        $obj->save();
        $obj = new \App\Models\Admin\SiteContent;
        $obj->name = 'privacy_policy';
        $obj->content = '';
        $obj->save();
    }
}
