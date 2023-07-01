<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whitelist extends Model
{
    use HasFactory;
    protected $table = 'whitelist';
    protected $hidden = [];

    public static function addWhitelist($param = []){
        $tx = new self;
        $tx->address = $param['address'];
        $tx->sale_type = $param['sale_type'];
        if($tx->save()){
            return \General::success_res('Address added to whitelist.');
        }else{
            return \General::error_res('Something went wrong!');
        }
    }

    public static function filter($param)
    {
        $obj = self::orderBy('id', 'desc');
        if (isset($param['sale_type']) && $param['sale_type'] != '') {
            $obj->where('sale_type', $param['sale_type']);
        }
        if (isset($param['address']) && $param['address'] != '') {
            $obj->where('address', $param['address']);
        }
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
