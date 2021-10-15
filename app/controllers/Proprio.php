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
            //CAPTURAMOS OS DADOS DO FORM
            $foto = $_FILES["edtlogo"];
            var_dump($foto);
            die;
        endif;
    }
}
