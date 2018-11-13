<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Admin_mes extends Model
{
    //
    public function select()
    {
        // var_dump(session('user_id'));die;
        return $data = DB::table('admin')->where('admin_id',session('user_id'))->first();
    }

    public function doUpdate($data)
    {
        // var_dump($data);die;
        return $state = DB::table('admin')->where('admin_id',session('user_id'))->update([
            'name'=>$data['user'],
            'sex'=>$data['form-field-radio'],
            'phone'=>$data['phone'],
            'email'=>$data['email'],
        ]);
    }

    public function getBlog($key)
    {
        
        return $data = DB::table('blog')->where('type','like','%'.$key.'%')
                                        ->orwhere('content','like','%'.$key.'%')
                                        ->orwhere('adress','like','%'.$key.'%')
                                        ->orwhere('name','like','%'.$key.'%')
                                        // ->orwhere('created_at','like','%'.$key.'%')
                                        ->paginate(2);
    }

    public function select_pwd($pwd)
    {
        return $num = DB::table('admin_login')->where('id',session('user_id'))
                                       ->where('pwd',$pwd)
                                       ->first();
                                             
    }

    public function editpwd($pwd)
    {
        return $num = DB::table('admin_login')->where('id',session('user_id'))
                                              ->update(['pwd'=>$pwd]);
    }
}
