<?php

namespace App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Query extends \Eloquent
{
   protected $table = 'query';
   
    protected $fillable = ['subject_id', 'user_id','query'];
    public $timestamps = false;
    protected $hidden = [];
        
    public function subject()
    {
        return $this->hasOne(QuerySubject::class,'id','subject_id');
    }
    public function user()
    {
        return $this->hasOne(\App\Models\User\Users::class,'id','user_id')->select('id','name','email');
    }
    public function dropzone_user()
    {
        return $this->hasOne(\App\Models\User\Dropzone::class,'user_id','user_id')->select('id','user_id','name','email1');
    }

    public static function dropzone_filter_query($param)
    {

        // $users = self::join('user_plans', 'users.subscribe_plan_id', 'user_plans.id')
        //     ->select('users.*', 'user_plans.name as plan_name', 'user_plans.earning_rate')
        //     ->orderBy('users.id', 'desc');

        $users = self::with('subject','dropzone_user','user')->orderBy('id','DESC');
       
        $users = $users->whereHas('subject', function($query) {
            $query->where('type', 1);
        });
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
        $param['itemPerPage'] ?? $param['itemPerPage'] = 10;
        $param['currentPage'] ?? $param['currentPage'] = 1;
        $count = $users->count();
        $len = $param['itemPerPage'];
        $start = ($param['currentPage'] - 1) * $len;
        $users = $users->skip($start)->take($len)->get()->toArray();
        // dd($users);
        $res['data'] = $users;
        $res['total_record'] = $count;
        return $res;
    }

    public static function skydiver_filter_query($param)
    {

        // $users = self::join('user_plans', 'users.subscribe_plan_id', 'user_plans.id')
        //     ->select('users.*', 'user_plans.name as plan_name', 'user_plans.earning_rate')
        //     ->orderBy('users.id', 'desc');

        $users = self::with('subject','user')->orderBy('id','DESC');
       
        $users = $users->whereHas('subject', function($query) {
            $query->where('type', 2);
        });
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
        $param['itemPerPage'] ?? $param['itemPerPage'] = 10;
        $param['currentPage'] ?? $param['currentPage'] = 1;
        $count = $users->count();
        $len = $param['itemPerPage'];
        $start = ($param['currentPage'] - 1) * $len;
        $users = $users->skip($start)->take($len)->get()->toArray();
        // dd($users);
        $res['data'] = $users;
        $res['total_record'] = $count;
        return $res;
    }
    public static function my_query($user_id){

        $query_list = self::where('user_id',$user_id)->orderBy('id','DESC')->get()->toArray();
        $res = \General::success_res('success');
        $res['data'] = $query_list;
        return $res;
    }

    public static function addQuery($param)
    {
        $obj = new self;
        $obj->query = $param['query'];
        $obj->subject_id = $param['subject_id'];
        $obj->user_id = $param['user_id'];

        $subject = \App\Models\Admin\QuerySubject::where('id',$param['subject_id'])->first();
        $subject->query_count = $subject->query_count + 1;
        $subject->save();

        if($obj->save()){
            return \General::success_res('Query added successfully.');
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

