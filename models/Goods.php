<?php
namespace models;
class Goods extends Model
{
    protected $table = 'Goods';
    protected $fillable = ['goods_name','logo','is_on_sale','description','cat1_id','cat2_id','cat3_id','brand_id'];
    //添加修改之前执行
    public function _before_write()
    {
        $this->_delete_logo();
        $uploader = \libs\Uploader::make();
        $logo = '/uploads/' . $uploader->upload('logo','goods');
        $this->data['logo'] = $logo;
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
        
        //商品图片
        $uploader = \libs\Uploader::make();
        $stmt = $this->_db->prepare("INSERT INTO goods_image
                    (goods_id,path)
                        VALUE(?,?)");

                    
        $_tmp = [];
        foreach($_FILES['image']['name'] as $k => $v)
        {
            $_tmp['name'] = $v;
            $_tmp['type'] = $_FILES['image']['type'][$k];
            $_tmp['tmp_name'] = $_FILES['image']['tmp_name'][$k];
            $_tmp['error'] = $_FILES['image']['error'][$k];
            $_tmp['size'] = $_FILES['image']['size'][$k];

            $_FILES['tmp'] = $_tmp;
            $path = '/uploads/' . $uploader->upload('tmp','goods');
            $a = $stmt->execute([
                $this->data['id'],
                $path,
            ]);
        }
        //SKU
        $stmt = $this->_db->prepare("INSERT INTO goods_sku
                    (goods_id,sku_name,stock,price)
                        VALUES(?,?,?,?)");
                        var_dump("23");
                        var_dump($_POST['sku_name']);
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
}