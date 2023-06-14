<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $fillable = ['name', 'val', 'autoload'];
    public $timestamps = false;
    protected $hidden = [];

    public static function get_config($name = ""){
        $data = [];
        if(is_string($name) && $name != "")
        {
            $settings = self::where("name",$name)->skip(0)->take(1)->get();
            
        }
        else if(is_array($name) && !empty ($name))
        {
            $settings = self::whereIn("name",$name)->get();
        }
        else
        {
            $settings = self::where("autoload","=","1")->get();
        }
        if(isset($settings[0]) && isset($settings[0]->name))
        {
            $settings = $settings->toArray();
            
            foreach ($settings as $setting) {
                $data[$setting['name']] = $setting['val'];
            }
        }
        return $data;
    }

    public static function set_config($configs = []) {
                
        foreach ($configs as $key => $val) {
            $setting = self::where("name","=",$key)->first();
            if(isset($setting->name))
            {
                $setting->val = $val;
                $setting->save();
            }
        }
        return \General::success_res();
    }

    public static function edit_general_settings($param){
        $settings = isset($param['settings']) ? $param['settings'] : [];
        foreach ($settings as $row){
            
            $name = $row['name'];
            $value = $row['value'];
            self::where('name',$name)->update(['val'=>$value]);
        }
        return \General::success_res(' Settings saved successfully');
    }
    public static function edit_advance_settings($param){
       
        if(is_string($param['site_title']) && $param['site_title'] != "")
        {
           self::where('name','site_title')->update(['val'=>$param['site_title']]); 
        }
        if(is_string($param['user_theme']) && $param['user_theme'] != "")
        {
           self::where('name','user_theme')->update(['val'=>$param['user_theme']]); 
        }
        if(is_string($param['webhook_url']) && $param['webhook_url'] != "")
        {
            $is_valid_webhook = \General::check_webhook_url($param['webhook_url']);
            if(!$is_valid_webhook){
                $json =   \General::error_res("The Webhook URL is invalid.");
                $json['data'] = ["webhook_url"];
                return $json;
            }
           self::where('name','webhook_url')->update(['val'=>$param['webhook_url']]); 
        }
        else if(is_array($param['site_description']) && $param['site_description'] != "")
        {
           self::where('name','meta_description')->update(['val'=>$param['site_description']]);
        }
        if (isset($param['site_logo']) && is_file($param['site_logo'])) {
            // dd(config('constant.LOGO_IMAGE_PATH'));logo.png
            $dir_path = config('constant.LOGO_IMAGE_PATH');
            if (!file_exists($dir_path)) {
                mkdir($dir_path, 0777, true);
            }
            $site_logo = request()->file('site_logo');
            $site_logo_ext = $site_logo->getClientOriginalExtension();
            $logo_img_name = "logo_image".".".$site_logo_ext;

            if(!$site_logo->move($dir_path,$logo_img_name)){
               return error_res("Error In Upload Logo Image !");
            }
            $settings =  self::where('name','logo_image')->update(['val'=> $logo_img_name]);
        }
        if (isset($param['meta_image']) && is_file($param['meta_image'])) {
        
            $dir_path = config('constant.META_OG_IMAGE_PATH');
            if (!file_exists($dir_path)) {
                mkdir($dir_path, 0777, true);
            }
            $meta_image = request()->file('meta_image');
            $meta_image_ext = $meta_image->getClientOriginalExtension();
            $meta_img_name = "meta_image".".".$meta_image_ext;

            if(!$meta_image->move($dir_path,$meta_img_name)){
               return error_res("Error In Upload Meta Image !");
            }
            $settings =  self::where('name','meta_og_image')->update(['val'=> $meta_img_name]);
        }
        return \General::success_res(' Settings saved successfully');
    }
}
