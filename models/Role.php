<?php
namespace models;
class Role extends Model
{
    protected $table = 'role';
    protected $fillable = ['role_name'];

    protected function _after_write()
    {
        $roleId = isset($_GET['id']) ? $_GET['id'] : $this->data['id'];
        //删除原全权限
        $stmt = $this->_db->prepare('DELETE FROM role_privlege WHERE role_id=?');
        $stmt->execute([
            $roleId
        ]);
        $stmt = $this->_db->prepare("INSERT INTO role_privlege(
            pri_id,role_id) VALUES(?,?)");
            foreach($_POST['pri_id'] as $v)
            {
                $stmt->execute([
                    $v,
                    $roleId,
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

    public function getPriIds($roleId)
    {
        $stmt = $this->_db->prepare('SELECT pri_id FROM role_privlege WHERE role_id=?');
        $stmt->execute([
            $roleId
        ]);
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $_ret = [];
        foreach($data as $k => $v)
        {
            $_ret[] = $v['pri_id'];
        }
        return $_ret;
    }
}