<?php
namespace controllers;
use models\Article_category;
class Article_categoryController{
    public function index()
    {
        $model = new Article_category;
        $data = $model->findAll();
        view('article_category/index',$data);
    }

    public function create()
    {
        view('article_category/create');
    }

    public function insert()
    {
        $article_category = new Article_category;
        $article_category->fill($_POST);
        $article_category->insert();
        header('Location:/article_category/index');
    }

    public function edit()
    {
        $model = new Article_category;
        $data = $model->findOne($_GET['id']);
        view('article_category/edit',[
            'data'=>$data,
        ]);
    }

    public function update()
    {
        $model = new Article_category;
        $model->fill($_POST);
        $model->update($_GET['id']);
        header('/article_category/index');
    }

    public function delete()
    {
        $model = new Article_category;
        $model->delete($_GET['id']);
        header('/article_category/index');
    }
}