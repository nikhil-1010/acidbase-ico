<?php

namespace App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model as Eloquent;

class OurPartner extends \Eloquent
{
   protected $table = 'our_partner';
   
    protected $fillable = ['name'];
    public $timestamps = false;
    protected $hidden = [];
    public function getLogoAttribute($value)
    {
        return url('/public/partner/'.$value);
    }
        public static function addPartner($param)
        {
            try{
                $res = \General::success_res('Add partner successfully.'); 
                if(isset($param['id']) && $param['id'] != null ){
                    $data = self::where('id',$param['id'])->first();
                    $res = \General::success_res('Update partner successfully.'); 
                }else{
                    $data = new self;
                }
                $data->name=$param['name']; 
                if (isset($param['logo']) && is_file($param['logo'])) {
                    if(isset($param['id']) && $param['id'] != null ){
                        $u_image = public_path('partner/').basename($data['logo']); 
                        unlink($u_image);
                    }
                    $dir_path = public_path('partner/');
                    $images = request()->file('logo');
                    $images_ext = $images->getClientOriginalExtension();
                    $bg_img_name = time().".".$images_ext;
                    if(!$images->move($dir_path,$bg_img_name)){
                       return error_res("Error In Upload  Image !");
                    }
                    $data->logo=$bg_img_name;
                }
                if($data->save()){
                    return $res;
                }else{
                    return \General::error_res('somethings went wrong.');
                }
            }catch(Exception $e){
                return \General::error_res('somethings went wrong.');
            }
        }
        public static function filter($param){
            $category = self::latest('id','desc');

            if(isset($param['name']) && $param['name'] != ""){
                $category->where('name',"like","%".$param['name']."%");                
            }
            $count = $category->count();
            $len = $param['itemPerPage'];
            $start = ($param['currentPage']-1) * $len;
            $category = $category->skip($start)->take($len)->get()->toArray();
            $res['data'] = $category;
            $res['total_record'] = $count;
            return $res;
        }
        public static function get_all(){
            $data = self::get();
            if($data->isEmpty()){
                $data =  [];

            }else{
                $data =  $data->toArray();
            }
            return $data;
        }

}

