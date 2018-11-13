<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {
        return view('front/order.index');
    }

    public function edit()
    {
        // var_dump("asdf");
        return view('front/setting-info.info2');
    }

}
