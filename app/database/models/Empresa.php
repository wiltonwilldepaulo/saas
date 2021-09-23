<?php

namespace app\database\models;

use app\database\Connection;
use PDO;
use PDOException;

class Empresa
{
    protected $table = 'pessoa';
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::connection();
    }

    public function findAll()
    {
        try {
            $query = $this->connection->query('select * from ' . $this->table);
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}
