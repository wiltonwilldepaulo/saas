<?php

namespace app\controllers;

class Proprio extends Base
{
    public function proprio($request, $response)
    {
        //RETORNAMOS A VIEW 
        return $this->getTwig()->render(
            $response,
            $this->setView("site/proprio"),
            [
                "titulo" => "Unesc - cadastro de empresa",
                "logo" => "",
                "nome" => "Wilton Will de Paulo",
                "home" => "http://localhost",
                "link" => "http://localhost",
                "descricao_label" => "Controle e cadastro de empresa"
            ]
        );
    }
}