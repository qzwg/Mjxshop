namespace controllers;
class <?=$cname?>
{
    public function index()
    {
        view('<?=$tableName?>/index');
    }

    public function create()
    {
        view('<?=$tableName?>/create');
    }

    public function insert()
    {
        view('<?=$tableName?>/insert');
    }

    public function edit()
    {
        view('<?=$tableName?>/edit');
    }

    public function update()
    {
        view('<?=$tableName?>/update');
    }

    public function delete()
    {
        view('<?=$tableName?>/delete');
    }
}