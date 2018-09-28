<?php
namespace controllers;
use models\Brand;
class BrandController{
    public function index()
    {
        $model = new Brand;
        $data = $model->findAll();
        view('brand/index',$data);
    }

    public function create()
    {
        view('brand/create');
    }

    public function insert()
    {
        $brand = new Brand;
        $brand->fill($_POST);
        $brand->insert();
        header('Location:/brand/index');
    }

    public function edit()
    {
        $model = new Brand;
        $data = $model->findOne($_GET['id']);
        view('brand/edit',[
            'data'=>$data,
        ]);
    }

    public function update()
    {
        $model = new Brand;
        $model->fill($_POST);
        $model->update($_GET['id']);
        header('/brand/index');
    }

    public function delete()
    {
        $model = new Brand;
        $model->delete($_GET['id']);
        header('/brand/index');
    }
}