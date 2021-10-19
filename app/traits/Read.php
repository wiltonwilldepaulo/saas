<?php

namespace app\traits;

use PDO;
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
            //MONTAMOS A ESTRUTURA DO SQL
            $sql = "select * from {$this->table} where {$field} = :{$field}";
            $prepared = $this->connection->prepare($sql);
            $prepared->bindValue(":{$field}", $value);
            $prepared->execute();
            //CASO O VALOR PADRÃO DO PARAMETRO SEJA TRUE RETORNA TODOSS OS REGISTRO DO BANCO.
            return $fetchAll ? $prepared->fetchAll(PDO::FETCH_OBJ) : $prepared->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    /**
     * RETORNA O ULTIMO ID GERADO
     *
     * @return  self
     */
    public function findLastId($field)
    {
        try {
            $query = $this->connection->query("select max({$field}) as {$field} from {$this->table}");
            $data = $query->fetch();
            return $data[$field];
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}
