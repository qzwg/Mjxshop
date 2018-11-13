<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop_cart;
class Shop_cartController extends Controller
{
    //
    public function index()
    {   
        // return view('front/cart.cart');
    }

    public function create(Request $req)
    {
        $data = $req->all();
        var_dump($data);
        $model = new ShoP_cart;
        $cartData = $model->getSkuMes($data['skuId']);
        var_dump($cartData);
        return view('front/cart.cart');
    }
}
