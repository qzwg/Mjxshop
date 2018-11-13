<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Index;
class IndexController extends Controller
{
    //
    public function index()
    {
        $model = new Index;
        $category = $model->getcat();
        // dd($category);
        // dd($category);die;
        return view('front/index.index',[
            'category'=>$category,
        ]);
    }

    // public function show()
    // {
        
    //     return view()
    // }
}
