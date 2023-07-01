<?php

namespace App\Http\Controllers;

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
        $view_data = [
            "header" => [
                'title'=>'Home | '.self::$platform
            ],
            "body" => [
                'id' => 'home',
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
            return \App\Models\User\Transaction::addTransactionHistory($param);
        }else{
            $data->status = 1;
            $data->save();
            return \General::success_res('update transaction.');
        }
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
        
        return \General::success_res('last update block is '.$response['data']['last_block']);
    }

    public function postTest(){
        $obj = new \App\Models\Admin\Settings;
        $obj->name = 'last_block';
        $obj->val = 0.0001;
        $obj->autoload = 3801954;
        $obj->save();
    }
}
