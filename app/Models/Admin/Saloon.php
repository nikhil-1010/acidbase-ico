<?php

namespace App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Endroid\QrCode\QrCode;

class Saloon extends Model implements Authenticatable {

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
    //     return url('/public/saloon/'.$value);
    // }
    public function postcode(){
        return $this->hasOne("\App\Models\Admin\PostCode","postcode","pincode");
    }
    public function getImageAttribute($value = "")
    {
        // dd($value);
        if ($value == "" || $value == null) {
            return url('public/assets/images/dummy-user.png');
        }
        if (filter_var($value, FILTER_VALIDATE_URL) === false) {
          if ($value)
              return url('/public/saloon/'.$value);
          else
              return url('public/assets/images/dummy-user.png');
        } else {
            return $value;
        }
    }
    protected $table = 'saloon';
   
    protected $fillable = ['name'];
    public $timestamps = true;
    protected $hidden = [];

    public static function createQrCode($solonLink,$img,$imageName)
    {
        $createQrCodeFileName = rand().time().'.png';
        $qrCode = new QrCode();
        $qrCode->setText($solonLink)
            ->setSize(200)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 75, 'g' => 66, 'b' => 61, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            ->setLogo(public_path("assets/images/qr_logo.png"))
            ->setLogoSize(80)
            ->setImageType(QrCode::IMAGE_TYPE_PNG);
        $qrCode->save(public_path($createQrCodeFileName));

        $your_original_image= $img;
        $your_frame_image= public_path($createQrCodeFileName); 

        $dest = imagecreatefrompng($your_original_image);
        $src = imagecreatefrompng($your_frame_image);
        imagealphablending($dest, false);
        imagesavealpha($dest, true);
        // Copy and merge
        imagecopymerge($dest, $src,550,50,0,0,220,220,100);

        // Output and free from memory
        header('Content-Type: image/png');
        // imagepng($dest);   
        imagepng($dest,$imageName);

        imagedestroy($dest);
        imagedestroy($src);

        if (file_exists(public_path($createQrCodeFileName))) {
            unlink(public_path($createQrCodeFileName));
        }
        // $qrCode->save(public_path('qr/salon-'.$imageName.'.png'));
    }
        
