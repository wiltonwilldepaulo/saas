<?php

namespace app\database;

use PDO;
use PDOException;

class Connection
{
    //VARIAVEL DE CONEXÃO COM BANCO DE DADOS.
    private static $pdo = null;
    //METODO DE CONEXÃO COM BANCO DE DADOS
    public static function connection()
    {
        //CASO JÁ EXISTA UMA CONEXÃO COM BANCO RETORNASMOS A CONEXÃO
        if (static::$pdo) {
            return static::$pdo;
        }
        try {
            //CASO A MINHA CONEXÃO COM BANCO DADOS NÃO EXISTA, CRIAMOS UMA NOVA CONEXÃO COM BANCO DADOS.
            static::$pdo = new PDO('pgsql:host=localhost;port=5432;dbname=saasmanager;user=postgres;password=root');
            //CASO A CONEXÃO COM BANCO DE DADO SEJA BEM SUCEDIDA, RETORNAMOS A MESMA.
            return static::$pdo;
        } catch (PDOException $e) {
            //CASO TENHAMOS ALGUMA FALHA AO CONECTAR COM BANCO DE DADOS RETORNAMOS A MENSAGEM DE ERRO.
            var_dump($e->getMessage());
        }
    }
}
