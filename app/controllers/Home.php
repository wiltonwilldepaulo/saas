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
                "titulo" => "Unesc - loja de saas",
                "logo" => "/img/icon.png",
                "nome" => "WILTON WILL DE PAULO",
                "link" => "http://localhost/cliente",
                "descricao_label" => "Clientes",
                "logo" => EMPRESA["logo"],
                "icone" =>  EMPRESA["icone"],
                "empresa" => EMPRESA,
                "home" => "http://localhost",
                "lista" => "http://localhost/listaproprio",
                "base_url" => BASE_URL,
                "descricao_label" => "Controle e cadastro de empresa"
            ]
        );
    }
}
