<?php 
 
namespace App\Models\Admin;    
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\ConstType;

class SaloonToken extends Eloquent {
    
    public $table = 'saloons_token';
    protected $hidden = [];
    protected $fillable = array('type','user_id','token',  'expire_time','ip', 'ua','status');
    
    
    public function scopeActive($query) {
        return $query->where('status', '=', 1);
    }
    
    public static function inactive_token($type)
    {
        $token = self::active()
                ->where("type","=",$type)
                ->where("ua","=",\Request::server("HTTP_USER_AGENT"))
                ->where("ip","=",\Request::getClientIp())
                ->get()->first();
        if(!is_null($token))
        {
            $token->status = 0;
            $token->save();
        }
    }
     
    public static function generate_activation_token()
    {
        static $call_cnt = 0;
        if($call_cnt > 50)
            return "";
        ++$call_cnt;
        $token = \General::rand_str(15);
        $user = self::active()->where("type",'=',1)->where("token",'=',$token)->first();
        if(isset($user->token))
        {
            return self::generate_activation_token();
        }
        return $token;
    }
    
    public static function generate_forgotpass_token()
    {
        static $call_cnt = 0;
        if($call_cnt > 50)
            return "";
        ++$call_cnt;
        $token = \General::rand_otp(6);
        $user = self::active()->where("type",'=',\ConstType::get_type('users_token.type','forgot_password'))->where("token",'=',$token)->first();
        if(isset($user->token))
        {
            return self::generate_forgotpass_token();
        }
        return $token;
    } 


    public static function generate_otp_token()
    {
        static $call_cnt = 0;
        if($call_cnt > 50)
            return "";
        ++$call_cnt;
        $token = \General::rand_otp(6);
        $user = self::active()->where("type",'=',\ConstType::get_type('users_token.type','otp'))->where("token",'=',$token)->first();
        if(isset($user->token))
        {
            return self::generate_signup_confirm_token();
        }
        return $token;
    }
    public static function generate_login_confirm_token()
    {
        static $call_cnt = 0;
        if($call_cnt > 50)
            return "";
        ++$call_cnt;
        $token = \General::rand_otp(4);
        $user = self::active()->where("type",'=',\ConstType::get_type('users_token.type','login_otp'))->where("token",'=',$token)->first();
        if(isset($user->token))
        {
            return self::generate_login_confirm_token();
        }
        return $token;
    } 
    public static function generate_password_token()
    {
        static $call_cnt = 0;
        if($call_cnt > 50)
            return "";
        ++$call_cnt;
        $token = \General::rand_str(15);
        $user = self::active()->where("type",'=',\ConstType::get_type('users_token.type','set_password'))->where("token",'=',$token)->first();
        if(isset($user->token))
        {
            return self::generate_password_token();
        }
        return $token;
    }
    
    public static function generate_auth_token()
    {
        static $call_cnt = 0;
        if($call_cnt > 10)
            return "";
        ++$call_cnt;
        $token = \General::rand_str(15);
        $user = self::active()->where("type",'=',\ConstType::get_type('users_token.type','auth'))->where("token",'=',$token)->first();
        if(isset($user->token))
        {
            return self::generate_auth_token();
        }
        return $token;
    }
    
    public static function find_dead_token_id($token_type,$user_id)
    {
        $token = self::where("type",$token_type)
                ->where("ua","=",\Request::server("HTTP_USER_AGENT"))
                ->where("ip","=",\Request::getClientIp())
                ->where("platform","=",app("platform"))
                ->where("user_id",$user_id)->first();
        if(is_null($token))
        {
            return FALSE;
        }
        return $token->id;
    }
    
    public static function save_token($param)
    {
     	$token = new self;
        $token->fill($param);
        // $token->type = $param['type'];
        // $token->platform = $param['platform'];
        // $token->user_id = $param['user_id'];
        // $token->token = $param['token'];
        $token->ip = md5(
                $_SERVER['REMOTE_ADDR'] .
                $_SERVER['HTTP_USER_AGENT']
            ); 
        $token->ua = \Request::server("HTTP_USER_AGENT");
        $token->status = 1;
        $token->save();
        $res = \General::success_res();
        $res['data'] = $token->toArray();
        return $res;
    }
    public static function delete_token($id)
    {
        if(\Auth::guard('api')->user()){
            $token = self::where('user_id',$id)->first();
            if($token){
                $token->delete();
                return \General::success_res();
            }else{
                 return \General::success_res();
            }
        }else{
            $token = self::where('user_id',$id)->first();
            if($token){
                $token->delete();
                return \General::success_res();
            }else{
                 return \General::success_res();
            }
        }  
    }
    
    public static function is_active($type,$token)
    {
        $user = self::active()->where("type",'=',$type)->where("token",'=',$token)->first();
        if(isset($user->token))
        {
            return $user->user_id;
        }
        return FALSE;
    }
    
    public static function get_active_token($token_type)
    {
        $token = self::active()
                ->where("type","=",$token_type)
                ->where("ua","=",\Request::server("HTTP_USER_AGENT"))
                ->where("ip","=",\Request::getClientIp())
                ->first();
        if(!is_null($token))
        {
            $token = $token->toArray();
            return $token['token'];
        }
        return FALSE;
    }
    
    public static function delete_active_token($token_type)
    {
        if($token_type='auth'){
            $token_type=0;
        }
        $token = self::where('status', 1)->where("type","=",$token_type)->delete();
        
        return \General::success_res();
    }
        
    public static function delete_all_auth_token($user_id,$from=''){
        $type = \ConstType::get_type('users_token.type','auth');
        if ($from && $from=='api') {
            $token = self::where("type","=",$type)->where('user_id',$user_id)->where('platform','!=',\Config::get("constant.WEB_DEVICE"))->delete();   
        }else{
            $token = self::where("type","=",$type)->where('user_id',$user_id)->where('platform',\Config::get("constant.WEB_DEVICE"))->delete();   
        }
        
        return \General::success_res();
    }
    public static function getId($token){
        if (Token::where('token',$token)->get()->count() ==0) {
           return \General::success_res('user suspended');
        }
        $id =Token::where('token',$token)->first()['user_id'];
        return $id;
    }
    public static function generate_product_id()
    {
       
        static $call_cnt = 0;
        if($call_cnt > 10)
            return "";
        ++$call_cnt;
        $order_id = 'order'.\General::rand_otp(10);
        $order = Order::where('order_id',$order_id)->first();
        if(isset($order->order_id))
        {
            return self::generate_product_id();
        }
        return $order_id;
    }
    public static function is_logged_in($token)
    {
        $token = self::active()->where("token", $token)->first();
        if($token)
            return \General::success_res('Success');
        else
            return \General::session_expire_res('Unauthorized Token');
    }
    public static function get_user_by_token($token)
    {
        $token = self::where("token", $token)->first();

        $user_id = '';
        if($token)
            $user_id = $token['user_id'];

        return $user_id;
    }
}
