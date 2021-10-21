<?php

namespace app\traits;

use PDOException;

trait Create
{
    /**
     * ESPERA COMO PARAMETRO UM ARRAY ONDE O INDECE SERÁ O FIELD DA TABELA DO BANCO DE DADOS,
     * E O VALOR SERÁ ARMAZENADO NO BANCO.
     *
     * @param array $createFieldAndValues
     * @return void
     */
    public function create(array $createFieldAndValues)
    {
        try {
            //montamos a instrução insert.
            $sql = sprintf('insert into %s (%s) values (%s);', $this->table, implode(',', array_keys($createFieldAndValues)), ':' . implode(',:', array_keys($createFieldAndValues)));
            $prepared = $this->connection->prepare($sql);
            return $prepared->execute($createFieldAndValues);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}
