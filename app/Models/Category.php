<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Category extends Model
{
    //
    public function insert($data)
    {
        // var_dump($data);die;
        $id = DB::table('category')->insertGetId([
            'category'=>$data['product-category-name'],
            'parent_id'=>$data['product-category-id'],
            'explain'=>$data['explain'],
        ]);
    }

    public function tree()
    {
        $data = DB::table('category')->get();
        // var_dump($data);die;
        $ret = $this->_tree($data);
        return $ret;
    }

    public function _tree($data,$parent_id=0,$level=0)
    {
        static $_ret = [];
        // var_dump($data);
        foreach($data as $v)
        {
            $v = get_object_vars($v);
            // var_dump($v);die;
            if($v['parent_id'] == $parent_id)
            {
                $v['level'] = $level;
                $_ret[] = $v;
                $this->_tree($data,$v['id'],$level+1);
            }
        }
        return $_ret;
    }
}
