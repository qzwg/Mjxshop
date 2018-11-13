<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop_mes;
class Shop_mesController extends Controller
{
    //
    // public function index()
    // {
    //     return view('front/shop_mes.shop_mes');
    // }

    public function edit($id)
    {
        var_dump($id);
        $model = new Shop_mes;
        //skuArr
        $skuMes = $model->get_sku_mes($id);
        // var_dump($skuMes);die;
        $attr_arr = $model->get_attr_arr($id);
        // var_dump($attr_arr['sku_attr_str']);
        $shop_img = $model->get_shop_image($id);
        // dd($attr_arr);
        // var_dump($attr_arr['value'][0][0]);die;
        // stripos($attr_arr['sku_attr_str'],'裸机');
        return view('front/shop_mes.shop_mes',[
            'attr_arr'=>$attr_arr,
            'shop_img'=>$shop_img,
            'skuMes'=>$skuMes,
        ]);
    }

    public function create()
    {
        // var_dump("sadf");die;
        $idStr = $_GET['id'];
        $idArr = explode(',',$idStr);
        $model = new Shop_mes;
        $sku_data = $model->getAttr($idArr);
        // var_dump($sku_data);die;
        // if($sku_data)
        return  json_encode($sku_data);
        // var_dump($sku_data);
    }
}
