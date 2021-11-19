<?php

namespace app\controllers;

use app\database\models\Empresa;
use app\database\models\Contato;
use PDOException;

class Contatos extends Base
{
    private $contato;
    private $proprio;

    public function __construct()
    {
        $this->contato = new Contato();
        $this->proprio = new Empresa();
    }

    public function controle($request, $response)
    {
        //VERIFICAMOS SE EXISTE A REQUISIÇÃO POST
        if (isset($_POST) and !empty($_POST)) :
            $this->contato = new Contato();
            //CAPTURAMOS OS DADOS DO FORM
            $id                  = filter_input(INPUT_POST, 'edtid', FILTER_SANITIZE_STRING);
            $idcontato                  = filter_input(INPUT_POST, 'edtidcontato', FILTER_SANITIZE_STRING);
            $acao                = filter_input(INPUT_POST, 'edtacao', FILTER_SANITIZE_STRING);
            $arrayValues = array(
                "id_pessoa" => filter_input(INPUT_POST, 'edtid', FILTER_SANITIZE_STRING),
                "tipo" => filter_input(INPUT_POST, 'tipocontato', FILTER_SANITIZE_STRING),
                "titulo" => filter_input(INPUT_POST, 'titulocontato', FILTER_SANITIZE_STRING),
                "contato" => filter_input(INPUT_POST, 'enderecocontato', FILTER_SANITIZE_STRING)
            );
            switch ($acao):
                case 'c':
                    try {
                        $created = $this->contato->create($arrayValues);
                        if ($created) {
                            echo '{ "status": true }';
                        } else {
                            echo '{ "status": false }';
                        }
                    } catch (PDOException $e) {
                        echo '{ "status": false, "erro": ' . $e->getMessage() . ' }';
                    }
                    break;
                case 'e':
                    echo '{ "status": true }';
                    break;
                case 'd':
                    try {
                        $delete = $this->contato->delete('id', $idcontato);
                        if ($delete) {
                            echo '{ "status": true }';
                        } else {
                            echo '{ "status": false }';
                        }
                    } catch (PDOException $e) {
                        echo '{ "status": false, "erro": ' . $e->getMessage() . ' }';
                    }
                    break;
                case 'l':
                    $find = $this->contato->findBy('id_pessoa', $id, true);
                    $html = "";
                    foreach ($find as $key => $value) :
                        $html = $html . "<div id='enderecocontato" . $value->id . "' class='list-group-item list-group-item-action active'>" .
                            "<div class='d-flex w-100 justify-content-between'>" .
                            "<h5 class='mb-1'>" . $value->titulo . "</h5>" .
                            "<button onclick='remove_contato(" . $value->id . ");' type='button'class='btn btn-sm btn-danger'>" .
                            "<i class='fas fa-trash'></i> Excluir" .
                            "</button>" .
                            "</div>" .
                            "<p class='mb-1'>" . $value->tipo . ": " . $value->contato . "</p>" .
                            "</div>";
                    endforeach;
                    echo $html;
                    break;
            endswitch;
            die;
        endif;
    }
}
