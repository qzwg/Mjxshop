<?php
namespace controllers;
use models\Admin;
class AdminController extends BaseController{
    public function index()
    {
        $model = new Admin;
        $data = $model->findAll();
        view('admin/index',$data);
    }

    public function create()
    {
        $model = new \models\Role;
        $data = $model->findAll();

        view('admin/create',$data);
    }

    public function insert()
    {
        $admin = new Admin;
  
        $admin->fill($_POST);
        $admin->insert();
        redirect('/admin/index');
    }

    public function edit()
    {
        $model = new Admin;
        $data = $model->findOne($_GET['id']);

        // 取出权限的数据
        $priModel = new \models\admin;
        // 获取树形数据（递归排序好的）
        $priData = $priModel->tree();
        view('admin/edit',[
            'data'=>$data,
            'priData'=>$priData,
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
        redirect('/admin/index');
    }
}