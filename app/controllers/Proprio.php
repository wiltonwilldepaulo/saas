<?php

namespace app\controllers;

use app\database\models\Empresa;

class Proprio extends Base
{
    private $proprio;

    public function __construct()
    {
        $this->proprio = new Empresa();
    }
    public function listaproprio($request, $response)
    {
        $proprio = $this->proprio->find();
        //RETORNAMOS A VIEW 
        return $this->getTwig()->render(
            $response,
            $this->setView("site/listaproprio"),
            [
                "titulo" => "Unesc - cadastro de empresa",
                "nome" => "WILTON WILL DE PAULO",
                "logo" => "/img/icon.png",
                "proprio" => $proprio,
                "home" => "http://localhost",
                "cadastro" => "http://localhost/proprio",
                "base_url" => BASE_URL,
                "descricao_label" => "Controle e cadastro de empresa"
            ]
        );
    }
    public function proprio($request, $response)
    {
        if (isset($_GET["id"]) and !empty($_GET["id"])) :
            $id = $_GET["id"];
            $proprio = $this->proprio->findBy('id', $id, false);
            $acao = "e";
        else :
            $proprio = [];
            $acao = "c";
        endif;
        //RETORNAMOS A VIEW 
        return $this->getTwig()->render(
            $response,
            $this->setView("site/proprio"),
            [
                "titulo" => "Unesc - cadastro de empresa",
                "nome" => "WILTON WILL DE PAULO",
                "logo" => "/img/icon.png",
                "proprio" => $proprio,
                "acao" => $acao,
                "home" => "http://localhost",
                "lista" => "http://localhost/listaproprio",
                "base_url" => BASE_URL,
                "descricao_label" => "Controle e cadastro de empresa"
            ]
        );
    }

    public function controle($request, $response)
    {
        //VERIFICAMOS SE EXISTE A REQUISIÇÃO POST
        if (isset($_POST) and !empty($_POST)) :
            $this->proprio = new Empresa();
            //CAPTURAMOS OS DADOS DO FORM
            $acao                = filter_input(INPUT_POST, 'edtacao', FILTER_SANITIZE_STRING);
            $nome_fantasia       = filter_input(INPUT_POST, 'edtnome', FILTER_SANITIZE_STRING);
            $sobrenome_razao     = filter_input(INPUT_POST, 'edtsobrenome', FILTER_SANITIZE_STRING);
            $cpf_cnpj            = filter_input(INPUT_POST, 'edtcpf', FILTER_SANITIZE_STRING);
            $rg_ie               = filter_input(INPUT_POST, 'edtrg', FILTER_SANITIZE_STRING);
            $nascimento_fundacao = filter_input(INPUT_POST, 'edtnascimento', FILTER_SANITIZE_STRING);

            $arrayValues = array(
                "nome_fantasia"       => $nome_fantasia,
                "sobrenome_razao"     => $sobrenome_razao,
                "cpf_cnpj"            => $cpf_cnpj,
                "rg_ie"               => $rg_ie,
                "nascimento_fundacao" => $nascimento_fundacao,
                "tipo_pessoa" => 0
            );
            switch ($acao):
                case 'c':
                    $created = $this->proprio->create($arrayValues);
                    echo $created;
                    break;
            endswitch;
            die;
        endif;
    }
}
