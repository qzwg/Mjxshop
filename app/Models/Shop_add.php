<?php

namespace App\Models;
use App\Models\Upload;
use Illuminate\Database\Eloquent\Model;
use DB;
use Intervention\Image\ImageManagerStatic as Image;
class Shop_add extends Model
{
    //
    public function getCategory()
    {
        return $data = DB::table('category')->get();
    }

    public function getBrand()
    {
        return $data = DB::table('spu')->get();
    }

    public function insert($data)
    {
        // var_dump($data);die;
        var_dump($data['shop_brand']);
        $category = DB::table('spu')->where('id',$data['shop_brand'])->first();
        $category_id = $category->category_id;
        // var_dump($category_id);die;
        // var_dump($_FILES);die;
        //图片用缩略图插件，存到文件中，并且同时生成大，中，小3张缩略图，保存数据库和硬盘中
        //保存logo
        $uploader = Upload::make(); 
        
        $logoDir = 'uploads/' . $uploader->upload('logo','goods');
        // open an image file
        $img = Image::make($logoDir);
        // resize image instance
        $img->resize(212, 242);
        // save image in desired format
        $name = md5( time() . rand(1,9999) );
        $dir = 'uploads/thumb/'.date('Ymd');
        is_dir($dir) OR mkdir($dir, 0777, true); 
        $coverDir = 'uploads/goods/'.date('Ymd').'/cover_'.md5(rand(1,9999)).$_FILES['logo']['name'];
        $img->save($coverDir);
        // die;
        //插sku
        $skuId = DB::table('sku')->insertGetId([
            'spu_id'=>$data['cat00_id'],
            'show_price'=>$data['show_price'],
            'bazzar_price'=>$data['bazzar_price'],
            'inventory'=>1000,
            'keyword'=>$data['keyword'],
            'describe'=>$data['content'],
            'content'=>$data['editorValue'],
            'cover'=>$coverDir,
            'inventory'=>$data['stock'],
            'weight'=>$data['weight'],
            'title'=>$data['title'],
        ]);

        $_tmp = [];
        // 循环图片
        foreach($_FILES['image']['name'] as $k => $v)
        {
            // 如果有图片并且上传成功时才处理图片
            if($_FILES['image']['error'][$k] == 0)
            {
                // 拼出每张图片需要的数组
                $_tmp['name'] = $v;
                $_tmp['type'] = $_FILES['image']['type'][$k];
                $_tmp['tmp_name'] = $_FILES['image']['tmp_name'][$k];
                $_tmp['error'] = $_FILES['image']['error'][$k];
                $_tmp['size'] = $_FILES['image']['size'][$k];
                // 放到 $_FILES 数组中
                $_FILES['tmp'] = $_tmp;
                // upload 这个类会到 $_FILES 中去找图片
                // 参数一、就代表图片在 $_FILES 数组中的名字
                // upload 方法现在就可以直接到 $_FILES 中去找到 tmp 来上传了
                $path = 'uploads/'.$uploader->upload('tmp', 'goods');
                
                //生成缩略图,大中小3张
                //大
                $img = Image::make($path);

                // resize image instance
                $img->resize(719, 719);
        
                // save image in desired format
                $big_coverDir = 'uploads/goods/'.date('Ymd').'/big_'.md5(rand(1,9999)).$_FILES['tmp']['name'];
                $img->save($big_coverDir);
                
                //中
                $img = Image::make($path);

                // resize image instance
                $img->resize(450, 450);
        
                // save image in desired format
                $middle_coverDir = 'uploads/goods/'.date('Ymd').'/middle_'.md5(rand(1,9999)).$_FILES['tmp']['name'];
                $img->save($middle_coverDir);
                //小
                $img = Image::make($path);

                // resize image instance
                $img->resize(58, 58);
        
                // save image in desired format
                $small_coverDir = 'uploads/goods/'.date('Ymd').'/small_'.md5(rand(1,9999)).$_FILES['tmp']['name'];
                $img->save($small_coverDir);
                //表内插入图片路径
                $img_id = DB::table('shop_image')->insertGETId([
                    'sku_id'=>$skuId,
                    'big_image'=>$big_coverDir,
                    'middle_image'=>$middle_coverDir,
                    'small_image'=>$small_coverDir,
                    'master'=>$small_coverDir,
                ]);
                // var_dump($img_id);die;
            }
        }

        
        // $category_id = 
        // static $attr_id = [];
        // static $val_id = [];
        // static $attr_value_id = [];
        //属性值保存属性值表中
        foreach($data['attr_id'] as $k=>$v)
        {
            // $attr_id[] = DB::table('attr')->insertGetId([
            //     'name'=>$v,
            //     'category_id'=>$category_id,

            // ]);

            // $val_id[] = DB::table('value')->insertGetId([
            //     'name'=>$data['shop_value'][$k],
            //     'attr_id'=>$attr_id[$k],
            // ]);

            $attr_value_id[] = DB::table('shop_attr')->insertGetId([
                'spu_id'=>$data['cat00_id'],
                'attr_id'=>$data['attr_id'][$k],
                'value_id'=>$data['cat_id'][$k],
            ]);
        }
        // var_dump($attr_value_id);die;
        //更新suk-attr               
        $attr_str= implode(',',$attr_value_id);
        // var_dump($attr_str);die;
        $update_sku_id = DB::table('sku')->where('id',$skuId)
                                        ->update([
                                            'attr'=>$attr_str,
                                        ]);
        return $update_sku_id;
        //其余插入sku数据库中
    }

    public function getAttr($id)
    {
        return $data = DB::table('attr')->where('spu_id',$id)->get();
    }

    public function getValue($id)
    {
        return $data = DB::table('value')->where('attr_id',$id)->get();
    }
}
