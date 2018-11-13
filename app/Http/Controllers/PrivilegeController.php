<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Privilege;
use App\Models\Category;
class PrivilegeController extends Controller
{
    //
    public function index()
    {
        $model = new Privilege;
        $role = $model->getPri();
        // $role_admin = $model->getRole();
        // var_dump($role);die;
        // var_dump($data);
        return view('behind/privilege.privilege_list',[
            'role'=>$role,
        ]);
    }

    public function create()
    {
        $model = new Privilege;
        // $role = $model->getrole();
        // var_dump($role);die;
        $privilege = $model->privilege();
        // var_dump($privilege);
        // $category = new Category;
        // $privilege = $category->_tree($privilege);
        
        // var_dump($privilege);die;
        return view('behind/privilege.add_privilege',[
            // 'role'=>$role,
            'privilege'=>$privilege,
        ]);
    }

    public function store(Request $req)
    {
        $data = $req->all();
        // var_dump($data);
        $model = new privilege;
        $role_id = $model->insert_role($data);
        // var_dump($pri_id);die;
        $ar_id  = $model->insert_pr($data['admin_name'],$role_id);
        if($ar_id)
            return redirect('privilege');
        else
            return back()->withErrors(['添加失败 ']);
        // var_dump($ar_id);
    }

    public function show()
    {
        $model = new Privilege;
        $priDate = $model->getPrivilege();
        $pri = new Category;
        $privilege = $pri->_tree($priDate);
        // var_dump($privilege);die;
        return view('behind/privilege.add_qx',[
            'privilege'=>$privilege,
        ]);
    }

    public function edit($id)
    {
        $data = $_GET;
        // var_dump($data);die;
        $model = new privilege;
        $model->insert_pri($data);
        return redirect('privilege');
    }
}
