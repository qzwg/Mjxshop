<?php
define('ROOT',__DIR__ . '/../');
// 设置时区
date_default_timezone_set('PRC');

// 使用 redis 保存 SESSION
ini_set('session.save_handler', 'redis');
// 设置 redis 服务器的地址、端
ini_set('session.save_path', 'tcp://127.0.0.1:6379?database=3');
session_start();    

require(ROOT . 'libs/functions.php');

//自动加载
function load($class)
{
    // var_dump($class);
    $path = str_replace('\\','/',$class);
    // var_dump(ROOT . $path . '.php');
    require(ROOT . $path . '.php');
}
spl_autoload_register('load');

//解析路由
//$_SERVER,设置默认，if判断
$controller = '\controllers\IndexController';
$action = 'index';
if(isset($_SERVER['PATH_INFO']))
{
//转为数组，取出第2,3个
$router = explode('/',$_SERVER['PATH_INFO']);
$controller = '\controllers\\' . ucfirst($router[1]) . 'Controller';
$action = $router[2];
}
// var_dump($controller);
$c = new $controller;
$c->$action();
