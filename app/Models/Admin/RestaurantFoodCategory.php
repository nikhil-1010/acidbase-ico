<?php

namespace App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model as Eloquent;

class RestaurantFoodCategory extends \Eloquent
{
   protected $table = 'restaurant_food_category';
   
    protected $fillable = ['name'];
    public $timestamps = false;
    protected $hidden = [];
        
        public function restaurant(){
           return $this->hasOne( "\App\Models\Admin\Restaurant",'id','restaurant_id');
        }
        public function food(){
           return $this->hasOne("\App\Models\Admin\Food",'id','food_id');
        }
        
        public static function filter($param){
            $data = self::with(['restaurant','food'])->latest('id','desc');

            // if(isset($param['price']) && $param['price'] == ""){
            //     $param['price'] = $param['price'];
            // }else{
            //     $param['price'] = 1;
            // }
            if(isset($param['status']) && $param['status'] != ""){
                $data->where('status',$param['status']);                
            }
            if(isset($param['name']) && $param['name'] != "" ){
               $data->whereHas('food',function($q) use ($param){
                    $q->where('name',"like","%".$param['name']."%");
               });
            }
            if(isset($param['food_id']) && $param['food_id'] != ""){
               $data->where('food_id',$param['food_id']);                
            }
            if(isset($param['category_id']) && $param['category_id'] != ""){
               $data->where('category_id',$param['category_id']);                
            }
            if(isset($param['restaurant_id']) && $param['restaurant_id'] != ""){
                $data->where('restaurant_id',$param['restaurant_id']);                
            }
            // dd($param);
            if(isset($param['price']) && $param['price'] != ""){
                if(isset($param['type']) && $param['type'] == "less"){
                    // dd($param);
                    $data->where('price',"<",$param['price']);                
                }else{
                    $data->where('price',$param['price']);                
                }
            }
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
        }
        public static function get_all(){
            $data = self::with(['food','restaurant'])->where('status',1)->get();
            if($data->isEmpty()){
                $data =  [];

            }else{
                $data =  $data->toArray();
            }
            return $data;
        }
}

