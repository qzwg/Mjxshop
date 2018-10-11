<?php
namespace controllers;
use models\Article;
class ArticleController{
    public function index()
    {
        $model = new Article;
        $data = $model->findAll();
        view('article/index',$data);
    }

    public function create()
    {
        view('article/create');
    }

    public function insert()
    {
        $article = new Article;
        $article->fill($_POST);
        $article->insert();
        header('Location:/article/index');
    }

    public function edit()
    {
        $model = new Article;
        $data = $model->findOne($_GET['id']);
        view('article/edit',[
            'data'=>$data,
        ]);
    }

    public function update()
    {
        $model = new Article;
        $model->fill($_POST);
        $model->update($_GET['id']);
        header('/article/index');
    }

    public function delete()
    {
        $model = new Article;
        $model->delete($_GET['id']);
        header('/article/index');
    }
}