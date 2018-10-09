<?php
namespace models;
use PDO;
class Admin extends Model
{
    protected $table = 'admin';
    protected $fillable = ['username','password'];
    public function _before_write()
    {
        $this->data['password'] = md5($this->data['password']);
    }

    public function _after_write()
    {   
        $id = isset($_GET['id']) ? $_GET['id'] : $this->data['id'];
        //删除原数据
        $stmt = $this->_db->prepare('DELETE FROM admin_role WHERE admin_id=?');
        $stmt->execute([
            $id
        ]);
        //添加新数据
        $stmt = $this->_db->prepare("INSERT INTO admin_role(admin_id,role_id) VALUES(?,?)");
        
        foreach($_POST['role_id'] as $v)
        {
           $stmt->execute([
                $id,
                $v,
            ]);
            
        }

    }

    //登陆
    public function login($username,$password)
    {   
        $stmt = $this->_db->prepare('SELECT * FROM admin WHERE username=? AND password=?');
        $a = $stmt->execute([
            $username,
            md5($password),
        ]);
        $info = $stmt->fetch(PDO::FETCH_ASSOC);
        if($info)
        {
            $_SESSION['id'] = $info['id'];
            $_SESSION['username'] = $info['username'];

            $stmt = $this->_db->prepare('SELECT COUNT(*) FROM admin_role WHERE role_id=1 AND admin_id=?');
            $stmt->execute([$_SESSION['id']]);
            $c = $stmt->fetch(\PDO::FETCH_COLUMN);
            if($c>0)
                $_SESSION['root'] = true;
            else
                $_SESSION['url_path'] = $this->getUalPath($_SESSION['id']);
        }
        else
        {
            throw new \Exception('用户名或者密码错误！');
        }
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();
    }

    public function getUalPath($adminId)
    {
        $sql = "SELECT c.url_path
                    FROM admin_role a
                        LEFT JOIN role_privlege b ON a.role_id = b.role_id
                        LEFT JOIN privilege c ON b.pri_id = c.id
                        WHERE a.admin_id=? AND c.url_path!=''
                ";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute([$adminId]);
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        $_ret = [];
        foreach($data as $v)
        {
            if(FALSE === strpos($v['url_path'],','))
            {
                $_ret[] = $v['url_path'];
            }
            else
            {
                $_tt = explode(',',$v['url_path']);
                $_ret = array_merge($_ret,$_tt);
            }
        }
        return $_ret;

    }
}