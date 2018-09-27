<?php
namespace models;
class Model
{
    protected $_db;
    protected $table;
    protected $data;

    public function __construct()
    {
        $this->_db = \libs\Db::make();
    }
    public function insert()
    {
        $keys = [];
        $values = [];
        $token = [];

        //预处理sql
        foreach($this->data as $k => $v)
        {
            $keys[] = $k;
            $values[] = $v;
            $token[] = "?";
        }
        $keys = implode(',',$keys);
        $token = implode(',',$token);
        $sql = "INSERT INTO {$this->table}($keys) VALUES($token)";
        var_dump($this->_db);
        $stmt = $this->_db->prepare($sql);
        return $stmt->execute($values);

    }

    public function update()
    {
        
    }

    public function delete()
    {
        
    }

    public function findAll()
    {
        
    }

    public function findOne()
    {
        
    }

    public function fill($data)
    {
        
        foreach($data as $k => $v)
        {
            if(!in_array($k,$this->fillable))
            {
                unset($data[$k]);
            }
        }
        $this->data = $data;
    }
}