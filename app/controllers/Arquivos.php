<?php

namespace app\controllers;

use app\database\models\Empresa;
use app\database\models\Arquivo;
use PDOException;

class Arquivos extends Base
{
    private $arquivo;
    private $proprio;

    public function __construct()
    {
        $this->arquivo = new Arquivo();
        $this->proprio = new Empresa();
    }

    public function controle($request, $response)
    {
        //VERIFICAMOS SE EXISTE A REQUISIÇÃO POST
        if (isset($_POST) and !empty($_POST)) :

            $this->arquivo = new Arquivo();
            //CAPTURAMOS A AÇÃO DO FORM
            $acao                = filter_input(INPUT_POST, 'edtacao', FILTER_SANITIZE_STRING);
            //VERIFICAMOS QUAL A AÇÃO     
            switch ($acao):
                case 'l':
                    break;
            endswitch;
            //O RETORNO DEVE SER EM JSON
            echo json_encode(array("status" => true));
            die;
        endif;
    }
}
