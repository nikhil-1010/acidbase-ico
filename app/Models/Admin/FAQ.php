<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Faq extends \Eloquent
{
   protected $table = 'faq';
   
    protected $fillable = ['sort_id', 'question','answer'];
    protected $hidden = [];

    public static function doAddFaq($param){
        try {
            $faq = new self;
            $faq->sort_id = $param['sort_id'];
            $faq->question = $param['question'];
            $faq->answer = $param['answer'];
            if ($faq->save()) {
                $res = \General::success_res('Faq added successfully.');
            }else{
                $res = \General::error_res('Something went wrong!!');
            }
            return $res;
        }catch (\Illuminate\Database\QueryException $ex) {
            $res = \General::error_res('Something went wrong!!');
            return $res; 
        }
    }
    public static function deleteFaq($param){
        try {
            $faq = self::where('id',$param['delete_id'])->first();
            if ($faq->delete()) {
                $res = \General::success_res('Faq Deleted Successfully.');
            }else{
                $res = \General::info_res('Something Went Wrong!!');
            }
            return $res;
         }catch(\Illuminate\Database\QueryException $ex){
            $res = \General::error_res('Something Went wrong!!');
          return $res;
        }

    }
    public static function doUpdateFaq($param) {
    
        try {
            $faq =  self::where('id',$param['faq_id'])->first();
            $faq->sort_id = $param['sort_id'];
            $faq->question = $param['question'];
            $faq->answer = $param['answer'];
            $faq->save();
            
        } catch (Exception $e) {
            error_res("Something went wrong !");
        }
        return \General::success_res('Faq update successfully.'); 
    }
    public static function filter_faq($param){
    
        $faq = self::orderBy('id','desc');
        if(isset($param['name']) && $param['name'] != ''){
            $faq = $faq->where('question',"LIKE","%".$param['name']."%");
        }
        $count = $faq->count();
        $len = $param['itemPerPage'];
        $start = ($param['currentPage']-1) * $len;
        
        $faq = $faq->skip($start)->take($len)->get()->toArray();
        $res['data'] = $faq;
        $res['total_record'] = $count;
        
        return $res;
    }
    public static function getFaq(){
        $faq = self::orderBy('sort_id')->get()->toArray();
        return $faq;
    }
        

}

