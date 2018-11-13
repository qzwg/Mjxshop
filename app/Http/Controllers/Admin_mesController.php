<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin_mes;
class Admin_mesController extends Controller
{
    //
    public function index()
    {
        // $key = $_GET['key'];
        $model = new Admin_mes;
        $data = $model->select();
        if(isset($_GET['key']))
            $key = $_GET['key'];
        else
            $key = '';
        $blog = $model->getBlog($key);
        
        
        return view('behind/admin_mes.info',[
            'data'=>$data,
            'blog'=>$blog,
            'key'=>$key,
        ]);
    }

    public function store(Request $req)
    {
        $data = $req->all();
        $model = new Admin_mes;
        $state = $model->doUpdate($data);
        if($state)
            return redirect('admin_mes');
        else
            return back()->withErrors(['输入信息有误']);
    }

    public function show(Request $req)
    {
        $data = $req->all();
        if($data['new'] !==$data['re_new'])
            return back()->withErrors(['密码不一致']);
        $oldPwd = $data['old'];
        $newPwd = $data['new'];
        $model = new Admin_mes;
        $state = $model->select_pwd($oldPwd);
        // var_dump($state);die;
        if(!$state)
            return back()->withErrors(['原密码错误']);

        $state = $model->editpwd($newPwd);
        if($state)
            return redirect('admin_mes');
        else
            return back()->withErrors(['修改失败']);
        // var_dump("sadf");
    }
}
