<?php

namespace App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model as Eloquent;

class QuerySubject extends \Eloquent
{
   protected $table = 'query_subject';
   
    protected $fillable = ['subject', 'query_count'];
    public $timestamps = false;
    protected $hidden = [];
        
    public static function dropzone_filter_subject($param)
    {

        // $users = self::join('user_plans', 'users.subscribe_plan_id', 'user_plans.id')
        //     ->select('users.*', 'user_plans.name as plan_name', 'user_plans.earning_rate')
        //     ->orderBy('users.id', 'desc');

        $users = self::where('type',1);
       
        if (isset($param['name']) && $param['name'] != '') {
            $users = $users->where('association_name', 'like', '%' . $param['name'] . '%');
         }
        if (isset($param['user_name_search']) && $param['user_name_search'] != '') {
            $users->where(function ($e) use ($param) {
                $e->where('users.username', 'like', '%' . $param['user_name_search'] . '%');
            });
        }
        if (isset($param['email']) && $param['email'] != '') {
            $users = $users->where('users.email', $param['email']);
        }
        if (isset($param['startDate']) && $param['startDate'] != '' && isset($param['endDate']) && $param['endDate'] != '') {
            $users->whereBetween('users.created_at', array($param['startDate'] . ' 00:00:00', $param['endDate'] . ' 23:59:59'));
        }
        $param['itemPerPage'] = 100;
        $param['currentPage'] = 1;
        $count = $users->count();
        $len = $param['itemPerPage'];
        $start = ($param['currentPage'] - 1) * $len;
        $users = $users->skip($start)->take($len)->get()->toArray();

        $res['data'] = $users;
        $res['total_record'] = $count;
        return $res;
    }

    public static function skydiver_filter_subject($param)
    {

        // $users = self::join('user_plans', 'users.subscribe_plan_id', 'user_plans.id')
        //     ->select('users.*', 'user_plans.name as plan_name', 'user_plans.earning_rate')
        //     ->orderBy('users.id', 'desc');

        $users = self::where('type',2);
       
        if (isset($param['name']) && $param['name'] != '') {
            $users = $users->where('association_name', 'like', '%' . $param['name'] . '%');
         }
        if (isset($param['user_name_search']) && $param['user_name_search'] != '') {
            $users->where(function ($e) use ($param) {
                $e->where('users.username', 'like', '%' . $param['user_name_search'] . '%');
            });
        }
        if (isset($param['email']) && $param['email'] != '') {
            $users = $users->where('users.email', $param['email']);
        }
        if (isset($param['startDate']) && $param['startDate'] != '' && isset($param['endDate']) && $param['endDate'] != '') {
            $users->whereBetween('users.created_at', array($param['startDate'] . ' 00:00:00', $param['endDate'] . ' 23:59:59'));
        }
        $param['itemPerPage'] = 100;
        $param['currentPage'] = 1;
        $count = $users->count();
        $len = $param['itemPerPage'];
        $start = ($param['currentPage'] - 1) * $len;
        $users = $users->skip($start)->take($len)->get()->toArray();

        $res['data'] = $users;
        $res['total_record'] = $count;
        return $res;
    }

    public static function addSubject($param)
    {
        $obj = new self;
        $obj->subject = $param['query_subject'];
        $obj->type = $param['type'];

        if($obj->save()){
            return \General::success_res('Subject added successfully.');
        }else{
            return \General::error_res('Something went wrong !!');
        }
    }

    public static function UpdateSubject($param)
    {
        $obj = self::where('id',$param['update_id'])->first();
        if($obj != null){

            $obj->subject = $param['edit_name'];
    
            if($obj->save()){
                return \General::success_res('Subject updated successfully.');
            }else{
                return \General::error_res('Something went wrong !!');
            }
        }
        else{
            return \General::error_res('Association not found.');
        }
    }
    
}

