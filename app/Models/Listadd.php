<?php

namespace App\Models;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Database\Eloquent\Model;
use App\Models\Upload;
use DB;
class Listadd extends Model
{
    //
    public function getSku()
    {
        $data = DB::table('sku')->get();
        
        // var_dump($data);die;
        
        foreach($data as $k=>$v)
        {
            
            // var_dump($v);
            $category_name = DB::table('spu')->select('name')
                                            ->where('id',$v->spu_id)
                                            ->first();
                                            // var_dump($category_name);die;
            $category_name = $category_name->name;
            // var_dump($category_name);
            // dd($v);
            $attr_shop = $v->attr;
            // var_dump($attr_shop);
            $attr_shop_arr = explode(',',$attr_shop);
            // var_dump($attr_shop_arr);die;
            $sxArr = [];
            foreach($attr_shop_arr as $j)
            {
                // dd($j);
                $attrArr = DB::table('shop_attr')
                                         ->where('id',$j)
                                         ->first();
                                            // var_dump($attrArr->attr_id);die;
                $attr_id = $attrArr->attr_id;
                $val_id = $attrArr->value_id;
                $attr = DB::table('attr')->select('name')
                                         ->where('id',$attr_id)
                                         ->first();
                $attr = $attr->name;
                                        //  var_dump($attr);
                $val = DB::table('value')->select('name')
                                         ->where('id',$val_id)
                                         ->first();
                $val = $val->name;
                                        //  var_dump($val);die;
                $sxArr[] = $attr.':'.$val;
                // var_dump($sxArr);die;
            }
            // var_dump($sxArr);die;
            $attrStr = implode(',',$sxArr);
            // $sxArr = '';
            // var_dump($attrStr);
            $v->attr = $attrStr;
           
            // $data[$k]->attr_value = $attrStr;
            $data[$k]->spu_name = $category_name;
            // var_dump( $data[$k]);die;
        }
        
        // var_dump($data);
        return $data;
    }

    public function getSpu()
    {
        return $data = DB::table('spu')->get();
    }

    public function getOneSku($id)
    {
        return $data = DB::table('sku')->where('id',$id)->first();
    }

    public function getattr($attrId)
    {
        $attr_shop_arr = explode(',',$attrId);
            // var_dump($attr_shop_arr);
            $sxArr = [];
            foreach($attr_shop_arr as $j)
            {
                
                $attrArr = DB::table('shop_attr')
                                         ->where('id',$j)
                                         ->first();
                                        //  var_dump($attrArr);die;
                $attr_id = $attrArr->attr_id;
                $val_id = $attrArr->value_id;
                $attr = DB::table('attr')->select('name')
                                         ->where('id',$attr_id)
                                         ->first();
                $attr = $attr->name;
                                        //  var_dump($attr);
                $val = DB::table('value')->select('name')
                                         ->where('id',$val_id)
                                         ->first();
                $val = $val->name;
                                        //  var_dump($val);die;
                $sxArr[] = $attr.':'.$val;
                // var_dump($sxArr);die;
            }
            // var_dump($sxArr);die;
            $attrStr = implode(',',$sxArr);
            return $attrStr;
    }

