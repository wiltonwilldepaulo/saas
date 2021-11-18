<?php

namespace app\controllers;

use app\database\models\Empresa;
use app\database\models\Endereco;
use PDOException;

class Enderecos extends Base
{
    private $endereco;
    private $proprio;

    public function __construct()
    {
        $this->endereco = new Endereco();
        $this->proprio = new Empresa();
    }

    public function controle($request, $response)
    {
        //VERIFICAMOS SE EXISTE A REQUISIÇÃO POST
        if (isset($_POST) and !empty($_POST)) :
            $this->endereco = new Endereco();
            //CAPTURAMOS OS DADOS DO FORM
            $id                  = filter_input(INPUT_POST, 'edtid', FILTER_SANITIZE_STRING);
            $acao                = filter_input(INPUT_POST, 'edtacao', FILTER_SANITIZE_STRING);
            $arrayValues = array(
                "id_pessoa" => filter_input(INPUT_POST, 'edtid', FILTER_SANITIZE_STRING),
                "cep" => filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING),
                "logradouro" => filter_input(INPUT_POST, 'logradouro', FILTER_SANITIZE_STRING),
                "numero" => filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING),
                "complemento" => filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING),
                "bairro" => filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING),
                "localidade" => filter_input(INPUT_POST, 'localidade', FILTER_SANITIZE_STRING),
                "uf" => filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_STRING),
                "ibge" => filter_input(INPUT_POST, 'ibge', FILTER_SANITIZE_STRING),
                "titulo" => filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING)
            );
            switch ($acao):
                case 'c':
                    try {
                        $created = $this->endereco->create($arrayValues);
                        if ($created) {
                            echo '{ "status": true }';
                        } else {
                            echo '{ "status": false }';
                        }
                    } catch (PDOException $e) {
                        echo '{ "status": false, "erro": ' . $e->getMessage() . ' }';
                    }
                    break;
                case 'e':
                    echo '{ "status": true }';
                    break;
                case 'd':

                    break;
                case 'l':
                    $find = $this->endereco->findBy('id_pessoa', $id, true);
                    echo json_encode($find);
                    break;
            endswitch;
            die;
        endif;
    }
}
