<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Person extends Model
{
    //
    public function insert($data)
    {
        // $state = DB::table('user_mes')->where('user_id',session('user_id'))->first();
        // var_dump($state);die;
        
        $adress = $data['province'] .'-'. $data['city'] .'-'. $data['district'];
        $birth = $data['years'] .'-'. $data['month'] .'-'. $data['day'];
        return $id = DB::table('user_mes')->insertGetId([
            'user_id'=>session('user_id'),
            'sex'=>$data['gender'],
            'adress'=>$adress,
            'name'=>$data['email'],
            'birth'=>$birth,
            'profession'=>$data['job'],
        ]);
    }

    public function oneData($id)
    {
        return $data = DB::table('user_mes')->where('user_id',$id)->first();
    }

    public function updata($data)
    {
        $adress = $data['province'] .'-'. $data['city'] .'-'. $data['district'];
        $birth = $data['years'] .'-'. $data['month'] .'-'. $data['day'];
        return $num = DB::table('user_mes')->where('user_id',session('user_id'))
                                    ->update([
                                        'user_id'=>session('user_id'),
                                        'sex'=>$data['gender'],
                                        'adress'=>$adress,
                                        'name'=>$data['email'],
                                        'birth'=>$birth,
                                        'profession'=>$data['job'],
                                    ]);
    }
}
