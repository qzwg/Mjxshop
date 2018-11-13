<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Rule;
use App\Models\Register;
use Flc\Dysms\Client;
use Illuminate\Support\Facades\Cache;
use Flc\Dysms\Request\SendSms;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('front/register.register');
    }

    public function store(Rule $req)
    {
        //短信验证
        $name = 'code-'.$req->mobile;
        $code = Cache::get($name);
        // var_dump($code);
        // var_dump($req->mobile_code);die;
        if(!$code || $code != $req->mobile_code)
        {
            return back()->withErrors(['mobile_code'=>'验证码错误']);
        }

        $data = $req->all();
        // var_dump($data);die;
        $model = new Register;
        // $id = $model->insert($data);
        $id = 1;
        if($id)
            return redirect('login');
        else
            return redirect('register');
    }

    //send-code
    public function send_mobile(Request $req)
    {
        $code = rand(100000,999999);
        $name = 'code-'.$req->mobile;
        Cache::put($name,$code,11);
        var_dump($code);die;
        $config = [
                 'accessKeyId'    => 'LTAIlc4wEbXVI8GO',
                 'accessKeySecret' => 'r1kRKskxheWYFAh6WeX919OYrZwTZt',
        ];

        $client  = new Client($config);
        $sendSms = new SendSms;
        $sendSms->setPhoneNumbers($req->mobile);
        $sendSms->setSignName('快腿');
        $sendSms->setTemplateCode('SMS_147970205');
        $sendSms->setTemplateParam(['code'=>$code]);
        // 发送
        print_r($client->execute($sendSms));
            
    }
}
