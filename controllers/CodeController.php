<?php
namespace controllers;
class CodeController
{
    public function make()
    {
        //接受参数
        $tableName = $_GET['name'];
        $tableName1 = ucfirst($tableName);
        //生成控制器
        $cname = ucfirst($tableName).'Controller';
        $mname = ucfirst($tableName);
        /**
         * 加载模版
         * 生成控制器
         */
        ob_start();
        include(ROOT . 'templates/controller.php');
        $str = ob_get_clean();
        file_put_contents(ROOT . 'controllers/' . $cname . '.php',"<?php\r\n" . $str);
        //生成模型
        
        ob_start();
        include(ROOT . 'templates/model.php');
        $str = ob_get_clean();
        file_put_contents(ROOT . 'models/'.$mname.'.php',"<?php\r\n".$str);

        //生成视图,创建目录，之后在此目录下生成文件
        @mkdir(ROOT . 'views/'.$tableName,0777);
        //取出表中所有字段信息
        $sql = "SHOW FULL FIELDS FROM $tableName";
        $db = \libs\Db::make();
        $stmt = $db->prepare($sql);
        
        $stmt->execute();
        $fields = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        // var_dump($fields);die;
       


        ob_start();
        include(ROOT . 'templates/create.html');
        $str = ob_get_clean();
        file_put_contents(ROOT . 'views/'.$tableName . '/create.html',$str);
        //edit.html
        ob_start();
        include(ROOT . 'templates/edit.html');
        $str = ob_get_clean();
        file_put_contents(ROOT . 'views/' . $tableName . '/edit.html',$str);
        //index.html
        ob_start();
        include(ROOT . 'templates/index.html');
        $str = ob_get_clean();
        file_put_contents(ROOT . 'views/' . $tableName . '/index.html',$str);
        
    }
}