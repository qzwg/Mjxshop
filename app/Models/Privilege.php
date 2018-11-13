<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Privilege extends Model
{
    //
    public function getPri()
    {
        $role = DB::table('role')->get();
        // var_dump($role);
        // $role_name = [];
        foreach($role as $k=>$v)
        { //$v->id
            $role_name = DB::select('
            select a.role_id as id,GROUP_CONCAT(b.name) name
            from shop_admin_role a
            left join shop_admin b on b.admin_id = a.admin_id
            where a.role_id = '.$v->id.' GROUP BY a.role_id  
            limit 1          
            ');

            if(count($role_name))
            {
                $v->admin = $role_name[0]->name;
                // var_dump(count(explode(',',$role_name[0]->name)));die;
                $v->num = count(explode(',',$role_name[0]->name));
                // var_dump($v);
            }
            else
            {
                $v->admin = '';
                $v->num = 0;
            }
        }
        return $role;
        
    }

    public function getrole()
    {
        return $data = DB::table('role')->get();
    }

    public function privilege()
    {
        return $data = DB::table('privilege')->get();
    }

    public function insert_role($data)
    {
            return $data = DB::table('role')->insertGETId([
                'control'=>$data['pri_name'],
                'explain'=>$data['description'],
            ]);
    }

    public function insert_pr($data,$role_id)
    {
        static $arr = [];
        // var_dump($data);die;
        foreach($data as $v)
        {
            $arr_id [] = DB::table('privilege_role')->insertGetId([
                'privilege_id'=>$v,
                'role_id'=>$role_id,
            ]);
        }
        // var_dump($arr_id);die;
        return $arr_id;
    }

    public function getPrivilege()
    {
        return $data = DB::table('privilege')->get();
    }

    public function insert_pri($data)
    {
        // var_dump($data);die;
        if($data['privilege'])
        {
            return $data = DB::table('privilege')->insertGetId([
                'name'=>$data['pri_name'],
                'url_path'=>$data['pri_url'],
                'parent_id'=>$data['privilege'],
            ]);
        }
        else
        {
            return $data = DB::table('privilege')->insertGetId([
                'name'=>$data['pri_name'],
            ]);
        }
    }
}
