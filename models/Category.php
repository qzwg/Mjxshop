<?php
namespace models;
class Category extends Model
{
    protected $table = 'category';
    protected $fillable = [''];

    public function getCat($parent_id = 0)
    {
        return $this->findAll([
            'where' => "parent_id=$parent_id"
        ]);
    }
}