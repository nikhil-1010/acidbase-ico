<?php

namespace App\Lib;

use \Mycrypt;
use PragmaRX\Google2FA\Google2FA as Google2FA;
use Twilio\Rest\Client;

class General
{

    static function error_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "error" : $msg;
        $msg_id = 'error.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg = $msg_id == $converted ? $msg : $converted;
        $json = array('flag' => 0, 'msg' => $msg);
        return $json;
    }

    static function success_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "success" : $msg;
        $msg_id = 'success.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg = $msg_id == $converted ? $msg : $converted;
        $json = array('flag' => 1, 'msg' => $msg);
        return $json;
    }

    static function validation_error_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "validation error" : $msg;
        $msg_id = 'error.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg = $msg_id == $converted ? $msg : $converted;
        $json = array('flag' => 2, 'msg' => $msg);
        return $json;
    }

    static function info_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "information" : $msg;
        $msg_id = 'info.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg = $msg_id == $converted ? $msg : $converted;
        $json = array('flag' => 3, 'msg' => $msg);
        return $json;
    }

    static function email_verify_error_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "Your account is not active. Please verify your email address" : $msg;
        $msg_id = 'error.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg = $msg_id == $converted ? $msg : $converted;
        $json = array('flag' => 4, 'msg' => $msg);
        return $json;
    }

    static function mobile_verify_error_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "mobile_not_verified" : $msg;
        $msg_id = 'error.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg = $msg_id == $converted ? $msg : $converted;
        $json = array('flag' => 4, 'msg' => $msg);
        return $json;
    }

    static function maintenance_mode_error_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "maintenance_mode_on" : $msg;
        $msg_id = 'error.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg = $msg_id == $converted ? $msg : $converted;
        $json = array('flag' => 5, 'msg' => $msg);
        return $json;
    }

    static function request_token_expire_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "Request token invalid" : $msg;
        $msg_id = 'error.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg = $msg_id == $converted ? $msg : $converted;
        $json = array('flag' => 7, 'msg' => $msg);
        return $json;
    }

    static function session_expire_res($msg = "", $args = array())
    {
        $msg = $msg == "" ? "Session Expired" : $msg;
        $msg_id = 'error.' . $msg;
        $converted = \Lang::get($msg_id, $args);
        $msg = $msg_id == $converted ? $msg : $converted;
        $json = array('flag' => 8, 'msg' => $msg);
        return $json;
    }

    static function _url($str)
    {
        if (is_string($str))
            return preg_match("/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/", $str) ? TRUE : FALSE;
        return FALSE;
    }

    static function dd($data, $exit = 0)
    {
        if (in_array(\App::environment(), array("production")))
            return;
        if (is_array($data) || is_object($data)) {
            echo "<pre>";
            print_r($data);
            echo "</pre>";
        } else {
            echo $data . "<br>";
        }
        if ($exit == 1)
            exit;
    }

    static function rand_str($len)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-.';
        $randomString = '';
        for ($i = 0; $i < $len; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    static function MongoDate($date_str = "")
    {
        $date_str = $date_str == "" ? date("Y-m-d H:i:s") : $date_str;
        $time = strtotime($date_str) * 1000;
        $date = date("Y-m-d H:i:s",  $time);
        if (class_exists('\MongoDate')) {
            $date = new \MongoDate($time);
        } else if (class_exists('\MongoDB\BSON\UTCDateTime')) {
            $date = new \MongoDB\BSON\UTCDateTime($time);
        }
        return $date;
    }
    static function mongoDateToDate($object = false)
    {
        if (method_exists($object, "__toString")) {
            return date('Y-m-d H:i:s', $object->__toString() / 1000);
        } else {
            return false;
        }
    }

    static function is_json($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    static function get_external_ip()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://ipinfo.io");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($ch);
        curl_close($ch);
        if (\General::is_json($result)) {
            $arr = json_decode($result, true);
            return $arr['ip'];
        }
        return "";
    }

    static function file_get_content_curl($url)
    {
        // Throw Error if the curl function does'nt exist.
        if (!function_exists('curl_init')) {
            die('CURL is not installed!');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    static function number_format($number, $dec = 3)
    {
        return number_format($number / 1000, $dec, ".", "");
    }

    static function google_authenticate($user, $param)
    {
        $custome_msg = [
            'totp.required'   => 'Please Fill OTP',
            'totp.digits'   => 'OTP must 6 digits',
        ];

        $rule = [
            'totp' => 'bail|required|digits:6',
        ];

        $validator = \Validator::make(\Input::all(), $rule, $custome_msg);
        if ($validator->fails()) {
            if (!isset($param['enbdis'])) {
                \App\Models\Token::delete_token();
                \Auth::guard('merchant')->logout();
            }

            $messages = $validator->messages();
            $error = $messages->all();

            $res = \General::validation_error_res($error[0]);
            $res['data'] = $error;
            return $res;
        }

        $key = $user['id'] . ':' . $param['totp'];
        $exist = \Cache::has($key);
        if ($exist) {
            if (!isset($param['enbdis'])) {
                \App\Models\Token::delete_token();
                \Auth::guard('merchant')->logout();
            }
            return \General::error_res('OTP is expired.');
        }

        $secret = \Crypt::decrypt($user['google2fa_secret']);
        // $google2fa = new Google2FA();
        $verify =   \Google2FA::verifyKey($secret, $param['totp']);
        \General::log('2fa verification : ' .  json_encode($verify));
        if (!$verify) {
            if (!isset($param['enbdis'])) {
                \App\Models\Token::delete_token();
                \Auth::guard('merchant')->logout();
            }
            return \General::error_res('OTP is incorrect.');
        }
        $key    = $user['id'] . ':' . $param['totp'];

        //use cache to store token to blacklist
        \Cache::add($key, true, 4);

        return \General::success_res();
    }

    public static function post_curl($url, $param)
    {
        $data = '';
        foreach ($param as $k => $v) {
            $data .= $k . '=' . $v . '&';
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            $data
        );
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    static function commonData($param, $type)
    {

        if ($param == 'name' && $type == 'admin') {
            $user = \Auth::guard('admin')->user()->toArray();
            return  $user['username'];
        }
        if ($param == 'name' && $type == 'user') {
            $user = \Auth::guard('merchant')->user()->toArray();
            return  $user['name'];
        }
        return;
    }
    static function rand_key($len)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $len; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    static function generateAppKey()
    {
        $app_id = 'live_' . self::rand_key(10);
        $chk = \App\Models\Application::where('app_id', $app_id)->first();
        while (!is_null($chk)) {
            $app_id = 'live_' . self::rand_key(10);
            $chk = \App\Models\Application::where('app_id', $app_id)->first();
        }

        $app = array('app_id' => $app_id);
        return $app;
    }
    static function generateResetPasswordKey()
    {
        $key = self::rand_key(20);
        $chk = \App\Models\Admin\Admin::where('remember_token', $key)->first();
        while (!is_null($chk)) {
            $key = self::rand_key(20);
            $chk = \App\Models\Admin\Admin::where('remember_token', $key)->first();
        }

        return $key;
    }
    static function ip2location($ip)
    {
        $url = 'http://www.geoplugin.net/json.gp?ip=' . $ip;
        //        $url = 'https://www.geoip-db.com/json/'; 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));

        $output = curl_exec($ch);
        curl_close($ch);

        $location = $output;
        $location = json_decode($output, true);
        // dd($location);
        $data = [];
        if ($location['geoplugin_status'] != 404) {
            $data = [
                'country_name' => $location['geoplugin_countryName'],
                'country_code' => $location['geoplugin_countryCode'],
                "city" => $location['geoplugin_city'],
                "region" => $location['geoplugin_region'],
                'lat' => $location['geoplugin_latitude'],
                'long' => $location['geoplugin_longitude'],
            ];
            $res = \General::success_res();
            $res['data'] = $data;
        } else {
            $data = [
                'country_name' => 'Not Found',
            ];
            $res = \General::error_res();
            $res['data'] = $data;
        }

        return $res;
    }

    static function  resize_n_copy_image($file, $w, $h, $tofile, $crop = FALSE)
    {
        $status = false;

        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width - ($width * abs($r - $w / $h)));
            } else {
                $height = ceil($height - ($height * abs($r - $w / $h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w / $h > $r) {
                $newwidth = $h * $r;
                $newheight = $h;
            } else {
                $newheight = $w / $r;
                $newwidth = $w;
            }
        }
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if ($ext == "gd") {
            $src = imagecreatefromgd($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $status = imagegd($dst, $tofile);
        } elseif ($ext == "gif") {
            $src = imagecreatefromgif($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $status = imagegif($dst, $tofile);
        } elseif ($ext == "bmp") {
            $src = imagecreatefrombmp($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $status = imagebmp($dst, $tofile);
        } elseif ($ext == "png") {
            $src = imagecreatefrompng($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $status = imagepng($dst, $tofile);
        } elseif ($ext == "gd2") {
            $src = imagecreatefromgd2($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $status = imagegd2($dst, $tofile);
        } elseif ($ext == "xbm") {
            $src = imagecreatefromxbm($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $status = imagexbm($dst, $tofile);
        } elseif ($ext == "vnd.wap.wbmp" || $ext == "wbmp") {
            $src = imagecreatefromwbmp($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $status = imagewbmp($dst, $tofile);
        } elseif ($ext == "webp") {
            $src = imagecreatefromwebp($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $status = imagewebp($dst, $tofile);
        } else {
            $src = imagecreatefromjpeg($file);
            $dst = imagecreatetruecolor($newwidth, $newheight);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $status = imagejpeg($dst, $tofile);
        }
        return $status;
    }
    static function is_api_url()
    {
        $path = request()->path();
        $exp_path = explode("/", $path);

        if (isset($exp_path[0]) && $exp_path[0] == "api") {
            return true;
        } else {
            return false;
        }
    }

    static function secondsToTime($seconds)
    {
        $return = [
            'year' => 0,
            'month' => 0,
            'days' => 0,
            'hours' => 0,
            'minutes' => 0,
            'seconds' => 0,
        ];
        $dtF = new \DateTime('@0');
        $dtT = new \DateTime("@$seconds");
        $return['year'] = (int)$dtF->diff($dtT)->format('%y');
        $return['month'] = (int)$dtF->diff($dtT)->format('%m');
        $return['day'] = (int)$dtF->diff($dtT)->format('%d');
        $return['hour'] = (int)$dtF->diff($dtT)->format('%h');
        $return['minute'] = (int)$dtF->diff($dtT)->format('%i');
        $return['second'] = (int)$dtF->diff($dtT)->format('%s');
        return $return;
    }
    static function get_codecard_arr()
    {
        $codecard = [
            1 =>  rand(111111, 999999),
            2 =>  rand(111111, 999999),
            3 =>  rand(111111, 999999),
            4 =>  rand(111111, 999999),
            5 =>  rand(111111, 999999),
            6 =>  rand(111111, 999999),
            7 =>  rand(111111, 999999),
            8 =>  rand(111111, 999999),
            9 =>  rand(111111, 999999),
        ];

        $codecard = array_unique($codecard);
        if (sizeof($codecard) == 9) {
            return $codecard;
        } else {
            return self::get_codecard_arr();
        }
    }
    static function get_number_arr($min = 1, $max = 9, $count = 3)
    {
        $codecard = [];

        if ($max - ($min - 1) < $count) {
            return [];
        }

        for ($i = 1; $i <= $count; $i++) {
            $codecard[] =  rand($min, $max);
        }
        $codecard = array_unique($codecard);
        if (sizeof($codecard) == $count) {
            return $codecard;
        } else {
            return self::get_number_arr($min, $max, $count);
        }
    }
    static function get_ip_by_domain_name($domain_name = '')
    {
        $ip = false;
        if ($domain_name != '') {
            $data_json = file_get_contents("http://ip-api.com/json/" . $domain_name);
            $data_arr = json_decode($data_json, true);
            if (isset($data_arr['status']) && strtolower($data_arr['status']) == 'success') {
                $ip = $data_arr['query'];
            }
        }
        return $ip;
    }
    static function validateURL($url)
    {
        $pattern_1 = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
        if (preg_match($pattern_1, $url)) {
            return true;
        } else {
            return false;
        }
    }
    static function http_build_query_for_curl($arrays, &$new = array(), $prefix = null)
    {

        if (is_object($arrays)) {
            $arrays = get_object_vars($arrays);
        }

        foreach ($arrays as $key => $value) {
            $k = isset($prefix) ? $prefix . '[' . $key . ']' : $key;
            if (is_array($value) or is_object($value)) {
                self::http_build_query_for_curl($value, $new, $k);
            } else {
                $new[$k] = $value;
            }
        }
    }

    static function get_browser($useragent_string = '')
    {
        $u_agent = $useragent_string;
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";
        $ub = "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Opera/i', $u_agent) || preg_match('/OPR/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = isset($matches['version'][0]) ? $matches['version'][0] : '';
            } else {
                $version = isset($matches['version'][1]) ? $matches['version'][1] : '';
            }
        } else {
            $version = $matches['version'][0];
        }

        // check if we have a number
        if ($version == null || $version == "") {
            $version = "?";
        }

        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    }

    public static function array_except($array, $keys)
    {
        foreach ($keys as $key) {
            unset($array[$key]);
        }
        return $array;
    }

    public static function has_script_keyword($str = '')
    {
        if ($str == '' || strpos($str, 'script') !== false) {
            return true;
        }
        return false;
    }
    static function rand_otp($len)
    {
        $characters = '0123456789';
        $randomString = '';
        for ($i = 0; $i < $len; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    static function check_webhook_url($url = '')
    {
        $check = self::validateURL($url);
        if ($check) {
            stream_context_set_default(
                array(
                    'http' => array(
                        'method' => 'POST',
                        'header' => "Content-Length: 0",
                        'timeout' => 10
                    )
                )
            );
            $headers = @get_headers($url);
            if ($headers && substr($headers[0], 9, 3) == 200) {
                /*$httpcode = substr($headers[0], 9, 3);
                if($httpcode == 200){*/
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    static function send_sms($number, $msg = '')
    {
        try {

            $sid    = env('TWILLIO_SID', "ACae2d67521fbc1846a491ac5253074c96");
            $token  = env('TWILLIO_AUTH_TOKEN', 'd36b9937a803335680e46ca0cc5ab710');
            $twilio = new Client($sid, $token);
            if (env('APP_ENV') == 'local') {
                $number = "+919737023110";
            } else {
                $number = '+61' . $number;
            }
            \Log::info($sid);
            \Log::info($token);
            \Log::info(env('TWILLIO_SERVICE_ID', 'MG24bd3358e6caac66cb51438efa870867'));
            \Log::info($number);
            \Log::info($msg);
            $message = $twilio->messages
                ->create(
                    $number, // to 
                    array(
                        "messagingServiceSid" => env('TWILLIO_SERVICE_ID', 'MG24bd3358e6caac66cb51438efa870867'),
                        "body" => $msg
                    )
                );
            \Log::info('===Twillio SMS=========');
            \Log::info($message);
            if (isset($message->sid)) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            \Log::info('=============Twillio Error============');
            \Log::info($e);
            return false;
        }
    }

    public static function check_facebook_access_token($token)
    {
        $url = "https://graph.facebook.com/me?fields=email,id&access_token=" . $token;
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 2
        ));

        $result = curl_exec($ch);
        // \General::log("Facebook login res");
        // \General::log($result);
        $result = json_decode($result, true);
        curl_close($ch);
        $res = self::error_res("not_authorise");
        if (isset($result['email'])) {
            $res = self::success_res();
            $res['data']['email'] = $result['email'];
            return $res;
        }

        return $res;
    }

    public static function check_google_access_token($token)
    {
        $url = "https://www.googleapis.com/oauth2/v3/tokeninfo?access_token=" . $token;
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 2
        ));

        $result = curl_exec($ch);
        $result = json_decode($result, true);
        curl_close($ch);
        if (isset($result['email'])) {
            $res = self::success_res();
            $res['data']['email'] = $result['email'];
            return $res;
        }
        $res = self::error_res("not_authorise");
        return $res;
    }
}
