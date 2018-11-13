<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Admin extends Model
{
    //
    public function select($data)
    {
        // var_dump($data);die;
        return $id = DB::table('admin_login')->where('name',$data['user'])
                                      ->where('pwd',$data['pwd'])
                                      ->first();
    }

    public function getRole($data)
    {
        return $type = DB::table('admin_role')
                ->leftJoin('role','admin_role.role_id','=','role.id')
                ->where('admin_role.admin_id',session('user_id'))
                ->get();
    }

    public function insert($data)
    {
        return $state = DB::table('blog')->insertGetId([
            'admin_id'=>session('user_id'),
            'ip'=>$data['ip'],
            'type'=>$data['type'],
            'adress'=>$data['district'],
            'name'=>$data['user'],
        ]);
    }

    public function getuser_mes($id)
    {
        return $data = DB::table('admin')->where('admin_id',$id)->first();
    }
}
