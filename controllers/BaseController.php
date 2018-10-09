<?php
namespace controllers;
class BaseController
{
    public function __construct()
    {
        if(!isset($_SESSION['id']))
        {
            redirect('/login/login');
        }

        if(isset($_SESSION['root']))
        {
            return ;
        }

        $path = isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'],'/') : 'index/index';
        $whileList = ['index/index','index/menu','index/top','index/main'];
        if(!in_array($path,array_merge($whileList,$_SESSION['url_path'])))
        {
            die('无权访问！');
        }
    }
}