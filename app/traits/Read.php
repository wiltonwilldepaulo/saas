<?php

namespace app\traits;

use PDOException;

trait Read
{
    /**
     * CASO NÃO SEJA MUDADO O VALOR DEFAULT TRUE DO PARAMETRO, SEMPRE RETORNARÁ TODOS OS REGISTROS DO BANCO
     *
     * @return  self
     */
    public function find($fetchAll = true)
    {
        try {
            $query = $this->connection->query("select * from {$this->table}");
            //CASO O VALOR PADRÃO DO PARAMETRO SEJA TRUE RETORNA TODOSS OS REGISTRO DO BANCO.
            return $fetchAll ? $query->fetchAll() : $query->fetch();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
    /**
     * DEVE SER INFORMADO O CAMPO PELO QUAL SE DESEJA FAZER A PESQUISA, E CASO NÃO SEJA MUDADO O VALOR DEFAULT TRUE DO PARAMETRO, SEMPRE RETORNARÁ TODOS OS REGISTROS DO BANCO
     *
     * @return  self
     */
    public function findBy($field, $value, $fetchAll = true)
    {
        try {
            $prepared = $this->connection->prepared("select * from {$this->table} where {$field} = :{$field}");
            $prepared->bindValue(":{$field}", $value);
            $prepared->execute();
            //CASO O VALOR PADRÃO DO PARAMETRO SEJA TRUE RETORNA TODOSS OS REGISTRO DO BANCO.
            return $fetchAll ? $prepared->fetchAll() : $prepared->fetch();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}
