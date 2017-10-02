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

}