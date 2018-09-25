<?php
define('ROOT',__DIR__ . '/../');
require(ROOT . 'libs/functions.php');

//自动加载
function load($class)
{
    // var_dump($class);
    $path = str_replace('\\','/',$class);
    var_dump(ROOT . $path . '.php');
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
var_dump($controller);
$c = new $controller;
$c->$action();
