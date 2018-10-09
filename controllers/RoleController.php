<?php
namespace controllers;
use models\Role;
class RoleController{
    public function index()
    {
        $model = new Role;
        // var_dump($model);die;
        $data = $model->findAll([
            'fields'=>'a.*,GROUP_CONCAT(c.pri_name) pri_list',
            'join'=>' a LEFT JOIN role_privlege b ON a.id=b.role_id LEFT JOIN privilege c ON b.pri_id=c.id ',
            'groupby'=>' GROUP BY a.id ',
        ]);
        view('role/index',$data);
    }

    public function create()
    {
        $priModel = new \models\Privilege;
        $data = $priModel->tree();
        view('role/create',$data);
    }

    public function insert()
    {
        $role = new Role;
        $role->fill($_POST);
        $role->insert();
        redirect('/role/index');
    }

    public function edit()
    {
        $model = new Role;
        $data = $model->findOne($_GET['id']);
        view('role/edit',[
            'data'=>$data,
        ]);
    }

    public function update()
    {
        $model = new Role;
        $model->fill($_POST);
        $model->update($_GET['id']);
        header('/role/index');
    }

    public function delete()
    {
        $model = new Role;
        $model->delete($_GET['id']);
        header('/role/index');
    }
}