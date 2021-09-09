<?php

namespace app\controllers;

class Home extends Base
{
    public function home($request, $response)
    {
        return $this->getTwig()->render(
            $response,
            $this->setView("site/home"),
            [
                "quantidade_cliente" => "110",
                "link" => "http://localhost/cliente",
                "descricao_label" => "Clientes"
            ]
        );
    }
}
