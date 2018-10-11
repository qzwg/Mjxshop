<?php
namespace models;
class Goods extends Model
{
    protected $table = 'Goods';
    protected $fillable = ['goods_name','logo','is_on_sale','description','cat1_id','cat2_id','cat3_id','brand_id'];
    //添加修改之前执行
    public function _before_write()
    {
        if($_FILES['logo']['error'] == 0)
        {
            $this->_delete_logo();
            $uploader = \libs\Uploader::make();
            $logo = '/uploads/' . $uploader->upload('logo','goods');
            $this->data['logo'] = $logo;
        }
    }

    public function _before_delete()
    {
        $this->_delete_logo();
    }

    protected function _delete_logo()
    {
        if(isset($_GET['id']))
        {
            $ol = $this->findOne($_GET['id']);
            @unlink(ROOT . 'public' . $ol['logo']);
        }
    }

    public function _after_write()
    {
        $goodsId = isset($_GET['id']) ? $_GET['id'] : $this->data['id'];
        $stmt = $this->_db->prepare("DELETE FROM goods_attribute WHERE goods_id=?");
        $stmt->execute([$goodsId]);

        $stmt = $this->_db->prepare("INSERT INTO goods_attribute
                    (attr_name,attr_value,goods_id) 
                        VALUES(?,?,?)");
       
        
        foreach($_POST['attr_name'] as $k => $v)
        {
            $stmt->execute([
                $v,
                $_POST['attr_value'][$k],
                $this->data['id'],
            ]);
        }
        if(isset($_POST['del_image']) && $_POST['del_image'] !='')
        {
        $stmt = $this->_db->prepare("SELECT path FROM goods_image WHERE id IN({$_POST['del_image']}");
            $stmt->execute();
            $path = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach($path as $v)
            {
                @unlink(ROOT.'public/'.$v['path']);
            }
            $stmt = $this->_db->prepare("DELETE FROM goods_image WHERE id IN({$_POST['del_image']})");
            $a = $stmt->execute();
        }

        //商品图片
        $uploader = \libs\Uploader::make();
        $stmt = $this->_db->prepare("INSERT INTO goods_image
                    (goods_id,path)
                        VALUE(?,?)");

        var_dump($stmt);  
        $_tmp = [];
        foreach($_FILES['image']['name'] as $k => $v)
        {
            if($_FILES['image']['error'][$k] == 0)
            {
                $_tmp['name'] = $v;
                $_tmp['type'] = $_FILES['image']['type'][$k];
                $_tmp['tmp_name'] = $_FILES['image']['tmp_name'][$k];
                $_tmp['error'] = $_FILES['image']['error'][$k];
                $_tmp['size'] = $_FILES['image']['size'][$k];
                var_dump($goodsId);
                $_FILES['tmp'] = $_tmp;
                $path = '/uploads/' . $uploader->upload('tmp','goods');
                $a = $stmt->execute([
                    $goodsId,
                    $path,
                ]);
            }
        }
        //SKU
        $stmt = $this->_db->prepare("INSERT INTO goods_sku
                    (goods_id,sku_name,stock,price)
                        VALUES(?,?,?,?)");
        foreach($_POST['sku_name'] as $k => $v)
        {
            $stmt->execute([
                $this->data['id'],
                $v,
                $_POST['stock'][$k],
                $_POST['price'][$k],
            ]);
        }
    }

    public function getFullInfo($id)
    {
        // 获取商品的基本信息
        $stmt = $this->_db->prepare("SELECT * FROM goods WHERE id=?");
        $stmt->execute([$id]);
        $info = $stmt->fetch(\PDO::FETCH_ASSOC);
        // 获取商品属性信息
        $stmt = $this->_db->prepare("SELECT * FROM goods_attribute WHERE goods_id=?");
        $stmt->execute([$id]);
        $attrs = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        // 获取商品图片
        $stmt = $this->_db->prepare("SELECT * FROM goods_image WHERE goods_id=?");
        $stmt->execute([$id]);
        $images = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        // 获取商品SKU
        $stmt = $this->_db->prepare("SELECT * FROM goods_sku WHERE goods_id=?");
        $stmt->execute([$id]);
        $skus = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        // 返回所有数据
        return [
            'info' => $info,
            'images' => $images,
            'skus' => $skus,
            'attrs' => $attrs,
        ];
    }
}