<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
class PersonController extends Controller
{
    //
    public function index()
    {
        return view('front/setting-info.info1');
        // var_dump("info");
    }

    public function store(Request $req)
    {
        var_dump($req->all());
        $data = $req->all();
        $model = new Person;
        $id = $model->insert($data);
        if($id)
            return redirect('order');
        else
            return redirect('info');
    }

    public function show()
    {
        // var_dump("asdf");die;
        $id = session('user_id');
        $model = new Person;
        $data = $model->oneData($id);
        // var_dump($data);die;
        $birth = explode('-',$data->birth);
        $adress = explode('-',$data->adress);
        return view('front/setting-info.info2',[
            'data'=>$data,
            'birth'=>$birth,
            'adress'=>$adress,
        ]);
    }

    public function edit(Request $req)
    {
        $data = $req->all();
        $model = new Person;
        $num = $model->updata($data);
        // var_dump($num);die;
        if($num)
            return redirect('info/id');
        else
            return back()->withErrors("插入有误");
        var_dump($data);
    }
}
