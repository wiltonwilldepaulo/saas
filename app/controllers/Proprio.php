<?php

namespace app\controllers;

use app\database\models\Empresa;

class Proprio extends Base
{
    public function listaproprio($request, $response)
    {

        $Proprio = new Empresa;
        $proprio = $Proprio->findAll();
        //RETORNAMOS A VIEW 
        return $this->getTwig()->render(
            $response,
            $this->setView("site/listaproprio"),
            [
                "titulo" => "Unesc - cadastro de empresa",
                "logo" => "",
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

        $Proprio = new Empresa;
        $proprio = $Proprio->findAll();
        //RETORNAMOS A VIEW 
        return $this->getTwig()->render(
            $response,
            $this->setView("site/proprio"),
            [
                "titulo" => "Unesc - cadastro de empresa",
                "logo" => "",
                "proprio" => $proprio,
                "home" => "http://localhost",
                "lista" => "http://localhost/listaproprio",
                "base_url" => BASE_URL,
                "descricao_label" => "Controle e cadastro de empresa"
            ]
        );
    }
}
