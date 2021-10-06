<?php

namespace app\controllers;

class Proprio extends Base
{
    public function listaproprio($request, $response)
    {
        //$Proprio = new Empresa;
        $proprio = []; //$Proprio->findAll();
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
        //$Proprio = new Empresa;
        $proprio = []; //$Proprio->findAll();
        //RETORNAMOS A VIEW 
        return $this->getTwig()->render(
            $response,
            $this->setView("site/proprio"),
            [
                "titulo" => "Unesc - cadastro de empresa",
                "nome" => "WILTON WILL DE PAULO",
                "logo" => "/img/icon.png",
                "proprio" => $proprio,
                "home" => "http://localhost",
                "lista" => "http://localhost/listaproprio",
                "base_url" => BASE_URL,
                "descricao_label" => "Controle e cadastro de empresa"
            ]
        );
    }
    public function controle($request, $response)
    {
        $response->withStatus(400);
        //pode funcionar assim
        $body = file_get_contents("php://input");
        //pode funcionar assim
        //$body = filter_input(INPUT_POST, 'dado', FILTER_SANITIZE_STRING);
        header("Content-Type: application/json"); //setting header before sending the JSON response back to the iPhone
        echo ($body); // Converting the request body into JSON format and sending it as a response back to the iPhone. After execution of this step I'm getting the above weird format data as a response on iPhone.
        die;
    }
}
