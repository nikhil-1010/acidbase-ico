<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    use HasFactory;
    protected $table = 'site_content';
    protected $hidden = [];

    public static function setContent($param = []){
        $content = self::where('name',$param['name'])->first();
        $content->content = $param['content'];
        if($content->save()){
            return \General::success_res('Content updated successfully.');
        }else{
            return \General::error_res('Something went wrong!');
        }
    }

    public static function getContent($param)
    {
        $obj = self::where('name',$param['name'])->first()->toArray();
        $res = \General::success_res();
        $res['data'] = $obj['content'];
        return $res;
    }
}
