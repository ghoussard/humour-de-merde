<?php

namespace Core\Auth;

use App\Entity\UserEntity;
use Core\Database;

class DatabaseAuth {

    /**
     * @var Database
     */
    private $db;


    /**
     * @var string
     */
    private $users_table = 'users';


    /**
     * @var string
     */
    private $user_entity = UserEntity::class;


    public function __construct(Database $db) {
        $this->db = $db;
    }


    /**
     * Connecte un utilisateur
     * @param null|string $login
     * @param null|string $password
     * @return bool
     */
    public function login(?string $login, ?string $password): bool {
        if(is_null($login)||is_null($password)) {
            return false;
        }

        $req = $this->db->getPDO()->prepare("SELECT * FROM {$this->users_table} WHERE login = :login OR mail = :login");
        $req->execute([':login' => $login]);
        $req->setFetchMode(\PDO::FETCH_CLASS, $this->user_entity);
        $user = $req->fetch();

        if(is_null($user)) {
            return false;
        }

        if(!password_verify($password, $user->password)) {
            return false;
        }

        return true;
    }


    /**
     * Enregistre un utilisateur
     * @param array $params
     * @return bool
     */
    public function register(array $params): bool {
        $req = $this->db->getPDO()
            ->prepare(
                "INSERT INTO {$this->users_table} 
                (login, password, mail, firstname, lastname, birthdate, registred_at) 
                VALUES (:login, :password, :mail, :firstname, :lastname, :birthdate, sysdate())"
            );

        extract($params);

        $req->bindValue(':login', $login);
        $req->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
        $req->bindValue(':mail', $mail);
        $req->bindValue(':firstname', $firstname);
        $req->bindValue(':lastname', $lastname);
        $req->bindValue('birthdate', $birthdate);

        return $req->execute();
    }
}