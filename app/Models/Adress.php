<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Adress extends Model
{
    //
    public function insert($data)
    {
        $adress = $data['province'] .'-'. $data['city'] .'-'. $data['district'];
        return $data = DB::table('user_adress')->insertGetId([
            'name'=>$data['name'],
            'user_id'=>session('user_id'),
            'adress'=>$adress,
            'phone'=>$data['phone'],
            'email'=>$data['email'],
            'particular'=>$data['particular'],
            'bm'=>$data['bm'],
        ]);
    }

    public function select($id)
    {
        return $data = DB::table('user_adress')->where('user_id',$id)->get();
    }

    public function getOne($id)
    {
        return $data = DB::table('user_adress')->where('id',$id)->first();
    }

    public function del($id)
    {
        $state = DB::table('user_adress')->where('id',$id)->delete();
    }
}
