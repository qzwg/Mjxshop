<?php
namespace controllers;
use models\Privilege;
class PrivilegeController{
    public function index()
    {
        $model = new Privilege;
        $data = $model->findAll();
        view('privilege/index',$data);
    }

    public function create()
    {
        view('privilege/create');
    }

    public function insert()
    {
        $privilege = new Privilege;
        $privilege->fill($_POST);
        $privilege->insert();
        header('Location:/privilege/index');
    }

    public function edit()
    {
        $model = new Privilege;
        $data = $model->findOne($_GET['id']);
        view('privilege/edit',[
            'data'=>$data,
        ]);
    }

    public function update()
    {
        $model = new Privilege;
        $model->fill($_POST);
        $model->update($_GET['id']);
        header('/privilege/index');
    }

    public function delete()
    {
        $model = new Privilege;
        $model->delete($_GET['id']);
        header('/privilege/index');
    }
}