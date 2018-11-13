<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Index extends Model
{
    protected $table = 'category';

    public function getsan(){
        return $this->hasMany(Index::class,'parent_id','id')->select(['id','category','parent_id']);

    }

    public function gettwo(){
        return $this->hasMany(Index::class,'parent_id','id')->select(['id','category','parent_id'])->with('getsan');
    }

    public function getcat(){
       return Index::where('parent_id','0')->with('gettwo')->get()->toArray();
    }

    // public function getCategory()
    // {
    //     return $data = DB::table('category')->get();
    // }
}
