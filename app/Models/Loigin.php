<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Loigin extends Model
{
    //
    public function select($data)
    {
        // var_dump($data);die;
        $oneMes = DB::table('user')->where('user',$data['user'])->first();
        return $oneMes;
        // var_dump($oneMes);die;
    }

    public function user_id()
    {
        return $data = DB::table('user_mes')->where('user_id',session('user_id'))->first();
    }
}
