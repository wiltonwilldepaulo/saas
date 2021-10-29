<?php

namespace app\traits;

use PDOException;

trait Delete
{
    /**
     * ESPERA COMO PARAMETRO UM CAMPO ID DA TABELA DO BANCO DE DADOS,
     * E O REGISTRO SERÁ REMOVIDO DO BANCO.
     *
     * @param fiels 
     * @param value
     * @return void
     */
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
