<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop_sort;
class Shop_sortController extends Controller
{
    //
    public function index()
    {
        return view('front/shop_sort.sort');
    }

    public function show(Request $request,$id)
    {
        //接收分类id,spu外键category_id,查出相关品牌，通过品牌，查出所有该品牌的sku
        $model = new Shop_sort();
        var_dump($id);
        $skuMes = $model->getSpu($id);
        // return $skuMes[0]['get_sku_info'];
        // var_dump($skuMes);die;
        // dd($skuMes);
        // return view('test.test');
        return view('front/shop_sort.sort',[
            'skuMes'=>$skuMes,
        ]);
        // return $skuMes;
        
    }
}
