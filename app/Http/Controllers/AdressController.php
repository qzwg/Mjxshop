<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adress;
class AdressController extends Controller
{
    //
    public function index()
    {
        $model = new Adress;
        $data = $model->select(session('user_id'));
        // var_dump($data);die;
        return view('front/person.setting-address',[
            'data'=>$data,
        ]);
    }

    public function store(Request $req)
    {
        $data = $req->all();
        // var_dump($data);die;
        $model = new Adress;
        $state = $model->insert($data);
        if($state)
            return redirect('adress');
        else
            return back()->withErrors("提交信息有误");
    }

    public function edit($id)
    {
        $model = new Adress;
        $data = $model->getOne($id);
        // var_dump(gettype($data));die;
        $data = json_encode($data, JSON_FORCE_OBJECT);
        return $data;
    }

    public function show(Request $req)
    {
        $id = ($req->all())['id'];
        // var_dump($id);die;
        $model = new Adress;
        $state = $model->del($id);
        
        return redirect('adress');
    }
}
