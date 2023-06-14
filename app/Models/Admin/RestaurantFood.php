<?php

namespace App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model as Eloquent;

class RestaurantFood extends \Eloquent
{
   protected $table = 'restaurant_food';
   
    protected $fillable = ['name'];
    public $timestamps = true;
    protected $hidden = [];
        
        public function restaurant(){
           return $this->hasOne( "\App\Models\Admin\Restaurant",'id','restaurant_id');
        }
        
        public function food(){
           return $this->hasOne( "\App\Models\Admin\Food",'id','food_id');
        }
        public function attribute(){
           return $this->hasMany( "\App\Models\Admin\FoodAttributeList",'restaurant_food_id','id')
           ->join('attributes','attributes.id','food_attribute_list.attribute_id');
        }
        public function restaurant_food_category(){
           return $this->hasMany( "\App\Models\Admin\RestaurantFoodCategory",'restaurant_food_id','id')
                   ->join('category', function($join){
                       $join->on('category.id', '=', 'restaurant_food_category.category_id');
                    });
        }

        public function getImageAttribute($value)
        {
            if(isset($value)){
                $value = url('/public/food/'.$value);
            }
            return $value;
        }
        
        public static function addFood($param)
        {
            try{
             $res = \App\Models\Admin\Restaurant::where('id',$param['restaurant_id'])->first();
             if($res['status'] != 1){
                return \General::error_res('This Restaurant not Actived.');
             }
            if(isset($param['id']) && $param['id'] != null ){
                $data = self::where('id',$param['id'])->first();
                $param['food_id'] = $data->food_id;
                \App\Models\Admin\RestaurantFoodCategory::where('restaurant_food_id',$param['id'])->delete();
            }else{
                $data = new self;
                $data->food_id=$param['food_id']; 
            }
            $data->restaurant_id=$param['restaurant_id']; 
            $data->price=$param['price'];
            $data->restaurant_price=$param['restaurant_price'];
            if (request()->hasFile('image')) {
                if(isset($param['id']) && $param['id'] != null ){
                    $unlink_image = basename($data['image']);
                    $u_image = public_path('food/').$unlink_image;
                    unlink($u_image);

                }
                $image =request()->file('image');

                $destinationPath = 'public/food/';
                $file_name = time() . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $file_name);
                $data->image=$file_name;
            }
            // dd($param);
            if($data->save()){
                foreach ($param['category'] as $key => $value) {
                    $category = new \App\Models\Admin\RestaurantFoodCategory;
                    $category->restaurant_food_id = $data->id;
                    $category->category_id = $value;
                    $category->save();
                }

                \App\Models\Admin\FoodAttributeList::where('restaurant_food_id',$data->id)->delete();

                if(isset($param['attributes']) && !empty($param['attributes'])){
                    foreach ($param['attributes'] as $value) {
                        
                        $attr = array(
                            "restaurant_id" => $param['restaurant_id'],
                            "food_id" => $param['food_id'],
                            "attribute_id" => $value,
                            "restaurant_price" => $param['restaurant_price_'.$value],
                            "customer_price" => $param['price_'.$value],
                            "restaurant_food_id" => $data->id
                        );
                        // \App\Models\Admin\FoodAttributeList::where('restaurant_food_id',$data->id)->where('attribute_id',$value)->delete();
                        \App\Models\Admin\FoodAttributeList::add_food_attribute($attr);
                    }
                }

                return \General::success_res('Add food successfully.'); 
            }else{
                return \General::error_res('somethings went wrong.');
            }
            }catch(Exception $e){
                return \General::error_res('somethings went wrong.');
            }
        }
        public static function filter($param){
            $data = self::with(['restaurant','food','restaurant_food_category'])->latest('id','desc');

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
                $category = \App\Models\Admin\RestaurantFoodCategory::where('category_id',$param['category_id'])->get('restaurant_food_id')->toArray();
               $data->whereIn('id',$category);                
            }
            if(isset($param['restaurant_id']) && $param['restaurant_id'] != ""){
                $data->where('restaurant_id',$param['restaurant_id']);                
            }
            // dd($param);
            if(isset($param['price']) && $param['price'] != ""){
                if(isset($param['type']) && $param['type'] == "less"){
                    // dd($param);
                    $data->where('price',"<=",$param['price']);                
                }else{
                    $data->where('price',$param['price']);                
                }
            }
            $count = $data->count();
            $len =isset($param['itemPerPage']) ? $param['itemPerPage'] : "";
            $start =isset($param['currentPage']) ? ($param['currentPage']-1) * $len :"";
            $data = $data->skip($start)->take($len)->get()->toArray();
            // dd($data);
            $view_count = count($data);
            $res['total_page_data'] = $view_count;
            $res['start'] = $start;
            $res['data'] = $data;
            $res['total_record'] = $count;

            return $res;
        }

        public static function food_filter($param){
            $data = self::with(['restaurant','food','restaurant_food_category','attribute'])->latest('id','desc');
            if(isset($param['lat']) && $param['long']){
        
                $lat = $param['lat'];
                $lon = $param['long'];
                $distance=app('settings')['search_food_radius'];
                $R = 6000; //constant earth radius. You can add precision here if you wish
                $maxLat = $lat + rad2deg($distance/$R);
                $minLat = $lat - rad2deg($distance/$R);
                $maxLon = $lon + rad2deg(asin($distance/$R) / cos(deg2rad($lat)));
                $minLon = $lon - rad2deg(asin($distance/$R) / cos(deg2rad($lat)));
                $param['minLon'] = $minLon;
                $param['maxLon'] = $maxLon;
                $data = $data->whereHas('restaurant', function ($query) use ($param) {
                            $query->where('longitude','>=',$param['minLon'])->where('longitude','<=',$param['maxLon'])->where("status",1);
                        });
                
                // $res_data = $res_data->where('longitude','>=',$minLon)->where('longitude','<=',$maxLon)->get()->toArray();
            }
            if(isset($param['salon'])){
                $saloon = \App\Models\Admin\Saloon::where("id",$param['salon'])->where('status',1)->first();
                // dd($saloon);
                $lat = $saloon['latitude'];
                $lon = $saloon['longitude'];
                $distance=app('settings')['search_food_radius'];
                $R = 6000; //constant earth radius. You can add precision here if you wish
                $maxLat = $lat + rad2deg($distance/$R);
                $minLat = $lat - rad2deg($distance/$R);
                $maxLon = $lon + rad2deg(asin($distance/$R) / cos(deg2rad($lat)));
                $minLon = $lon - rad2deg(asin($distance/$R) / cos(deg2rad($lat)));
                // dd($maxLat,$minLat,$maxLon,$minLon);
                // $sal_data = \App\Models\Admin\Restaurant::with(['food'])->where("status",1)->where('is_open',1)->where('latitude','>=',$minLat)->where('latitude','<=',$maxLat);
                // $sal_data = $sal_data->where('longitude','>=',$minLon)->where('longitude','<=',$maxLon)->get()->toArray();
                $param['minLon'] = $minLon;
                $param['maxLon'] = $maxLon;
                $data = $data->whereHas('restaurant', function ($query) use ($param) {
                            $query->where('longitude','>=',$param['minLon'])->where('longitude','<=',$param['maxLon'])->where("status",1);
                        });
                
            }
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
            if(isset($param['category_id']) && $param['category_id'] != "" && $param['category_id'] != 0){
                $category = \App\Models\Admin\RestaurantFoodCategory::where('category_id',$param['category_id'])->get('restaurant_food_id')->toArray();
                $data->whereIn('id',$category);
            }
            if(isset($param['restaurant_id']) && $param['restaurant_id'] != ""){
                $data->where('restaurant_id',$param['restaurant_id']);                
            }
            // dd($param);
            if(isset($param['price']) && $param['price'] != ""){
                if(isset($param['type']) && $param['type'] == "less"){
                    // dd($param);
                    $data->where('price',"<=",$param['price']);                
                }else{
                    $data->where('price',$param['price']);                
                }
            }
            $count = $data->count();
            $len =isset($param['itemPerPage']) ? $param['itemPerPage'] : "";
            $start =isset($param['currentPage']) ? ($param['currentPage']-1) * $len :"";
            $data = $data->skip($start)->take($len)->get()->toArray();
            // dd($data);
            $view_count = count($data);
            $res['total_page_data'] = $view_count;
            $res['start'] = $start;
            $res['data'] = $data;
            $res['total_record'] = $count;

            return $res;
        }
        public static function front_food_filter($param){
            $data = self::with(['restaurant','food','restaurant_food_category','attribute'])->latest('id','desc');
            if(isset($param['lat']) && $param['long']){
        
                $lat = $param['lat'];
                $lon = $param['long'];
                $distance=app('settings')['search_food_radius'];
                $R = 6000; //constant earth radius. You can add precision here if you wish
                $maxLat = $lat + rad2deg($distance/$R);
                $minLat = $lat - rad2deg($distance/$R);
                $maxLon = $lon + rad2deg(asin($distance/$R) / cos(deg2rad($lat)));
                $minLon = $lon - rad2deg(asin($distance/$R) / cos(deg2rad($lat)));
                $param['minLon'] = $minLon;
                $param['maxLon'] = $maxLon;
                $data = $data->whereHas('restaurant', function ($query) use ($param) {
                            $query->where('longitude','>=',$param['minLon'])->where('longitude','<=',$param['maxLon'])->where("status",1);
                        });
                
                // $res_data = $res_data->where('longitude','>=',$minLon)->where('longitude','<=',$maxLon)->get()->toArray();
            }
            if(isset($param['salon'])){
                $saloon = \App\Models\Admin\Saloon::where("id",$param['salon'])->where('status',1)->first();
                // dd($saloon);
                $lat = $saloon['latitude'];
                $lon = $saloon['longitude'];
                $distance=app('settings')['search_food_radius'];
                $R = 6000; //constant earth radius. You can add precision here if you wish
                $maxLat = $lat + rad2deg($distance/$R);
                $minLat = $lat - rad2deg($distance/$R);
                $maxLon = $lon + rad2deg(asin($distance/$R) / cos(deg2rad($lat)));
                $minLon = $lon - rad2deg(asin($distance/$R) / cos(deg2rad($lat)));
                // dd($maxLat,$minLat,$maxLon,$minLon);
                // $sal_data = \App\Models\Admin\Restaurant::with(['food'])->where("status",1)->where('is_open',1)->where('latitude','>=',$minLat)->where('latitude','<=',$maxLat);
                // $sal_data = $sal_data->where('longitude','>=',$minLon)->where('longitude','<=',$maxLon)->get()->toArray();
                $param['minLon'] = $minLon;
                $param['maxLon'] = $maxLon;
                $data = $data->whereHas('restaurant', function ($query) use ($param) {
                            $query->where('longitude','>=',$param['minLon'])->where('longitude','<=',$param['maxLon'])->where("status",1);
                        });
                
            }
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
            if(isset($param['category_id']) && $param['category_id'] != "" && $param['category_id'] != 0){
                $category = \App\Models\Admin\RestaurantFoodCategory::where('category_id',$param['category_id'])->get('restaurant_food_id')->toArray();
                $data->whereIn('id',$category);
            }
            if(isset($param['restaurant_id']) && $param['restaurant_id'] != ""){
                $data->where('restaurant_id',$param['restaurant_id']);                
            }
            // dd($param);
            if(isset($param['price']) && $param['price'] != ""){
                if(isset($param['type']) && $param['type'] == "less"){
                    // dd($param);
                    $data->where('price',"<=",$param['price']);                
                }else{
                    $data->where('price',$param['price']);                
                }
            }
            $data->whereHas('restaurant',function($q) use ($param){
                $q->where('status',"1");
            });
            $count = $data->count();
            $len =isset($param['itemPerPage']) ? $param['itemPerPage'] : "";
            $start =isset($param['currentPage']) ? ($param['currentPage']-1) * $len :"";
            $data = $data->skip($start)->take($len)->get()->toArray();
            // dd($data);
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

