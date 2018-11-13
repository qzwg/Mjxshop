<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Session;
class AdminController extends Controller
{
    //
    public function index()
    {
        return view('behind/login.login');
    }

    //退出
    public function show()
    {
        // die("sadf");die;
        var_dump(session('user_id'));
        Session::forget('user_id');
    
        return redirect('admin');

    }

    //后台登陆
    public function store(Request $req)
    { 
        $dataArr = $req->all();
        $model = new Admin;
        $data = $model->select($dataArr);
        if($data)
        {
            session()->put(['user_id'=>$data->id]);
            // var_dump(session('user_id'));die;
            //获取ip和登陆地点 
            $model = new Admin;
            $admin_role = $model->getRole($data);
            // var_dump($admin_role);die;
            foreach($admin_role as $k=>$v)
            {
                $arr[] = $v->control;
            }
            $strArr = implode('-',$arr);
            // var_dump($strArr);die;
            if(strpos($strArr,'超级管理员') === false)
                $dataArr['type'] = $strArr;
                
            else
            
                $dataArr['type'] = '超级管理员';
            //如果是超级管理员开放所有权限，如果不是超管，开放部分权限
            $arr = explode('-',$dataArr['ip']);  
            // var_dump($dataArr);die;
            $dataArr['ip'] = $arr[0];
            $dataArr['district'] = $arr[1];
            
            $state = $model->insert($dataArr);
            // var_dump($state);die;
            $model = new Admin;
            $data = $model->getuser_mes(session('user_id'));
            // var_dump($data);die;
            return view('behind/index.index',[
                'user'=>$data,
            ]);
        }
        else
            return view('behind/login.login');

    }
}
