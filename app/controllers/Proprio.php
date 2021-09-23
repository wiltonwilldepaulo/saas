<?php

namespace app\controllers;

use app\database\models\Empresa;

class Proprio extends Base
{
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
                "nome" => "Wilton Will de Paulo",
                "proprio" => $proprio,
                "home" => "http://localhost",
                "link" => "http://localhost",
                "base_url" => BASE_URL,
                "descricao_label" => "Controle e cadastro de empresa"
            ]
        );
    }
}
