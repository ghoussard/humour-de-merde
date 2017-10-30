<?php

namespace App\Model;

use App\Entity\JokeEntity;
use Core\Model;

class JokesModel extends Model {

    /**
     * @var string
     */
    protected $table = 'jokes';


    /**
     * @var string
     */
    protected $entity = JokeEntity::class;


    /**
     * Enregistre une blague
     * @param array $data
     * @return bool
     */
    public function proposeJoke(array $data): bool {
        $req = $this->db->prepare(
            "INSERT INTO {$this->table}
            (content, posted_at, user_id, category_id)
            VALUES (:content, NOW(), :user_id, :category_id)"
        );

        extract($data);

        $req->bindValue(':content', $content);
        $req->bindValue(':user_id', $user_id);
        $req->bindValue(':category_id', $category_id);

        return $req->execute();
    }
}