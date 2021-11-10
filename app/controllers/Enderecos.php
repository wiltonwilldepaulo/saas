<?php

namespace app\controllers;

use app\database\models\Empresa;
use app\database\models\Endereco;

class Enderecos extends Base
{
    private $endereco;
    private $proprio;

    public function __construct()
    {
        $this->endereco = new Endereco();
        $this->proprio = new Empresa();
    }

    public function controle($request, $response)
    {
        //VERIFICAMOS SE EXISTE A REQUISIÇÃO POST
        if (isset($_POST) and !empty($_POST)) :
            $this->endereco = new Endereco();
            //CAPTURAMOS OS DADOS DO FORM
            $id                  = filter_input(INPUT_POST, 'edtid', FILTER_SANITIZE_STRING);
            $acao                = filter_input(INPUT_POST, 'edtacao', FILTER_SANITIZE_STRING);
            switch ($acao):
                case 'c':
                    echo '{ "status": true }';
                    break;
                case 'e':
                    echo '{ "status": true }';
                    break;
                case 'd':

                    break;
            endswitch;
            die;
        endif;
    }
}
