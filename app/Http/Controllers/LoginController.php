<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loigin;
class LoginController extends Controller
{
    //
    public function index()
    {
        $index = 1;
        return view('front/login.login',[
            'index'=>$index,
        ]);
    }

    public function store(Request $req)
    {
        $data = $req->all();
        $model = new Loigin;
        $state = $model->select($data);
        if($state)
        {
            session()->put(['user_id'=>$state->id]);
            $data = $model->user_id();
            // var_dump($data);die;
            if(!$data)
                return redirect('info');
            else
                return redirect('index');
        }
        else
            return redirect('login');
        // var_dump($req->all());
    }
}
