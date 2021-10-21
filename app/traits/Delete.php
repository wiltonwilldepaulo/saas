<?php

namespace app\traits;

use PDOException;

trait Delete
{
    public function delete($field, $value)
    {
        try {
            $prepare = $this->connection->prepare("delete from $this->table where {$field} = :{$field}");
            $prepare->bindValue($field, $value);
            return $prepare->execute();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}