    public static function addSaloon($param)
    {
        try{
            $res = \General::success_res('Add Saloon successfully.'); 
            if(isset($param['id']) && $param['id'] !=""){
            $data = self::where('id',$param['id'])->first();
            $res = \General::success_res('Update Saloon successfully.'); 
            }else{
                $data = new self;
                $data->status=0;
            }
        $address = str_replace(" ", "+",$param['address']);
        $apiKey ='AIzaSyDXncahDrnro9bBQ9dhstgMMsEkIBMhUyQ';
        // dd($address);
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  
        // $request_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false&key=".$apiKey;
        // // $json = file_get_contents($request_url,false,stream_context_create($arrContextOptions));
        // $json = \General::file_get_content_curl($request_url);
        // $json = json_decode($json);
        // $data->latitude=isset($json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'}) ? $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'} : null; 
        // $data->longitude=isset($json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'}) ? $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'} : null;

        $data->latitude=isset($param['lat']) ? $param['lat'] : null;
        $data->longitude=isset($param['long']) ? $param['long'] : null;
        $data->name=$param['name']; 
        $data->email=$param['email']; 
        $data->number=$param['phone_number']; 
        $data->address=$param['address']; 
        $data->state=$param['state']; 
        $data->pincode=$param['pincode'];
        $data->suburb=$param['suburb'];

        if (isset($param['image']) && is_file($param['image'])) {
            // if(isset($param['id']) && $param['id'] != null ){
            //     $u_image = public_path('saloon/').basename($data['image']); 
            //     unlink($u_image);
            // }
            $dir_path = public_path('saloon/');
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

                    $name = str_replace(" ","_",$data->name);
                    Saloon::createQrCode(url('/restaurant-list')."?salon=".$name,public_path('caffeine-hit.png'),public_path('qr/salon-'.$name.'.png'));
                    Saloon::createQrCode(url('/restaurant-list')."?salon=".$name,public_path('feeling-hungry.png'),public_path('qr/salon-'.$name.'2.png'));
                    Saloon::createQrCode(url('/restaurant-list')."?salon=".$name,public_path('feeling-thirsty.png'),public_path('qr/salon-'.$name.'3.png'));
                    Saloon::createQrCode(url('/restaurant-list')."?salon=".$name,public_path('scan.png'),public_path('qr/salon-'.$name.'4.png'));
                    // $qrCode = new QrCode();
                    // dd($)
                    // $qrCode->setText(url('/restaurant-list')."?salon=".$name)
                        // ->setSize(300)
                        // ->setPadding(10)
                        // ->setErrorCorrection('high');
                        // ->setForegroundColor(array('r' => 75, 'g' => 66, 'b' => 61, 'a' => 0))
                        // ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
                        // ->setLogo(public_path("assets/images/qr_logo.png"))
                        // ->setLogoSize(120)
                        // ->setImageType(QrCode::IMAGE_TYPE_PNG);
                    // $qrCode->save(public_path('qr/salon-'.$name.'.png'));


                    $user_detail['name'] =  'Dear '.$param['name'];
                    $user_detail['mail_subject'] = 'Salon Login credential';
                    $user_detail['mail_from_email'] = 'coffeerun@no-reply.com';
                    $user_detail['mail_from_name'] = 'CoffeeRun';
                    $user_detail['to_email'] = $param['email'];
                    $user_detail['password'] = $param['password'];

                    $activation_token = \App\Models\Admin\SaloonToken::generate_activation_token();
                    $user_detail['activation_token'] =url('salon/email-verify')."/".$activation_token;
                    $data = [
                        'status' => 1,
                        'type' => 1,
                        'platform' => 0,
                        'user_id' => $data->id,
                        'token' => $activation_token,
                        "ip" => \Request::getClientIp(),
                        "ua" => \Request::server("HTTP_USER_AGENT")
                    ];  
                    $saved_token = \App\Models\Admin\SaloonToken::save_token($data);
                    $user_detail['mail_blade'] = 'emails.login_credential';
                    try{
                        dispatch(new \App\Jobs\CustomerJob($user_detail));
                        // \Mail::send('emails.login_credential', $user_detail, function ($message) use ($user_detail) {
                        //     $message->from($user_detail['mail_from_email'],$user_detail['mail_from_name'])->to($user_detail['to_email'])->subject($user_detail['mail_subject']);
                        // });
                    }catch (\GuzzleHttp\Exception\RequestException $e) {
                        \Log::info($e);
                        return \General::error_res('Oops. Something went wrong. Please try again later.');
                    } 
                }
                return $res; 
            }else{
                return \General::error_res('somethings went wrong.');
            }
        }catch(Exception $e){
            return \General::error_res('somethings went wrong.');
        }
    }

        public static function replaceQRImage($param){

            // dd($param);
            $qrCode = new QrCode();
            // dd($)
            $qrCode->setText(url('/restaurant-list')."?saloon=".$param['id'])
                ->setSize(300)
                ->setPadding(10)
                ->setErrorCorrection('high')
                ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
                ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
                ->setLogo(public_path("assets/images/qr_logo.png"))
                ->setLogoSize(120)
                ->setImageType(QrCode::IMAGE_TYPE_PNG);
            $qrCode->save(public_path('qr/saloon-'.$param['id'].'.png'));
            return true;
        }
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
            \Auth::guard("saloon")->loginUsingId($user->id,true);
            $res['flag']=1;
            return $res;
        }
        public static function filter($param){
            $data = self::with('postcode')->latest('id','desc');

           if(isset($param['name']) && $param['name'] != ""){
                $data->where('name',$param['name']);                
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
            if(isset($param['pincode']) && $param['pincode'] != ""){
                $data->where('pincode',$param['pincode']);                
            }
            if(isset($param['suburb']) && $param['suburb'] != ""){
                $data->whereHas('postcode',function($q)use($param){
                    $q->where('locality',"like","%".$param['suburb']."%");
                });              
            }
            $count = $data->count();
            $len = $param['itemPerPage'];
            $start = ($param['currentPage']-1) * $len;
            $data = $data->skip($start)->take($len)->get()->toArray();
            $res['data'] = $data;
            $res['total_record'] = $count;
            return $res;
        }
        public static function updateCategory($param){
            $category = self::find($param['id']);
            $category->name=$param['category_name'];
            $category->status=$param['status'];
            $category->save();
            return \General::success_res('update category successfully.');
        }
        public static function get_all(){
            $data = self::where('status',1)->get();
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
        public static function update_saloon_data($param)
        {
        // dd(public_path('userprofile'));
        $data = self::where('id', $param['id'])->first();
        $data->name = $param['saloonName'];
        $data->number = $param['saloonContact'];
        if(isset($param['saloonAddress']) && $param['saloonAddress'] != ""){
            $address = str_replace(" ", "+",$param['saloonAddress']);
            $apiKey ='AIzaSyDXncahDrnro9bBQ9dhstgMMsEkIBMhUyQ';
            $json = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false&key=".$apiKey);
            $json = json_decode($json);
            $data->latitude=isset($json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'}) ? $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'} : null; 
            $data->longitude=isset($json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'}) ? $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'} : null;
        }
        $data->address = $param['saloonAddress'];
        $data->pincode = $param['saloonPincode'];
        $data->state = $param['saloonState'];
        if (isset($param['profileImage']) && is_file($param['profileImage'])) {

            if (isset($data['image']) && $data['image'] != null) {
                $u_image = public_path('saloon/') . basename($data['avatar']);
                // unlink($u_image);
            }
            $dir_path = public_path('saloon/');
            $images = request()->file('profileImage');
            $images_ext = $images->getClientOriginalExtension();
            $bg_img_name = time() . "." . $images_ext;
            if (!$images->move($dir_path, $bg_img_name)) {
                return \General::error_res("Error In Upload  Image !");
            }
            $data->image = $bg_img_name;
        }
        $result = $data->save();
        if ($result) {
            return \General::success_res("successfully update salon.");
        } else {
            return \General::error_res("something went to worng");
        }
    }
    public static function update_saloon_password($param)
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


