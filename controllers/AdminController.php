<?php
namespace controllers;
use models\Admin;
class AdminController{
    public function index()
    {
        $model = new Admin;
        $data = $model->findAll();
        view('admin/index',$data);
    }

    public function create()
    {
        view('admin/create');
    }

    public function insert()
    {
        $admin = new Admin;
        $admin->fill($_POST);
        $admin->insert();
        header('Location:/admin/index');
    }

    public function edit()
    {
        $model = new Admin;
        $data = $model->findOne($_GET['id']);
        view('admin/edit',[
            'data'=>$data,
        ]);
    }

    public function update()
    {
        $model = new Admin;
        $model->fill($_POST);
        $model->update($_GET['id']);
        header('/admin/index');
    }

    public function delete()
    {
        $model = new Admin;
        $model->delete($_GET['id']);
        header('/admin/index');
    }
}