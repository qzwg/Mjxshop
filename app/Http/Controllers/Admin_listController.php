<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin_list;
class Admin_listController extends Controller
{
    //
    public function index()
    {
        $model = new Admin_list;
        $role = $model->getRole();
        if(isset($_GET['key']))
            $key = $_GET['key'];
        else
            $key = '';
            // var_dump($key);
        $admin_mes = $model->getadmin_mes($key);

        // var_dump($type);die;
        if(empty($_GET['type'])!==true)
        {
            $type = $_GET['type'];
            $admin_mes = $model->role_mes($type);
        }
        else
            $type = '';
        
        //get role
        $admin_role = $model->admin_role();
        // var_dump($admin_role);die;
        return view('behind/admin_mes.admin_list',[
            'role'=>$role,
            'admin_mes'=>$admin_mes,
            'key'=>$key,
            'type'=>$type,
            'admin_role'=>$admin_role,
        ]);
    }

    public function store(Request $req)
    {
        $data = $req->all();
        $model = new Admin_list;
        $statues = $model->login_insert($data);
        // var_dump($statues);die;
        $state = $model->insert($data,$statues);
        
        
        if($state && $statues)
            return redirect('admin_list');
        else
            return back()->withErrors(['插入失败,重新插入']);

    }

    
    public function edit(){
        $id= $_GET['id'];
        $model = new Admin_list;
        $data = $model->getAdminMes($id);
        return $data = json_encode($data);
    }

    public function show()
    {
        // var_dump($_GET);die;
        $data = $_GET;
        $model = new Admin_list;
        $num = $model->edit_admin_mes($data);
        $login_num = $model->update_login($data);

        $model->update_ar($data);
        // var_dump("sdf");die;
        if($num !==0)
            return redirect('admin_list');
        else
            return back()->withErrors(['提交信息有误']);
    }
    //

}
