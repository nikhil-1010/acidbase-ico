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

    public function postTest(){
        $obj = new \App\Models\Admin\Settings;
        $obj->name = 'exchange_rate';
        $obj->val = 0.0001;
        $obj->save();
    }
}
