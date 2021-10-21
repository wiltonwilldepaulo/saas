<?php

namespace app\traits;

use PDOException;

trait Update
{
    /**
     * ESPERA UM ARRAY DE DUAS POSIÇÕES COM OS DADOS DE FILTRO OU WHERE, E COM OS VALORES DOS FIELDS DO
     * BANCO DE DADOS E OS VALORES DE CADA FIELD
     * @param array $updateFielAndValues
     * @return void
     */
    public function update(array $updateFielAndValues)
    {
        //ARMAZENA O NOME DOS FILDS E OS VALORES DOS FIELDS DO BANCO DE DADOS.
        $fields = $updateFielAndValues['fields'];
        //ARMAZENA OS FILTROS PARA O UPDATE
        $where = $updateFielAndValues['where'];
        //TRIBUIMOS O VALOR NULO PARA A VARIAVEL
        $updateFields = '';
        //PERCORREMOS TODAS A CHAVES DO NOSSO ARRAY
        foreach (array_keys($fields) as $field) :
            //CONTATENA O VALOR DA VARIAVEL COM O VALOR ANTERIORMENTE DEFINO
            $updateFields .= "{$field} = :{$field},";
        endforeach;
        $updateFields = rtrim($updateFields, ',');
        $whereUpdate = array_keys($where);
        //MARGE DOS ARRAY COM O FIELDS E COM O FILTRO
        $bind = array_merge($fields, $where);
        $sql = sprintf('update %s set %s where %s', $this->table, $updateFields, "{$whereUpdate[0]} = :{$whereUpdate[0]}");
        try {
            $prepare = $this->connection->prepare($sql);
            return $prepare->execute($bind);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}
