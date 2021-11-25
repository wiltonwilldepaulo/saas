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
            $acao = filter_input(INPUT_POST, 'edtacao', FILTER_SANITIZE_STRING);
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            //SELECIONAMOS O CAMINHO COMPLETE DO ARQUIVO
            $dir = filter_input(INPUT_POST, 'dir', FILTER_SANITIZE_STRING);
            //VERIFICAMOS QUAL A AÇÃO     
            switch ($acao):
                case 'dlogo':
                    try {
                        //VERIFICAMOS SE O ARQUIVO EXISTE
                        if (file_exists($dir))
                            unlink($dir); //REMOVEMOS O ARQUIVO
                        //DELETAMOS O REGISTRO DO BANCO DE DADOS    
                        $dados = $this->arquivo->delete('id', $id);
                        //O RETORNO DEVE SER EM JSON
                        echo json_encode(array("status" => true));
                    } catch (PDOException $e) {
                        var_dump($e->getMessage());
                    }
                    break;
                case 'dicone':
                    try {
                        //VERIFICAMOS SE O ARQUIVO EXISTE
                        if (file_exists($dir))
                            unlink($dir); //REMOVEMOS O ARQUIVO
                        //DELETAMOS O REGISTRO DO BANCO DE DADOS 
                        $dados = $this->arquivo->delete('id', $id);
                        //O RETORNO DEVE SER EM JSON
                        echo json_encode(array("status" => true));
                    } catch (PDOException $e) {
                        var_dump($e->getMessage());
                    }
                    break;
            endswitch;

            die;
        endif;
    }
}
