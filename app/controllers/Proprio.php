<?php

namespace app\controllers;

use app\database\models\Arquivo;
use app\database\models\Empresa;

class Proprio extends Base
{
    private $proprio;
    private $arquivo;

    public function __construct()
    {
        $this->proprio = new Empresa();
        $this->arquivo = new Arquivo();
    }
    public function listaproprio($request, $response)
    {
        $proprio = $this->proprio->find();
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
        if (isset($_GET["id"]) and !empty($_GET["id"])) :
            $id = $_GET["id"];
            $proprio = $this->proprio->findBy('id', $id, false);
            $acao = "e";
        else :
            $proprio = [];
            $acao = "c";
        endif;
        //RETORNAMOS A VIEW 
        return $this->getTwig()->render(
            $response,
            $this->setView("site/proprio"),
            [
                "titulo" => "Unesc - cadastro de empresa",
                "nome" => "WILTON WILL DE PAULO",
                "logo" => "http://localhost/img/34556785000103/logo/68ca94edbc9a99536e146c48b5b27472.png",
                "icone" => "http://localhost/img/34556785000103/icone/21f4df246dc7602141a5b0541fb0b92c.png",
                "proprio" => $proprio,
                "empresa" => EMPRESA,
                "acao" => $acao,
                "home" => "http://localhost",
                "lista" => "http://localhost/listaproprio",
                "base_url" => BASE_URL,
                "descricao_label" => "Controle e cadastro de empresa"
            ]
        );
    }

    public function controle($request, $response)
    {
        //VERIFICAMOS SE EXISTE A REQUISIÇÃO POST
        if (isset($_POST) and !empty($_POST)) :
            $this->proprio = new Empresa();
            $this->arquivo = new Arquivo();
            //CAPTURAMOS OS DADOS DO FORM
            $id                  = filter_input(INPUT_POST, 'edtid', FILTER_SANITIZE_STRING);
            $acao                = filter_input(INPUT_POST, 'edtacao', FILTER_SANITIZE_STRING);
            $nome_fantasia       = filter_input(INPUT_POST, 'nome_fantasia', FILTER_SANITIZE_STRING);
            $sobrenome_razao     = filter_input(INPUT_POST, 'razao_social', FILTER_SANITIZE_STRING);
            $cpf_cnpj            = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_STRING);
            $rg_ie               = filter_input(INPUT_POST, 'edtrg', FILTER_SANITIZE_STRING);
            $nascimento_fundacao = filter_input(INPUT_POST, 'data_inicio_atividade', FILTER_SANITIZE_STRING);
            //SELECIONAMOS AS IMAGENS
            $icone    = $_FILES['edticone'];
            $logo     = $_FILES['edtlogo'];
            $dir_logo  = ROOT . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . preg_replace('/[^0-9]/', '', $cpf_cnpj) . DIRECTORY_SEPARATOR .  "logo";
            $dir_icone  = ROOT . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR .  preg_replace('/[^0-9]/', '', $cpf_cnpj) . DIRECTORY_SEPARATOR .  "icone";
            if (!file_exists($dir_logo)) :
                mkdir($dir_logo, 0777, true);
            endif;
            if (!file_exists($dir_icone)) :
                mkdir($dir_icone, 0777, true);
            endif;
            //GERAMOS UM NOME ÚNICO PARA O LOGO
            $nome_logo = md5(uniqid(time()));
            //GERAMOS UM NOME ÚNICO PARA O ICONE
            $nome_icone = md5(uniqid(time()));
            //PEGAMOS A EXTENSÃO DO LOGO
            $ext_logo = pathinfo($logo["name"], PATHINFO_EXTENSION);
            //PEGAMOS A EXTENSÃO DO ICONE
            $ext_icone = pathinfo($icone["name"], PATHINFO_EXTENSION);
            switch ($acao):
                case 'c':
                    //SALVAMOS OS DADOS DA PESSOA NO BANCO DE DADOS
                    $arrayValues = array(
                        "nome_fantasia"       => $nome_fantasia,
                        "sobrenome_razao"     => $sobrenome_razao,
                        "cpf_cnpj"            => $cpf_cnpj,
                        "rg_ie"               => $rg_ie,
                        "nascimento_fundacao" => $nascimento_fundacao,
                        "data_cadastro"       => date("Y-m-d"),
                        "data_atualizacao"    => date("Y-m-d"),
                        "tipo_pessoa" => 0
                    );
                    $created = $this->proprio->create($arrayValues);
                    $id_proprio = $this->proprio->findLastId("id");
                    //MONTAMOS UM ARRAY COM OS DADOS DO ARUIVO DO LOGO.
                    $arrayValuesLogo = array(
                        "diretorio"    => $dir_logo . DIRECTORY_SEPARATOR . $nome_logo . "." . $ext_logo,
                        "extensao"     => "." . $ext_logo,
                        "id_pessoa"    => $id_proprio,
                        "titulo"       => "logo",
                        "nome_arquivo" => $nome_logo . "." . $ext_logo
                    );
                    //MONTAMOS UM ARRAY COM OS DADOS DO ARUIVO DO ICONE.
                    $arrayValuesIcone = array(
                        "diretorio"    => $dir_icone . DIRECTORY_SEPARATOR . $nome_icone . "." . $ext_icone,
                        "extensao"     => "." . $ext_icone,
                        "id_pessoa"    => $id_proprio,
                        "titulo"       => "icone",
                        "nome_arquivo" => $nome_icone . "." . $ext_icone
                    );
                    move_uploaded_file($logo['tmp_name'], $dir_logo . DIRECTORY_SEPARATOR . $nome_logo . "." . $ext_logo);
                    move_uploaded_file($icone['tmp_name'], $dir_icone . DIRECTORY_SEPARATOR . $nome_icone . "." . $ext_icone);
                    //SALVAMOS OS DADOS SO ICONE NO BANCO DE DADOS
                    $icone_success = $this->arquivo->create($arrayValuesIcone);
                    //SALVAMOS OS DADOS SO LOGO NO BANCO DE DADOS
                    $logo_success = $this->arquivo->create($arrayValuesLogo);
                    if ($icone_success and $logo_success and $created) :
                        echo $id_proprio;
                    else :
                        echo "false";
                    endif;
                    break;
                case 'e':
                    //VERIFICAMOS SE A AÇÃO É UMA EDIÇÃO;
                    //SALVAMOS OS DADOS DA PESSOA NO BANCO DE DADOS
                    $arrayValues = array(
                        "fields" => array(
                            "nome_fantasia"       => $nome_fantasia,
                            "sobrenome_razao"     => $sobrenome_razao,
                            "cpf_cnpj"            => $cpf_cnpj,
                            "rg_ie"               => $rg_ie,
                            "nascimento_fundacao" => $nascimento_fundacao,
                            "data_cadastro"       => date("Y-m-d"),
                            "data_atualizacao"    => date("Y-m-d"),
                            "tipo_pessoa"         => 0
                        ),
                        "where" => array(
                            "id" => $id
                        )
                    );
                    //RECEBEMOS O RESULTADO DA ATUALIZAÇÃO
                    $update = $this->proprio->update($arrayValues);
                    //VERIFICAMOS SE O UPDATE DEU CERTO
                    if ($update) :
                        echo "true";
                    else :
                        echo "false";
                    endif;
                    break;
                case 'd':
                    $delete = $this->proprio->delete('id', filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING));
                    if ($delete) :
                        echo "true";
                    else :
                        echo "false";
                    endif;
                    break;
            endswitch;
            die;
        endif;
    }
}
