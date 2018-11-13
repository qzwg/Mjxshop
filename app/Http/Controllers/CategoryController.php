<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    //
    public function index()
    {
        //无限极分类
        $model = new Category;
        $data = $model->tree();
        // var_dump($data);die;
        return view('behind/shop.category',[
            'data'=>$data,
        ]);
    }

    public function store(Request $req)
    {
        $data = $req->all();
        // var_dump($data);die;
        $model = new Category;
        $id = $model->insert($data);
        if($id!==0)
            return redirect('category');
        else
            return back()->withErrors(['插入失败，重新插入']);
    }

    public function create()
    {
        
        return view('behind/shop.category_add');
    }

    
}
