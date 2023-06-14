<?php

namespace App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Category extends \Eloquent
{
   protected $table = 'category';
   
    protected $fillable = ['name'];
    public $timestamps = false;
    protected $hidden = [];
        public function food() {
            return $this->hasMany('App\Models\Food', 'category_id', 'id');
        }
        public static function addCategory($param)
        {
            try{
            $res = \General::success_res('Add category successfully.'); 
            if(isset($param['id']) && $param['id'] != null ){
                $category = self::where('id',$param['id'])->first();
                $res = \General::success_res('Update category successfully.'); 
            }else{
                $category = new self;
            }
            $category->name=$param['category_name']; 
            $category->meta_title=$param['meta_title']; 
            $category->meta_description=$param['meta_description']; 
            $category->meta_keywords=$param['meta_keywords']; 
                if($category->save()){
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

            if(isset($param['category_name']) && $param['category_name'] != ""){
                $category->where('name',$param['category_name']);                
            }
            if(isset($param['meta_title']) && $param['meta_title'] != ""){
                $category->where('meta_title',$param['meta_title']);                
            }
            if(isset($param['meta_description']) && $param['meta_description'] != ""){
                $category->where('meta_description',$param['meta_description']);                
            }
             if(isset($param['meta_keywords']) && $param['meta_keywords'] != ""){
                $category->where('meta_keywords',$param['meta_keywords']);                
            }
            $count = $category->count();
            $len = $param['itemPerPage'];
            $start = ($param['currentPage']-1) * $len;
            $category = $category->skip($start)->take($len)->get()->toArray();
            $res['data'] = $category;
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

