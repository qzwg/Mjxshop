namespace controllers;
use models\<?=$mname?>;
class <?=$cname?>
{
    public function index()
    {
        $model = new <?=$mname?>;
        $data = $model->findAll();
        view('<?=$tableName?>/index',$data);
    }

    public function create()
    {
        view('<?=$tableName?>/create');
    }

    public function insert()
    {
        $<?=$tableName?> = new <?=$tableName1?>;
        $<?=$tableName?>->fill($_POST);
        $<?=$tableName?>->insert();
        header('Location:/<?=$tableName?>/index');
    }

    public function edit()
    {
        $model = new <?=$mname?>;
        $data = $model->findOne($_GET['id']);
        view('<?=$tableName?>/edit',[
            'data'=>$data,
        ]);
    }

    public function update()
    {
        $model = new <?=$mname?>;
        $model->fill($_POST);
        $model->update($_GET['id']);
        header('/<?=$tableName?>/index');
    }

    public function delete()
    {
        $model = new <?=$mname?>;
        $model->delete($_GET['id']);
        header('/<?=$tableName?>/index');
    }
}