<?php

namespace Core;

class Model {

    /**
     * @var Database
     */
    protected $db;


    /**
     * @var string
     */
    protected $table;


    /**
     * @var string
     */
    protected $entity;


    /**
     * Model constructor.
     * @param Database $db
     */
    public function __construct(Database $db) {
        $this->db = $db;
    }


    /**
     * Crée un nouvel enregistrement
     *
     * @param array $params
     * @return bool
     */
    public function create(array $params): bool {
        $fields = join(array_keys($params), ', ');

        $n = count($params);
        $values = "";

        for($i=0; $i<$n; $i++) {
            if($i==$n-1) {
                $values .= '?';
            } else {
                $values .= '?, ';
            }
        }

        $req = $this->db->prepare("INSERT INTO {$this->table} ({$fields}) VALUES ({$values})");

        return $req->execute(array_values($params));
    }


    /**
     * Met à jour un enregistrement
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function update(int $id, array $params): bool {
        $fields = [];
        foreach (array_keys($params) as $field) {
            $fields[] = "$field = ?";
        }
        $fields = join($fields, ', ');

        $req = $this->db->prepare("UPDATE {$this->table} SET {$fields} WHERE id = ?");

        return $req->execute(array_merge(array_values($params), [$id]));
    }


    /**
     * Trouve un enregistrement
     * @param int $id
     * @return Entity|bool
     */
    public function find(int $id) {
        $req = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ? AND deleted_at IS NULL");
        $req->execute([$id]);
        if(!is_null($this->entity)) {
            $req->setFetchMode(\PDO::FETCH_CLASS, $this->entity);
        }
        return $req->fetch();
    }


    /**
     * Trouve tous les enregistrements
     * @return array
     */
    public function findAll(): array {
        $req = $this->db->query("SELECT * FROM {$this->table} WHERE deleted_at IS NULL");
        if(!is_null($this->entity)) {
            return $req->fetchAll(\PDO::FETCH_CLASS, $this->entity);
        }
        return $req->fetchAll();
    }


    /**
     * Liste les enregistrements
     * @return array
     */
    public function findList(): array {
        $req = $this->db->query("SELECT id, name FROM {$this->table}");
        return $req->fetchAll(\PDO::FETCH_CLASS, $this->entity);
    }


    /**
     * Supprime un enregistrement
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool {
        $req = $this->db->prepare("UPDATE {$this->table} SET deleted_at = sysdate() WHERE id = ?");
        return $req->execute([$id]);
    }


    /**
     * Restaure un enregistrement
     * @param int $id
     * @return bool
     */
    public function undelete(int $id): bool {
        $req = $this->db->prepare("UPDATE {$this->table} SET deleted_at = null WHERE id = ?");
        return $req->execute([$id]);
    }

}