<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Restaurant extends Model implements Authenticatable {
    
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

    // public function getImageAttribute($value)
    // {
    //     return url('/public/restaurant/'.$value);
    // }
     
    protected $table = 'restaurant';
    public $timestamps = true;

    public function getImageAttribute($value = "")
    {
        // dd($value);
        if ($value == "" || $value == null) {
            return url('public/assets/images/dummy-restaurant.jpg');
        }
        if (filter_var($value, FILTER_VALIDATE_URL) === false) {
            if ($value)
                return url('/public/restaurant/'.$value);
            else
                return url('public/assets/images/dummy-restaurant.jpg');
        } else {
            return $value;
        }
    }

    public function food(){
        return $this->hasMany( "\App\Models\Admin\RestaurantFood",'restaurant_id','id');
    }
    public function postcode(){
        return $this->hasOne("\App\Models\Admin\PostCode","postcode","pincode");
    }
        public static function addRestaurant($param)
        {
            try{
            $res = \General::success_res('Add Restaurant successfully.'); 
            if(isset($param['id']) && $param['id'] !=""){
                $data = self::where('id',$param['id'])->first();
                $res = \General::success_res('Update Restaurant successfully.'); 
            }else{
                $data = new self;
                $data->status=0;
            }
            $data->name=$param['name']; 
            if(isset($param['email']) && $param['email'] != ""){
                $data->email=$param['email']; 
            }
            $data->number=$param['phone_number']; 
            $data->address=$param['address']; 
            $data->state=$param['state']; 
            $data->rating= $param['rating'];
            $data->pincode=$param['pincode'];
            $data->latitude=isset($param['lat']) ? $param['lat'] : null;
            $data->longitude=isset($param['long']) ? $param['long'] : null;
            $data->suburb=$param['suburb'];

            if (isset($param['image']) && is_file($param['image'])) {

                // if(isset($param['id']) && $param['id'] != null ){
                //     dd($data->image);
                //     if (isset($data->image) && $data->image != null) {
                //         $u_image = public_path('restaurant/').basename($data->image); 
                //         unlink($u_image);
                //     }
                // }
                $dir_path = public_path('restaurant/');
                $images = request()->file('image');
                $images_ext = $images->getClientOriginalExtension();
                $bg_img_name = time().".".$images_ext;
                if(!$images->move($dir_path,$bg_img_name)){
                   return error_res("Error In Upload  Image !");
                }
                $data->image=$bg_img_name;
            }
            if($param['password'] != ""){
                $data->password= \Hash::make($param['password']); 
            }
                if($data->save()){
                    if($param['id'] == null){
                        $user_detail['name'] = 'Dear '.$param['name'];
                        $user_detail['mail_subject'] = 'Restaurant Login credential';
                        $user_detail['mail_from_email'] = 'coffeerun@no-reply.com';
                        $user_detail['mail_from_name'] = 'CoffeeRun';
                        $user_detail['to_email'] = $param['email'];
                        $user_detail['password'] = $param['password'];
                        $activation_token = \App\Models\Admin\RestaurantToken::generate_activation_token();
                        $user_detail['activation_token'] =url('restaurant/email-verify')."/".$activation_token;
                        $data = [
                            'status' => 1,
                            'type' => 1,
                            'platform' => 0,
                            'user_id' => $data->id,
                            'token' => $activation_token,
                            "ip" => \Request::getClientIp(),
                            "ua" => \Request::server("HTTP_USER_AGENT")
                        ];
                        $saved_token = \App\Models\Admin\RestaurantToken::save_token($data);
                        $user_detail['mail_blade'] = 'emails.login_credential';

                        dispatch(new \App\Jobs\CustomerJob($user_detail));
                        // \Mail::send('emails.login_credential', $user_detail, function ($message) use ($user_detail) {
                        //     $message->from($user_detail['mail_from_email'],$user_detail['mail_from_name'])->to($user_detail['to_email'])->subject($user_detail['mail_subject']);
                        // });
                    }
                    return $res;
                }else{
                    return \General::error_res('somethings went wrong.');
                }
            }catch(Exception $e){
                return \General::error_res('somethings went wrong.');
            }
        }
        public static function filter($param){
            $data = self::with('postcode')->latest('id','desc');

            if(isset($param['name']) && $param['name'] != ""){
                $data->where('name',"like","%".$param['name']."%");                
            }
            if(isset($param['email']) && $param['email'] != ""){
                $data->where('email',$param['email']);                
            }
            if(isset($param['number']) && $param['number'] != ""){
                $data->where('number',$param['number']);                
            }
            if(isset($param['state']) && $param['state'] != ""){
                $data->where('state',$param['state']);                
            }
            if(isset($param['status']) && $param['status'] != ""){
                $data->where('status',$param['status']);                
            }
            if(isset($param['pincode']) && $param['pincode'] != ""){
                $data->where('pincode',"like","%".$param['pincode']);                
            }
            if(isset($param['suburb']) && $param['suburb'] != ""){
                $data->whereHas('postcode',function($q)use($param){
                    $q->where('locality',"like","%".$param['suburb']."%");
                });              
            }
            if(isset($param['rate']) && $param['rate'] != ""){
                $data->where('rating',$param['rate']);                
            }
            if(!isset($param['blade'])){
            $count = $data->count();
            $len =isset($param['itemPerPage']) ? $param['itemPerPage'] : "";
            $start =isset($param['currentPage']) ? ($param['currentPage']-1) * $len :"";
            $data = $data->skip($start)->take($len)->get()->toArray();
            $view_count = count($data);
            $res['total_page_data'] = $view_count;
            $res['start'] = $start;
            $res['data'] = $data;
            $res['total_record'] = $count;
            return $res;
            }else{

            }
        }
        
        public static function updateCategory($param){
            $category = self::find($param['id']);
            $category->name=$param['category_name'];
            $category->status=$param['status'];
            $category->save();
            return \General::success_res('update category successfully.');
        }
        public static function get_all(){
            $data = self::With('food')->where("status",1)->get();
            if($data->isEmpty()){
                $data =  [];

            }else{
                $data =  $data->toArray();
            }
            return $data;
        }
        public static function get_by_id($id=''){
            $merchant=self::find($id);
            if($merchant){
                $merchant = $merchant->toArray();
            }else{
                $merchant=[];
            }
            return  $merchant;
        }
        static function do_active($id=""){
            $merchant = self::where('id',$id)->first();
            $merchant->status = 1;
            if($merchant->save()){
                return true;
            }else{
                return false;
            }
        }
        public static function update_restaurant_data($param)
        {
        // dd(public_path('userprofile'));
        $data = self::where('id', $param['id'])->first();
        $data->name = $param['restaurantName'];
        $data->number = $param['restaurantContact'];
        $data->address = $param['restaurantAddress'];
        $data->pincode = $param['restaurantPincode'];
        $data->state = $param['restaurantState'];
        if(isset($param['status']) && $param['status'] !=""){
            $data->is_open = 1;
        }else{
            $data->is_open = 0;

        }
        if (isset($param['profileImage']) && is_file($param['profileImage'])) {

            if (isset($data['image']) && $data['image'] != null) {
                $u_image = public_path('restaurant/') . basename($data['avatar']);
                // unlink($u_image);
            }
            $dir_path = public_path('restaurant/');
            $images = request()->file('profileImage');
            $images_ext = $images->getClientOriginalExtension();
            $bg_img_name = time() . "." . $images_ext;
            if (!$images->move($dir_path, $bg_img_name)) {
                return \General::error_res("Error In Upload  Image !");
            }
            $data->image = $bg_img_name;
        }

        foreach ($param['time'] as $key => $value) {
            if(!isset($value['is_closed'])){
                $param['time'][$key]['is_closed'] = 0;
            }
        }
        $data->timming = json_encode($param['time']);
        $result = $data->save();
        if ($result) {
            return \General::success_res("successfully update restaurant.");
        } else {
            return \General::error_res("something went to worng");
        }
    }
    public static function update_restaurant_password($param)
    {
        $data = self::where('id', $param['id'])->first();
        $data->password = \Hash::make($param['newPassword']);
        $password = $param['newPassword'];
        $conformPassword = $param['confirmNewPassword'];
        if ($password != $conformPassword) {
            return \General::error_res("Password and conform password cannot be match");
        } else {
            $result = $data->save();
            if ($result) {
                return \General::success_res("successfully change password.");
            } else {
                return \General::error_res("something went to worng");
            }
        }
    }

    public static function update_device_token($param){

        $data = self::where('id', $param['restaurant_id'])->first();
        $data->device_token = $param['token'];
        if ($data->save()) {
            return \General::success_res("update token successfully.");
        } else {
            return \General::error_res("something went to worng");
        }
    }

    public static function forgotPassword($param)
    {
        $user = self::where('email', $param['email'])->first();
        if (is_null($user)) {
            return \General::error_res("Invalid Email.");
        }
        if($user->status == 0){
            return \General::error_res("Please, Verify your account first.");
        }
        if($user->status == 2){
            return \General::error_res("Your account is suspended.");
        }
        $forgotpass_token = \App\Lib\General::generateResetPasswordKey();
        $mch_detail = $user->toArray();
        $mch_detail['forgotpass_token'] = $forgotpass_token;
        $mch_detail['mail_subject'] = 'Forgot Password';
        $mch_detail['mail_from_email'] = 'coffeerun@no-reply.com';
        $mch_detail['mail_from_name'] = 'CoffeeRun';
        $mch_detail['to_email'] = $param['email'];
        $mch_detail['name'] =  $mch_detail['name'];
        $mch_detail['user_type'] =  $param['user_type'];
        $user->password_token = $forgotpass_token;
        $user->save();
        $mch_detail['mail_blade'] = 'emails.forget_password';
        dispatch(new \App\Jobs\CustomerJob($mch_detail));
        // \Mail::send('emails.forget_password', $mch_detail, function ($message) use ($mch_detail) {
        //     $message->from($mch_detail['mail_from_email'], $mch_detail['mail_from_name'])->to($mch_detail['email'])->subject('Forgot Password');
        // });
        return \General::success_res("Email send successfully.");
    }

    public static function get_by_pass_token($token = "")
    {
        $user = [];
        if ($token != '' && $token != null) {
            $user = self::where("password_token", $token)->first();
            if ($user) {
                $user = $user->toArray();
            }
        }
        return $user;
    }
    
}

