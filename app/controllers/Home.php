<?php

namespace app\controllers;

class Home extends Base
{
    public function home($request, $response)
    {
        //RETORNAMOS A VIEW 
        return $this->getTwig()->render(
            $response,
            $this->setView("site/home"),
            [
                "titulo" => "teste",
                "link" => "http://localhost/cliente",
                "descricao_label" => "Clientes"
            ]
        );
    }
}
