<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    protected $table = 'faq';
    protected $hidden = [];

    public static function addFaq($param = []){
        $tx = new self;
        $tx->query = $param['query'];
        $tx->content = $param['content'];
        $tx->sort_order = $param['sort_order'];
        if($tx->save()){
            return \General::success_res('Faq added successfully.');
        }else{
            return \General::error_res('Something went wrong!');
        }
    }
    public static function updateFaq($param = []){
        $tx = self::where('id',$param['update_id'])->first();
        if(is_null($tx)){
            return \General::error_res('Something went wrong!');
        }
        $tx->query = $param['query'];
        $tx->content = $param['content'];
        $tx->sort_order = $param['sort_order'];
        if($tx->save()){
            return \General::success_res('Faq updated successfully.');
        }else{
            return \General::error_res('Something went wrong!');
        }
    }

    public static function filter($param)
    {
        $obj = self::orderBy('id', 'desc');

        $count = $obj->count();
        $len = $param['itemPerPage'];
        $start = ($param['currentPage'] - 1) * $len;
        $data = $obj->skip($start)->take($len)->get()->toArray();
        $res = \General::success_res();
        $res['data'] = $data;
        $res['start'] = $start;
        $res['total_record'] = $count;
        return $res;
    }
}
