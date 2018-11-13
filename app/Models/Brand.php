<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Intervention\Image\ImageManagerStatic as Image;
class Brand extends Model
{
    //
    public function insert($data)
    {
        //保存图片
        // var_dump($data);die;
        // var_dump($_FILES);die;
        if($_FILES['logo']['error'] == 0)
        {
            $upload = Upload::make();
            $logoDri = 'uploads/'.$upload->upload('logo','brand');
            // open an image file
            $img = Image::make($logoDri);

            // resize image instance
            $img->resize(130, 65);

            // save image in desired format
            $img->save($logoDri);
        }
        // var_dump($logoDri);die;
        $logoDri = isset($logoDri) ? $logoDri : $data['url'];
        // dd($logoDri);
        return $id = DB::table('spu')->insertGetId([
            'category_id'=>$data['category'],
            'name'=>$data['brand_name'],
            'keywords'=>$data['explain'],
            'LOGO'=>$logoDri,
            'district'=>$data['district'],
            'description'=>$data['description'],
            'state'=>$data['checkbox'],
            
        ]);
    }

    public function add_attr($data,$id)
    {
        $dataAttr = $data['shop_attr'];
        // var_dump($dataAttr);die;
        foreach($dataAttr as $k=>$v)
        {
            // var_dump($data['shop_value'][$k]);die;
            $attr_id = DB::table("attr")->insertGetId([
                'name'=>$v,
                'spu_id'=>$id,
            ]);
            
            $shop_value_arr = explode(',',$data['shop_value'][$k]);
            // var_dump($shop_value_arr);
            foreach($shop_value_arr as $z)
            {
                // var_dump($attr_id,$z);die;
                $value_id = DB::table("value")->insertGetId([
                    'name'=>$z,
                    'attr_id'=>$attr_id,
                ]);
            }
            // var_dump($value_id);die;
        }
        die;
    }

    public  function getCategory()
    {
        return $data = DB::table('category')->get();
    }

    public function getBrand()
    {
        return $data = DB::table('spu')->get();
    }

    public function getOneCategory($id)
    {
        return $data = DB::table('spu')->where('id',$id)->first();
    }

    public function getSpu()
    {
        return $data = DB::table('spu')->get();
    }
}
