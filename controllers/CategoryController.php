<?php
namespace controllers;
use models\Category;
class CategoryController extends BaseController{
    public function index()
    {
        $model = new Category;
        $data = $model->findAll();
        view('category/index',$data);
    }

    public function create()
    {
        view('category/create');
    }

    public function insert()
    {
        $category = new Category;
        $category->fill($_POST);
        $category->insert();
        header('Location:/category/index');
    }

    public function edit()
    {
        $model = new Category;
        $data = $model->findOne($_GET['id']);
        view('category/edit',[
            'data'=>$data,
        ]);
    }

    public function update()
    {
        $model = new Category;
        $model->fill($_POST);
        $model->update($_GET['id']);
        header('/category/index');
    }

    public function delete()
    {
        $model = new Category;
        $model->delete($_GET['id']);
        header('/category/index');
    }
}