<?php
namespace controllers;
class GoodsController{
    public function index()
    {
        view('Goods/index');
    }

    public function create()
    {
        view('Goods/create');
    }

    public function insert()
    {
        view('Goods/insert');
    }

    public function edit()
    {
        view('Goods/edit');
    }

    public function update()
    {
        view('Goods/update');
    }

    public function delete()
    {
        view('Goods/delete');
    }
}