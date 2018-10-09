<?php
namespace models;
class Role extends Model
{
    protected $table = 'role';
    protected $fillable = ['role_name'];

    protected function _after_write()
    {
        $stmt = $this->_db->prepare("INSERT INTO role_privlege(
            pri_id,role_id) VALUES(?,?)");
            foreach($_POST['pri_id'] as $v)
            {
                $stmt->execute([
                    $v,
                    $this->data['id'],
                ]);
            }
    }

    protected function _before_delete()
    {
        $stmt = $this->_db->prepare("delete from role_privlege where role_id=?");
        $stmt->execute([
            $_GET['id']
        ]);
    }
}