<?php

namespace App\Model;

use App\Entity\CategoryEntity;
use Core\Model;

class CategoriesModel extends Model {

    /**
     * @var string
     */
    protected $table = 'categories';


    /**
     * @var string
     */
    protected $entity = CategoryEntity::class;


    /**
     * Trouve les catégories en liste
     * @return array
     */
    public function findList(): array {
        $req = $this->db->getPDO()->query("SELECT id, name FROM {$this->table}");
        return $req->fetchAll(\PDO::FETCH_CLASS, $this->entity);
    }

}