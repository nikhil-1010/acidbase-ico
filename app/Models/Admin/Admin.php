<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Admin extends Model implements Authenticatable {

    use AuthenticableTrait;


	public function getAuthIdentifier() {
        return $this->getKey();
    }

    public function getAuthIdentifierName() {
        return $this->getKeyName();
    }

    public function getAuthPassword() {
        return $this->password;
    }

    public function getRememberToken() {
        return $this->{$this->getRememberTokenName()};
    }

    public function getRememberTokenName() {
        return 'remember_token';
    }

    public function setRememberToken($value) {
        $this->{$this->getRememberTokenName()} = $value;
    }

    protected $table='admin';
    
    static public function do_login($param)
    {
        $user = self::where("email", $param['email'])->first();
        $res['data']=$user;
        $res['flag']=0;
        if (is_null($user)) {
            $res['flag']=0;
            return $res;
        }
        if (!\Hash::check($param['password'], $user->password)) {
            $res['flag']=0;
            return $res;
        }
        \Auth::guard("admin")->loginUsingId($user->id,true);
        $res['flag']=1;
        return $res;
    }
    public static function change_admin_password($param)
    {
        $admin_detail = self::where("id", \Auth::guard('admin')->user()->id)->first();
        $res['data']= $admin_detail;
        $res['flag']=0;
        $res['msg']="";
        
        if (is_null($admin_detail)) {
            return $res;
        }
           
        if(\Hash::check($param['old_password'],$admin_detail->password))
        {
            if($param['new_password'] == $param['confirm_password'])
            {
                $admin_detail->password = \Hash::make($param['new_password']);
                $admin_detail->save();
                $res['data']= $admin_detail;
                $res['flag']=1;
                $res['msg']="Admin password updated successfullly.";
                return $res;
            }
            else
            {
                $res['data']= $admin_detail;
                $res['flag']=0;
                $res['msg']="New and Confirm password do not match.";
                return $res;
            }
        }
        else
        {
            $res['msg']="Wrong Old Password.";
            return $res;
        }
    }
    public static function updateProfile($param)
    {
        $admin_detail = self::where("id", \Auth::guard('admin')->user()->id)->first();
        
        if (is_null($admin_detail)) {
            return $res;
        }
        
        $admin_detail->username = $param['admin_name'];
        $admin_detail->email = $param['admin_email'];
        if($admin_detail->save()){
            return \General::success_res('Profile update successfully.');
        }
        return \General::error_res('something went wrong!');
    }
    public static function get_by_pass_token($token = "")
    {
        $user = [];
        if ($token != '' && $token != null) {
            $user = self::where("remember_token", $token)->first();
            if ($user) {
                $user = $user->toArray();
            }
        }
        return $user;
    }
}
