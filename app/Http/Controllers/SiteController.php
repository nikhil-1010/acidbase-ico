<?php

namespace App\Http\Controllers;

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

}