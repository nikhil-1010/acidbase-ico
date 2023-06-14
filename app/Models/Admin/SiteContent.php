<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    use HasFactory;
    protected $table = 'site_contents';
    protected $fillable = ['page','contents'];

    public static function setContent($param){
        try {
            $content = self::updateOrCreate(['page' => $param['site_page']],['contents' => $param['site_content']]);
            $res = \General::success_res('Content Update successfully.');
            return $res;
        }catch (\Illuminate\Database\QueryException $ex) {
            $res = \General::error_res('Something went wrong!!');
            return $res; 
        }
    }
    public static function getContent($param){
        $checkContent = self::where('page',$param['page'])->first();
        $res = \General::success_res();
        $res['content'] = $checkContent;
        return $res;
    }
}
