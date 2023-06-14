<?php

namespace App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Attribute extends \Eloquent
{
   protected $table = 'attributes';
   
    protected $fillable = ['name'];
    public $timestamps = false;
    protected $hidden = [];
        public function food() {
            return $this->hasOne('App\Models\Admin\Food', 'id', 'food_id');
        }
        public static function addAttribute($param)
        {
            try{
            $res = \General::success_res('Add attribute successfully.'); 
            if(isset($param['id']) && $param['id'] != null ){
                $attr = self::where('id',$param['id'])->first();
                $res = \General::success_res('Update attribute successfully.'); 
            }else{
                $attr = new self;
            }
            $attr->name=$param['attribute_name']; 
            $attr->food_id=$param['food_id']; 
            $attr->type=$param['type'];
                if($attr->save()){
                    return $res;
                }else{
                    return \General::error_res('somethings went wrong.');
                }
            }catch(Exception $e){
                return \General::error_res('somethings went wrong.');
            }
        }
        public static function filter($param){
            $attr = self::with('food')->latest('id','desc');

            if(isset($param['attribute_name']) && $param['attribute_name'] != ""){
                $attr->where('name',$param['attribute_name']);                
            }
            if(isset($param['food_id']) && $param['food_id'] != ""){
                $attr->where('food_id',$param['food_id']);                
            }
            if(isset($param['type_id']) && $param['type_id'] != ""){
                $attr->where('type',$param['type_id']);                
            }
            $count = $attr->count();
            $len = $param['itemPerPage'];
            $start = ($param['currentPage']-1) * $len;
            $attr = $attr->skip($start)->take($len)->get()->toArray();
            // dd($attr);
            $res['data'] = $attr;
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
            $data = self::get();
            if($data->isEmpty()){
                $data =  [];

            }else{
                $data =  $data->toArray();
            }
            return $data;
        }

}

