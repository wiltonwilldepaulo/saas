<?php

use app\database\models\Arquivo;
use app\database\models\Empresa;

//CRIAMOS A CLASSE ARQUIVO
$Arquivo = new Arquivo();
//CRIAMOS A CLASSE PROPRIO
$Empresa = new Empresa();

//CONTRANTES DO O DIRETORIO DO LOGO E DO ICONE.
$logo    = $Arquivo->find("titulo", "logo", false);
$icone   = $Arquivo->find("titulo", "icone", false);

if (($icone) or ($logo)) {
    $empresa = $Empresa->find("id", $icone[0]["id_pessoa"], false);
}

if (isset($empresa)) :
    //PEGAMOS SOMENTE OS NUMEROS DO CNPJ
    $cnpj      = str_replace(".", "", str_replace("/", "", str_replace("-", "", $empresa[0]["cpf_cnpj"])));
    //PEGAMOS O DIRETORIO BASE DO ICONE E DO LOGO
    $dir_logo  = "img" . DIRECTORY_SEPARATOR . $cnpj . DIRECTORY_SEPARATOR . "logo" . DIRECTORY_SEPARATOR;
    $dir_icone = "img" . DIRECTORY_SEPARATOR . $cnpj . DIRECTORY_SEPARATOR . "icone" . DIRECTORY_SEPARATOR;
    $full_icone = ($icone ? $dir_icone . $logo[0]["nome_arquivo"] : dirname(__FILE__, 3));
    $full_logo  = ($logo ? $dir_logo . $logo[0]["nome_arquivo"] : dirname(__FILE__, 3));
    define(
        "EMPRESA",
        array(
            "nome_fantasia" => $empresa[0]["nome_fantasia"],
            "sobrenome_razao" => $empresa[0]["sobrenome_razao"],
            "cpf_cnpj" => $empresa[0]["cpf_cnpj"],
            "rg_ie" => $empresa[0]["rg_ie"],
            "nascimento_fundacao" => $empresa[0]["nascimento_fundacao"],
            "logo" => $full_icone,
            "icone" => $full_logo
        )
    );
else :
    define(
        "EMPRESA",
        array(
            "nome_fantasia" => "",
            "sobrenome_razao" => "",
            "cpf_cnpj" => "",
            "rg_ie" => "",
            "nascimento_fundacao" => "",
            "logo" => "/img/icon.png",
            "icone" => "/img/icon.png"
        )
    );

endif;

//DIRETÓRIO BASE DA APLICAÇÃO.
define("ROOT", dirname(__FILE__, 3));
//DIRETÓRIO DAS VIEWS
define("DIR_VIEWS", ROOT . "/app/views/");
//EXTENSSÃO PADRÃO DAS VIEWS
define("EXT_VIEWS", ".html");
