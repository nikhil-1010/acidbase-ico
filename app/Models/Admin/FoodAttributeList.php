<?php

namespace App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model as Eloquent;

class FoodAttributeList extends \Eloquent
{
   protected $table = 'food_attribute_list';
   
    protected $fillable = ['name'];
    public $timestamps = false;
    protected $hidden = [];
    
    public function food() {
        return $this->hasOne('App\Models\Admin\Food', 'food_id', 'id');
    }
    public function attribute() {
        return $this->hasOne('App\Models\Admin\Attribute', 'id', 'attribute_id')->select('name','id','type');
    }

    public function getCustomerPriceAttribute($value)
    {
        return number_format($value,'2','.','');
    }
    public function getRestaurantPriceAttribute($value)
    {
        return number_format($value,'2','.','');
    }

    public static function add_food_attribute($param)
    {
        try{
            $res = \General::success_res('Add Food attribute successfully.'); 
            if(isset($param['id']) && $param['id'] != null ){
                $attr = self::where('id',$param['id'])->first();
                $res = \General::success_res('Update attribute successfully.'); 
            }else{
                $attr = new self;
            }
            $attr->food_id=$param['food_id']; 
            $attr->attribute_id=$param['attribute_id']; 
            $attr->restaurant_id=$param['restaurant_id']; 
            $attr->restaurant_price=$param['restaurant_price']; 
            $attr->customer_price=$param['customer_price']; 
            $attr->restaurant_food_id=$param['restaurant_food_id']; 
            if($attr->save()){
                return $res;
            }else{
                return \General::error_res('somethings went wrong.');
            }
        }catch(Exception $e){
            return \General::error_res('somethings went wrong.');
        }
    }
}

