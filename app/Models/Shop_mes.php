<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Shop_mes extends Model
{
    //
    public function get_attr_arr($id)
    {
        //获取atrr数组，shop_attr查到attr_id
        $attrStr = DB::table('sku')->select('attr')->where('id',$id)->first()->attr;
        // var_dump($attrStr);die;
        $attrArr = explode(',',$attrStr);
        $attr = [];
        foreach($attrArr as $v)
        {
            $shop_attr = DB::table('shop_attr')->where('id',$v)->first(); 
            $attr_id = $shop_attr->attr_id;
            $value_id = $shop_attr->value_id;
            $sku_attr[] = DB::table('value')->where('id',$value_id)->first()->name;
            // var_dump($sku_attr);die;
            $attrObj = DB::table('attr')->where('id',$attr_id)->get();
            // var_dump($attrObj);die;
            $valueObj = DB::table('value')->where('attr_id',$attr_id)->get();
            $attr[] =  json_decode($attrObj, true);
            // var_dump($attr);die;
            $value[] = json_decode($valueObj);
            // var_dump($attr,$value);die;
        }
        // var_dump($attr);die;
        // var_dump($sku_attr);die;
        $sku_attr_str = implode(',',$sku_attr);
        // var_dump($sku_attr_str);die;
        return [
            'attr'=>$attr,
            'value'=>$value,
            'sku_attr_str'=>$sku_attr_str,
        ];
  
        
    }

    public function get_shop_image($id)
    {
        return $data = DB::table('shop_image')->where('sku_id',$id)->get();
        // var_dump($data);die;
    }

    public function get_sku_mes($id)
    {
        return $data = DB::table('sku')->where('id',$id)->first();
    }

    public function getAttr($idArr)
    {   
        // var_dump($idArr);die;
        $length = count($idArr);
        $sku_attr_arr = [];
        $sku_attrArr = [];
        // var_dump($idArr);die;
        for($i=0;$i<$length;$i++)
        {
            $shop_attr_id= DB::table('shop_attr')->select('id')->where('value_id',$idArr[$i])->first();
            if($shop_attr_id !== null)
                $sku_attr_arr[]  = $shop_attr_id->id;
            else
                $sku_attr_arr[] = false;
            // var_dump($sku_attr_arr);die;
            $sku_attrId = DB::table('value')->select('name')->where('id',$idArr[$i])->first();
            if($shop_attr_id !== null)
                $sku_attrArr[]  = $sku_attrId->name;
            else
                $sku_attrArr[] = false;
            // var_dump($sku_attrArr);die;

        }
        // var_dump(isset($sku_attr_arr) ? $sku_attr_arr : '');die;
        // var_dump(!in_array(false,$sku_attr_arr,true));die;
        // var_dump($sku_attr_arr);die;
        if(!in_array(false,$sku_attr_arr,true))
        {
            if($sku_attr_arr !== null)
            {
                $skuStr = implode(',',$sku_attr_arr);
                // var_dump($skuStr);die;
                $sku_id = DB::table("sku")->where('attr',$skuStr)->first();
                // var_dump($sku_attrArr);
                // var_dump($sku_id);die;
                return [
                    'skuMes'=>$sku_id,
                    'valueMes'=>$sku_attrArr,
                ];
            }
            // var_dump("sadf");die;
        }
        else
        {
            return null;
        }
        

        
        
        // $data  = DB::table('sku')->where('attr',$id)->first();
    }
}
