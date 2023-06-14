<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('settings', function($app)
        {
            $settings = \App\Models\Admin\Settings::where("autoload",1)->get();
            $set = [];
            foreach ($settings as $val)
            {
                $set[$val['name']] = $val['val'];
            }
            return $set;
        });

        $this->app->singleton('platform', function($app)
        {
            // $ua = \Request::server("HTTP_USER_AGENT");
            $ua =\Request::header('UserAgent');
            \Log::info("User Agent :- ".$ua);
            if(strpos($ua, "android") !== FALSE)
            {
                return \Config::get("constant.ANDROID_APP_DEVICE");
            }
            else if(strpos($ua, "iPhone") !== FALSE)
            {
                return \Config::get("constant.IPHONE_APP_DEVICE");
            }
            else
            {
                if (env('APP_ENV','local') == 'local' && strpos($ua, "Postman") !== FALSE) {
                    $url = request()->path();
                    $segment = request()->segment(1);
                    if ($segment == 'api') {
                        return \Config::get("constant.ANDROID_APP_DEVICE");   
                    }    
                }
                return \Config::get("constant.WEB_DEVICE");
            }
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