    public function doUpdate($data,$get_attr_id,$cover_url,$category_id)
    {
        //  var_dump($data['id']);die;
        $del_image = $data['del_image'];
        if(isset($del_image))
        {
            $delArr = explode(',',$del_image);
            foreach($delArr as $v)
            {
                // var_dump($v);die;
                $data = DB::table('shop_image')->where('id',$v)->first();
                // var_dump($data);die;
                $cover = $data->master;
                // var_dump($cover);die;
                $big = $data->big_image;
                $middle = $data->middle_image;
                $small = $data->small_image;
                //删除硬盘数据
                @unlink(ROOT .'public/'.$cover);
                @unlink(ROOT .'public/'.$big);
                @unlink(ROOT .'public/'.$middle);
                @unlink(ROOT .'public/'.$small);
                $num = DB::table('shop_image')->where('id',$v)->delete();

            }
           
            // $num = DB::table('shop_image')->where('id',)->delete();
        }
         //先判断图上是否更新，更新，删除原图
        //  var_dump($_FILES['logo']['error']);
         if($_FILES['logo']['error']==0)
         {
            $imgUrl = DB::table('sku')->select('cover')->where('id',$data['id'])->first()->cover;
            // var_dump($imgUrl);die;
            @unlink(ROOT .'public/'.$imgUrl);
            
            var_dump($data['shop_brand']);
            $category = DB::table('spu')->where('id',$data['shop_brand'])->first();
            $category_id = $category->category_id;
            // var_dump($category_id);die;
            // var_dump($_FILES);die;
            //图片用缩略图插件，存到文件中，并且同时生成大，中，小3张缩略图，保存数据库和硬盘中
            //保存logo
            $uploader = Upload::make(); 
            
            $logoDir = 'uploads/' . $uploader->upload('logo','cover');
            //  var_dump($logoDir);die;
            // open an image file
            $img = Image::make($logoDir);
            // resize image instance
            $img->resize(212, 242);
            // save image in desired format
            $name = md5( time() . rand(1,9999) );
            $dir = 'uploads/thumb/'.date('Ymd');
            is_dir($dir) OR mkdir($dir, 0777, true); 
            $coverDir = 'uploads/thumb/'.date('Ymd').'/cover_'.$_FILES['logo']['name'];
            $img->save($coverDir);
            //中
            // open an image file
            // $img = Image::make($logoDir);
    
            // // resize image instance
            // $img->resize(400, 400);
    
            // // save image in desired format
            // $middle_coverDir = 'uploads/thumb/'.date('Ymd').'/middle_'.$_FILES['logo']['name'];
            // $img->save($middle_coverDir);
    
            // //small
    
            // // open an image file
            // $img = Image::make($logoDir);
    
            // // resize image instance
            // $img->resize(56, 56);
    
            // // save image in desired format
            // $small_coverDir = 'uploads/thumb/'.date('Ymd').'/small_'.$_FILES['logo']['name'];
            // $img->save($small_coverDir);
         
        }
    
        //图片循环，通过$k确定第几张图片，在通过sku_id查shop_image表，遍历循环所有图片的次序，判断
        //和$k相等的第二个foreach的$k，获取该id，进行修改，再删除硬盘图片
        $imgArr = DB::table('shop_image')->where('sku_id',$data['id'])->get();
        var_dump($imgArr);
        var_dump($_FILES['image']);
        $_tmp = [];
        // 循环图片
        $uploader = Upload::make(); 
        foreach($_FILES['image']['name'] as $k => $v)
        {
            // 如果有图片并且上传成功时才处理图片
            if($_FILES['image']['error'][$k] == 0)
            {
                foreach($imgArr as $z=>$j)
                {
                    var_dump($k,$z);
                    if($k==$z)
                    {
                        $cover = $j->master;
                        // var_dump($cover);die;
                        $big = $j->big_image;
                        $middle = $j->middle_image;
                        $small = $j->small_image;
                        //删除硬盘数据
                        @unlink(ROOT .'public/'.$cover);
                        @unlink(ROOT .'public/'.$big);
                        @unlink(ROOT .'public/'.$middle);
                        @unlink(ROOT .'public/'.$small);
                        // 拼出每张图片需要的数组
                        $_tmp['name'] = $v;
                        $_tmp['type'] = $_FILES['image']['type'][$k];
                        $_tmp['tmp_name'] = $_FILES['image']['tmp_name'][$k];
                        $_tmp['error'] = $_FILES['image']['error'][$k];
                        $_tmp['size'] = $_FILES['image']['size'][$k];
                        // 放到 $_FILES 数组中
                        $_FILES['tmp'] = $_tmp;
                        var_dump($_FILES['tmp']);
                        // upload 这个类会到 $_FILES 中去找图片
                        // 参数一、就代表图片在 $_FILES 数组中的名字
                        // upload 方法现在就可以直接到 $_FILES 中去找到 tmp 来上传了
                        $path = 'uploads/'.$uploader->upload('tmp', 'goods');
                        // var_dump($path);die;
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
                        // var_dump($j);die;
                        $img_id = DB::table('shop_image')->where('id',$j->id)->update([
                            'big_image'=>$big_coverDir,
                            'middle_image'=>$middle_coverDir,
                            'small_image'=>$small_coverDir,
                            'master'=>$small_coverDir,
                        ]);
                        // var_dump($img_id);die;
                    }
                    elseif($k>$z)
                    {
                        // var_dump("asdf");die;
                          // 拼出每张图片需要的数组
                          $_tmp['name'] = $v;
                          $_tmp['type'] = $_FILES['image']['type'][$k];
                          $_tmp['tmp_name'] = $_FILES['image']['tmp_name'][$k];
                          $_tmp['error'] = $_FILES['image']['error'][$k];
                          $_tmp['size'] = $_FILES['image']['size'][$k];
                          // 放到 $_FILES 数组中
                          $_FILES['tmp'] = $_tmp;
                          var_dump($_FILES['tmp']);
                          // upload 这个类会到 $_FILES 中去找图片
                          // 参数一、就代表图片在 $_FILES 数组中的名字
                          // upload 方法现在就可以直接到 $_FILES 中去找到 tmp 来上传了
                          $path = 'uploads/'.$uploader->upload('tmp', 'goods');
                          // var_dump($path);die;
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
                          // var_dump($j);die;
                          $img_id = DB::table('shop_image')->insertGetId([
                              'sku_id'=>$j->id,
                              'big_image'=>$big_coverDir,
                              'middle_image'=>$middle_coverDir,
                              'small_image'=>$small_coverDir,
                              'master'=>$small_coverDir,
                          ]);
                    }
                
                }
                
            }
        }

        $coverDir = isset($coverDir) ? $coverDir : $cover_url;
        // var_dump($coverDir);die;
         //属性保存属性表中
         //插入spu，再
         
         //插sku
         //判断是商品图片是否修改，修改，先删除硬盘数据，之后删除该表图片数据，重新插入
        //  if($_FILES['image'])
         
         $skuId = DB::table('sku')->where('id',$data['id'])->update([
             'spu_id'=>$data['shop_brand'],
             'show_price'=>$data['show_price'],
             'bazzar_price'=>$data['bazzar_price'],
            //  'inventory'=>1000,
             'keyword'=>$data['keyword'],
             'describe'=>$data['content'],
             'content'=>$data['editorValue'],
             'cover'=>$coverDir,
             'inventory'=>$data['stock'],
             'weight'=>$data['weight'],
             'title'=>$data['title'],
         ]);
        //  var_dump($data);die;  
         
        


         static $attr_id = [];
         static $val_id = [];
         static $attr_value_id = [];
         //属性值保存属性值表中
         foreach($data['shop_attr'] as $k=>$v)
         {  
             $attr_id[] = DB::table('attr')->insertGetId([
                 'name'=>$v,
                 'spu_id'=>$category_id,
 
             ]);
 
             $val_id[] = DB::table('value')->insertGetId([
                 'name'=>$data['shop_value'][$k],
                 'attr_id'=>$attr_id[$k],
             ]);
 
             $attr_value_id[] = DB::table('shop_attr')->insertGetId([
                 'spu_id'=>$data['shop_brand'],
                 'attr_id'=>$attr_id[$k],
                 'value_id'=>$val_id[$k],
             ]);
         }
         
         // var_dump($attr_value_id);die;
         //更新suk-attr               
         $attr_str= implode(',',$attr_value_id);
         var_dump($data['id']);
         var_dump($attr_str);
         $update_sku_id = DB::table('sku')->where('id',$data['id'])
                                         ->update([
                                             'attr'=>$attr_str,
                                         ]);
                                         
         //删除属性名，属性值，商品属性表
         $attrArr = explode(',',$get_attr_id);
        //  var_dump($attrArr);die;
         foreach($attrArr as $v)
         {
             $get_attr_id = DB::table('shop_attr')->select('attr_id')->where('id',$v)->first()->attr_id;
            //  var_dump($get_value_id);die; 
             $get_value_id = DB::table('shop_attr')->select('value_id')->where('id',$v)->first()->value_id;
             
             $del_attr_id = DB::table('attr')->where('id',$get_attr_id)->delete();
             $del_value_id = DB::table('value')->where('id',$get_value_id)->delete();
             $del_attr_value = DB::table('shop_attr')->where('id',$v)->delete();
             
         }
        //  die;
         // var_dump($attr_id);die;
         
         return $update_sku_id;
    }

    public function getCategory($spu_id)
    {
        return $data = DB::select('
                        select b.id
                            from shop_spu a 
                            left join shop_category b on a.category_id = b.id
                            where '.$spu_id.'  = a.id
        ');
    }

    public function getUrl($id)
    {
        // dd($id);
        return $data = DB::table('shop_image')->where('sku_id',$id)->get();
    }
}
