<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class Shop_sort extends Model
{
    
    // protected $table = 'spu';
    // public function get_sku_info() {
    //     return $this->hasMany(Sku::class,'spu_id','id');
    //     // return $this->hasMany(Sku::class,'spu_id','id');
    // }

    // public  function get_spu_info($category_id) {
    //     return $this
    //     ->with('get_sku_info')
    //     ->where('category_id',$category_id)
    //     ->get();
    // }

    public function getSpu($id)
    {
        return $data = DB::select('
            select *
                from shop_sku a
                left join shop_spu b on b.id=a.spu_id
                where b.category_id='. $id .'
        ');
        // return $data = DB::table('spu')->where('category_id',$id)->get();
    }

}
