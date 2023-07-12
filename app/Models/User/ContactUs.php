<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;
    protected $table = 'contact_us';
    protected $hidden = [];

    public static function addContact($param = []){
        $tx = new self;
        $tx->name = $param['name'];
        $tx->email = $param['email'];
        $tx->subject = $param['subject'];
        $tx->message = $param['message'];
        if($tx->save()){
            return \General::success_res('Message send successfully.');
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
