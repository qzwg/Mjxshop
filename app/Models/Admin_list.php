<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Admin_list extends Model
{
    //
    public function insert($data,$id)
    {
        // var_dump($data);die;
        return $data = DB::table('admin')->insertGETId([
            'admin_id'=>$id,
            'name'=>$data['user-name'],
            'pwd'=>$data['userpassword'],
            'sex'=>$data['form-field-radio'],
            'phone'=>$data['user-tel'],
            'email'=>$data['email'],
            'role_name'=>$data['admin-role'],
            'explain'=>$data['content'],
        ]);
    }

    public function getRole()
    {   
        return $data = DB::table('role')->get();
    }

    public function getadmin_mes($key)
    {
        return $data = DB::table('admin')
                            ->where('id','like','%'.$key.'%')
                            ->orwhere('name','like','%'.$key.'%')
                            ->orwhere('sex','like','%'.$key.'%')
                            ->orwhere('phone','like','%'.$key.'%')
                            ->orwhere('email','like','%'.$key.'%')
                            ->orwhere('role_name','like','%'.$key.'%')
                            ->orwhere('created_at','like','%'.$key.'%')
                            ->orwhere('explain','like','%'.$key.'%')
                            ->paginate(2);
    }

    public function login_insert($data)
    {
        return $data = DB::table("admin_login")->insertGetId([
            'name'=>$data['user-name'],
            'pwd'=>$data['userpassword'],
        ]);
    }

    public function role_mes($type)
    {

        return $data = DB::table('admin')->where('role_name',$type)->paginate(2);
    }

    public function admin_role()
    {
        return $data = DB::table('role')->get();

    }

    public function getAdminMes($id)
    {
        return $data = DB::table('admin')->where('id',$id)->first();
    }

    public function edit_admin_mes($data)
    {   
        var_dump($data);
        $role = DB::table('role')->select('control')->where('id',$data['admin-role'])->first();
        $role = $role->control;
        // var_dump($role);die;
        return $data = DB::table('admin')->where('id',$data['id'])->update([
                            'name'=>$data['user-name'],
                            'pwd'=>$data['userpassword'],
                            'sex'=>$data['form-field-radio'],
                            'phone'=>$data['user-tel'],
                            'email'=>$data['email'],
                            'role_name'=>$role,
                            'explain'=>$data['content'],
                            ]);
    }

    public function update_login($data)
    {
        return $data = DB::table('admin_login')->where('id',$data['admin_id'])->update([
            'name'=>$data['user-name'],
            'pwd'=>$data['userpassword'],
        ]);
    }

    public function update_ar($data)
    {
        return $data = DB::table('admin_role')->where('admin_id',$data['admin_id'])->update([
            'role_id'=>$data['admin-role'],
        ]);
    }
}
