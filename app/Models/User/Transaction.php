<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $hidden = [];
    protected $appends = ['explorer'];

    public static function getExplorerAttribute($value)
    {
        $url = 'https://sepolia.etherscan.io/tx/';
        if(env('APP_ENV') != 'local'){
            $url = 'https://etherscan.io/tx/';
        }
        return $url;
    }

    public static function addTransactionHistory($param = []){
        $tx = new self;
        $tx->trx_id = $param['trx_id'];
        $tx->investor_address = $param['investor_address'];
        $tx->paid_amount = $param['paid_amount'];
        $tx->token_amount = $param['token_amount'];
        $tx->sale_type = $param['sale_type'];
        if(isset($param['status']))
            $tx->status = $param['status'];
        if($tx->save()){
            return \General::success_res('Transaction add successfully.');
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
        if (isset($param['investor_address']) && $param['investor_address'] != '') {
            $obj->where('investor_address', $param['investor_address']);
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
