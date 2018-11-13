<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listadd;
class ListaddController extends Controller
{
    //
    public function index()
    {
        $model = new Listadd;
        $skuDate = $model->getSku();
        // var_dump($skuDate);die;
        return view('behind/shop.shop_list',[
            'skuDate'=>$skuDate,
        ]);
    }

    public function show($id)
    {
        // var_dump("asdf");die;
        $model = new Listadd;
        $skuMes = $model->getOneSku($id);
        // var_dump($skuMes);
        $attr = $model->getattr($skuMes->attr);
        // var_dump($skuMes);
        $spu_id = $skuMes->spu_id;
        // var_dump($spu_id);die;
        $category_id = $model->getCategory($spu_id)[0]->id;
        // var_dump($category_id);die;
        $spu = $model->getSpu();
        // var_dump($skuDate);die;
        $attrArr = explode(',',$attr);
        // var_dump($attrArr);die;
        // $category_id = 
        //图片路径
        $urlArr = $model->getUrl($id);
        // dd($urlArr);
        return view('behind/shop.shop_edit',[
            'skuMes'=>$skuMes,
            'spu'=>$spu,
            'attrArr'=>$attrArr,
            'id'=>$id,
            'category_id'=>$category_id,
            'urlArr'=>$urlArr,
        ]);
    }

    public function store(Request $req)
    {
        $data = $req->all();
        // var_dump($data);die;
        $model = new Listadd;
        $num = $model->doUpdate($data,$data['attr_id'],$data['cover_url'],$data['category_id']);
        var_dump($num);
        if($num)
            return redirect('list_add/'.$data['id'].'');
        else
            return redirect('list_add/'.$data['id'].'');
    }
}
