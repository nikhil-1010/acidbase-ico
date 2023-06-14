<?php

namespace App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Food extends \Eloquent
{
   protected $table = 'food';
   
    protected $fillable = ['name'];
    public $timestamps = true;
    protected $hidden = [];
        
        // public function category(){
        //    return $this->hasOne( "\App\Models\Admin\Category",'id','category_id');
        // }

        public function food_category(){
            return $this->hasMany("\App\Models\Admin\FoodCategory","food_id","id")
                    ->join('category', function($join){
                       $join->on('category.id', '=', 'food_category.category_id');
                    });
        }

        public function getImagesAttribute($value)
        {
            
            $images = json_decode($value);
            $images_url = [];
            if(is_null($images) || empty($images)){
                array_push($images_url,url('public/assets/images/dummy-food.jpg')) ;
            }else{
                foreach ($images as $key => $value) {
                   $images_url[] = url('/public/food/'.$value);
                }
            }
            return json_encode($images_url);
        }
        
        public static function addFood($param)
        {
            try{
            $res = \General::success_res('Add Food successfully.');
            if(isset($param['id']) && $param['id'] != null ){
                $data = self::where('id',$param['id'])->first();
                \App\Models\Admin\FoodCategory::where('food_id',$param['id'])->delete();
                $res = \General::success_res('Update Food successfully.');
            }else{
                $data = new self;
            }
            $images_name = [];
            $i = 0;
            if (request()->hasFile('images')) {
                if(isset($param['id']) && $param['id'] != null ){
                    $unlink_images = json_decode($data['images']);
                    foreach ($unlink_images as $im) {
                       $images_name[] = basename($im); 
                    }
                }
                $image =request()->file('images');
                foreach ($image as $files) {
                    $i++;
                    $destinationPath = 'public/food/';
                    $file_name = $i.time() . "." . $files->getClientOriginalExtension();
                    $files->move($destinationPath, $file_name);
                    $images_name[] = $file_name;
                }
                $data->images=json_encode($images_name,true); 
            }
            $data->name=$param['name']; 
            $data->meta_title=$param['meta_title']; 
            $data->meta_description=$param['meta_description']; 
            $data->meta_keywords=$param['meta_keywords']; 
            $data->description=$param['description'];
            $data->search_matches=$param['search_matches'];
                if($data->save()){
                    foreach ($param['category'] as $key => $value) {
                        $obj = new \App\Models\Admin\FoodCategory;
                        $obj->food_id = $data->id;
                        $obj->category_id = $value;
                        $obj->save();
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
            // dd($param);
            $data = self::with(['food_category']); //->latest('id','desc');

            if(isset($param['name']) && $param['name'] != ""){
                $data->where('name','LIKE','%'.$param['name'].'%');                
            }
            if(isset($param['sort']) && $param['sort'] != ""){
                $data->orderBy('name',$param['sort']);                
                // dd($data->get()->toArray());
            }else{
                $data->orderBy('id','desc');
            }
            if(isset($param['category_id']) && $param['category_id'] != ""){
                $category = \App\Models\Admin\FoodCategory::where('category_id',$param['category_id'])->get('food_id')->toArray();
                $data->whereIn('id',$category);
                // $data->where('category_id',$param['category_id']);                
            }
            if(isset($param['meta_title']) && $param['meta_title'] != ""){
                $data->where('meta_title',$param['meta_title']);                
            }
            if(isset($param['meta_description']) && $param['meta_description'] != ""){
                $data->where('meta_description',$param['meta_description']);                
            }
             if(isset($param['meta_keywords']) && $param['meta_keywords'] != ""){
                $data->where('meta_keywords',$param['meta_keywords']);                
            }
            $count = $data->count();
            $len = $param['itemPerPage'];
            $start = ($param['currentPage']-1) * $len;
            $data = $data->skip($start)->take($len)->get()->toArray();
            // dd($data);
            if(isset($param['sort']) && $param['sort'] != ""){
                if($param['sort'] == 'desc'){
                    $res['sort_value'] = 'desc';    
                }else{
                    $res['sort_value'] = 'asc';    
                }
                $res['is_sort'] = true;
            }else{
                $res['sort_value'] = 'desc'; 
                $res['is_sort'] = false;
            }
            $res['data'] = $data;
            $res['total_record'] = $count;
            return $res;
        }
        public static function removeImage($param){
            $first = self::where('id',$param['id'])->first();
            // dd($param,$first);
            if(is_null($first)){
                return \General::error_res('somethings went wrong.');
            }else{
                $images = json_decode($first['images']);
                $u_image = public_path('food/').basename($images[$param['index']]);
                unset($images[$param['index']]); 
                $im = [];
                foreach ($images as $i) {
                    $im[] = basename($i);
                }
                unlink($u_image);
                $first->images =json_encode($im,true);
                $first->save();

                return \General::success_res('Delete image successfully.');
            }
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

