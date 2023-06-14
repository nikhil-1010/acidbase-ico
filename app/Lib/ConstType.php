<?php

namespace App\Lib;

class ConstType {

    private static $rules = array(
        "users" => [
            "status" => [
                'rejected'=>0,
                'active'=>1,
                'pending'=>2,
                'suspended'=>3,
            ],
        ],
        "users_token" => [
            "status" => [
                'expired'=>0,
                'active' => 1,
            ],
            "type" => [
                'auth'=>0,
                'activate_account'=>1,
                'forgot_password'=>2,
                'otp'=>3,
                'set_password'=>4,
                'login_otp'=>5,
            ],
        ],
    );

       
    public static function get_type($table_n_field, $rules_name = '') {
        $type= explode('.', $table_n_field);
        if(!isset($type[0]) || !isset($type[1])){
            return array();
        }
        $table=$type[0];
        $field=$type[1];
        if(isset(self::$rules[$table])){
            if(isset(self::$rules[$table][$field])){
                if(isset(self::$rules[$table][$field][$rules_name])){
                    return self::$rules[$table][$field][$rules_name];
                }
            }
            return self::$rules[$table][$field];
        }
            
        return array();
    }
    
    
     public static function type_list($table_n_field, $rules_code = '') {
        $type= explode('.', $table_n_field);
        if(!isset($type[0]) || !isset($type[1])){
            return array();
        }
        $table=$type[0];
        $field=$type[1];
       
        if(isset(self::$rules_view[$table])){
          
            if(isset(self::$rules_view[$table][$field])){
                if(isset(self::$rules_view[$table][$field][$rules_code])){
                    return self::$rules_view[$table][$field][$rules_code];
                }
               return self::$rules_view[$table][$field];
            }
            return self::$rules_view[$table];
        }
            
        return array();
    }
}
