<?php
namespace controllers;
use models\;
class Controller extends BaseController{
    public function index()
    {
        $model = new ;
        $data = $model->findAll();
        view('/index',$data);
    }

    public function create()
    {
        view('/create');
    }

    public function insert()
    {
        $ = new ;
        $->fill($_POST);
        $->insert();
        header('Location://index');
    }

    public function edit()
    {
        $model = new ;
        $data = $model->findOne($_GET['id']);
        view('/edit',[
            'data'=>$data,
        ]);
    }

    public function update()
    {
        $model = new ;
        $model->fill($_POST);
        $model->update($_GET['id']);
        header('//index');
    }

    public function delete()
    {
        $model = new ;
        $model->delete($_GET['id']);
        header('//index');
    }
}