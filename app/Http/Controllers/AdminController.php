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
            'js' => [

            ]
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
            'js' => [

            ]
        ];
        $param = \Input::all();
        $validator = \Validator::make($param, \Validation::get_rules("admin", "login"));
        if ($validator->fails()) {
            $messages = $validator->messages();
            $error = $messages->all();

            // return redirect()->to("admin/login")->withErrors('Wrong User Id or Password.');
            return view('admin.login', $view_data)->withErrors($validator);
        }
        $res = \App\Models\Admin\Admin::do_login($param);

        if ($res['flag'] == 0) {
            // return redirect()->to("admin/login")->withErrors('Wrong User Id or Password.');
            return view('admin.login', $view_data)->withErrors('Wrong User Id or Password.');
        } elseif ($res['flag'] == 4) {
            // return redirect()->to("admin/login")->withErrors('Your Account is not active currently.');
            return view('admin.login', $view_data)->withErrors('Your Account is not active currently.');
        } elseif ($res['flag'] == 5) {
            // return redirect()->to("admin/login")->withErrors('Your Account is not Approved yet.');
            return view('admin.login', $view_data)->withErrors('Your Account is not Approved yet.');
        } elseif ($res['flag'] == 6) {
            // return redirect()->to("admin/login")->withErrors('Your Account is Suspended.');
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
}
