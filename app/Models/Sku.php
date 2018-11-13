<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Sku extends Model
{
    //
    protected $table = 'sku';
    // public function get_spu_info() {
    //     return $this->hasMany(Shop_sort::class, 'spu_id','id');
    // }
    // public function get_sku_info($category_id) {
    //     return $this
    //     ->with('get_spu_info')
    //     ->where('category_id',$category_id)
    //     ->get();
    // }
    // public function get_sku_info() {
    //     return $this->belongsTo(Shop_sort::class,'id','spu_id');
    // }
}
