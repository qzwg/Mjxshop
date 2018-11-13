<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
class BrandController extends Controller
{
    //
    public function index()
    {
        $model = new Brand;
        $brandMes = $model->getBrand();
        // var_dump($brandMes);die;
        return view('behind/brand.index',[
            'brandMes'=>$brandMes,
        ]);
    }

    public function create()
    {
        $model = new Category;
        $category = $model->tree();
        //获取品牌，spu数据 
        // var_dump($category);die;
        return view('behind/brand.add_brand',[
            'category'=>$category,
        ]);
    }

    public function store(Request $req)
    {
        $data = $req->all();
        // var_dump($data);
        $model = new Brand;
        $id = $model->insert($data);
        //插入到attr和value中
        $data = $model->add_attr($data,$id);
        var_dump($id);die;
        if($id)
            return redirect('brand');
        else
            return back()->withErrors('信息有误，重新插入');
    }

    public function edit($id)
    {
        $model = new Brand;
        $data = $model->getOneCategory($id);
        $spu = $model->getSpu();
        // var_dump($data);die;
        // var_dump($spu);die;
        return view('behind/brand.edit_brand',[
            'data'=>$data,
            'spu'=>$spu,
        ]);
    }

}
