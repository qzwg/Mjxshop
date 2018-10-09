<?php
namespace controllers;
use models\Admin;
class LoginController 
{
    public function test()
    {
        $model = new Admin;
        $data = $model->getUalPath(2);
        var_dump($data);
    }

    public function login()
    {
        view('login/login');
    }

    public function  dologin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $model = new Admin;
        try
        {
            $model->login($username,$password);
            redirect('/');
        }
        catch(\Exception $e)
        {
            // echo $e->getMessage();
            redirect('/login/login');
        }
    }

    public function logout()
    {
        $model = new Admin;
        $model->logout();
        redirect('/login/login');
    }
}