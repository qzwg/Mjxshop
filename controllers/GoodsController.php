<?php
namespace controllers;
use models\Goods;
class GoodsController extends BaseController{
   

    //获取子分类
    public function ajax_get_cat()
    {
        $id = (int)$_GET['id'];
        $model = new \models\Category;
        $data = $model->getCat($id);
        echo json_encode($data);
    }

    public function index()
    {
        $model = new Goods;
        $data = $model->findAll();
        // var_dump($data);
        view('Goods/index',$data);
    }

    public function create()
    {
        $model = new \models\Category;
        $topCat = $model->getCat();
        view('Goods/create',[
            'topCat' => $topCat['data'],
        ]);
    }

    public function insert()
    {
    
        $Goods = new Goods;
        $Goods->fill($_POST);
        $Goods->insert();
        redirect('/goods/index');
    }

    public function edit()
    {
        $model = new Goods;
        $data = $model->findOne($_GET['id']);
        view('Goods/edit',[
            'data'=>$data,
        ]);
    }

    public function update()
    {
        $model = new Goods;
        $model->fill($_POST);
        $model->update($_GET['id']);
        redirect('/Goods/index');
    }

    public function delete()
    {
        $model = new Goods;
        $model->delete($_GET['id']);
        redirect('/Goods/index');
    }
}