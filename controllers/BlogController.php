<?php
namespace controllers;
class BlogController extends BaseController{
    public function index()
    {
        view('blog/index');
    }

    public function create()
    {
        view('blog/create');
    }

    public function insert()
    {
        $blog = new \models\Blog;
        $blog->fill($_POST);
        $blog->insert();
    }

    public function edit()
    {
        view('blog/edit');
    }

    public function update()
    {
        view('blog/update');
    }

    public function delete()
    {
        view('blog/delete');
    }
}