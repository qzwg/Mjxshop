<?php

namespace App\Http\Controllers;
@header('Content-type: text/html;charset=UTF-8');
use Illuminate\Http\Request;
use App\Models\Shop_add;
use App\Models\Category;

class Shop_addController extends Controller
{
    //
    public function index()
    {
        $model = new Shop_add;
        $brand = $model->getBrand();
        // var_dump($category);die;
        return view('behind/shop.shop_add',[
            'brand'=>$brand,
        ]);
    }

    public function store(Request $req)
    {
        var_dump($_FILES);
        $data = $req->all();
        // var_dump($data);die;
        $model = new Shop_add;
        $sku_attr = $model->insert($data);
        if($sku_attr)
            return redirect('list_add');
        else
            return redirect('shop_add');
    }

    public function show($id)
    {
        $id = $_GET['id'];
        $model = new Shop_add;
        $attrArr = $model->getAttr($id);

        return $data = json_encode($attrArr);
        // var_dump($attrArr);

    }

    public function edit()
    {
        $id = $_GET['id'];
        $model = new Shop_add;
        $valueArr = $model->getValue($id);
        return $data = json_encode($valueArr);
        // var_dump($valueArr);
    }

    // public function create()
    // {
    //     $id = $_GET['id'];
    //     $model = new Shop_add;
    //     $valueArr = $model->getValue($id);
    //     $value = DB::table('value')->where('attr_id',$id);
    //     echo json_encode($value);
    //     // var_dump($id);
    // }

}
