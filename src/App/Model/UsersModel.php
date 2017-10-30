<?php

namespace App\Model;

use Core\Model;

class UsersModel extends Model {

    /**
     * @var string
     */
    protected $table = 'users';


    /**
     * Enregistre un utilisateur
     * @param array $params
     * @return bool
     */
    public function register(array $params): bool {
        $req = $this->db
            ->prepare(
                "INSERT INTO {$this->table} 
                (login, password, mail, lastname, firstname, birthdate, registred_at) 
                VALUES (:login, :password, :mail, :lastname, :firstname, :birthdate, sysdate())"
            );

        extract($params);

        $req->bindValue(':login', $login);
        $req->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
        $req->bindValue(':mail', $mail);
        $req->bindValue(':lastname', $lastname);
        $req->bindValue(':firstname', $firstname);
        $req->bindValue('birthdate', $birthdate);

        return $req->execute();;
    }

}