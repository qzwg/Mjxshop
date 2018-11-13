<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    //
    protected $table="user";
    protected $fillable = ['user','pwd','phone'];
    public function insert($data)
    {
        // var_dump($data);die;
        return $id = DB::table('user')->insertGetId([
            'user'=>$data['user'],
            'pwd'=>$data['pwd'],
            'phone'=>$data['mobile'],
        ]);
    }
}
