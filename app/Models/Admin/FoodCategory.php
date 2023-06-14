<?php

namespace App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model as Eloquent;

class FoodCategory extends \Eloquent
{
   protected $table = 'food_category';
   
    protected $fillable = [];
    public $timestamps = false;
    protected $hidden = [];
        
    public function category(){
       return $this->hasOne( "\App\Models\Admin\Category",'id','category_id');
    }

}

