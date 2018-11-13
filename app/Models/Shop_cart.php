<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Shop_cart extends Model
{
    //
    public function getSkuMes($id)
    {
        $skuArr = DB::table('sku')->where('id',$id)->first();
        $img = DB::table('shop_image')->where('sku_id',$id)->first()->small_image;
        return [
            'skuArr'=>$skuArr,
            'img'=>$img,
        ];
        // var_dump($img);die;
    }
}
