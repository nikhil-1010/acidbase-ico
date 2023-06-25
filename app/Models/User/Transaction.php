<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $fillable = ['name', 'val', 'autoload'];
    public $timestamps = false;
    protected $hidden = [];
    protected $append = ['url_explorer'];

    public function getExplorer()
    {
        $url = 'https://sepolia.etherscan.io/tx/'.$this->trx_id;
        if(env('APP_ENV') != 'local'){
            $url = 'https://etherscan.io/tx/'.$this->trx_id;
        }
        return $url;
    }

    public static  function addTransactionHistory($param = []){
        $tx = new self;
        $tx->sale_type = $param['sale_type'];
        $tx->token_address = $param['token_address'];
        $tx->trx_id = $param['trx_id'];
        $tx->investor = $param['investor_address'];
        $tx->token_amount = $param['token_amount'];
        $tx->usd_amount = $param['usd_amount'];
        if($tx->save()){
            return \General::success_res('Investor add successfully');
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
            $obj->where('investor', $param['investor_address']);
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
