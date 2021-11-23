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
    $empresa = $Empresa->find("id", $logo[0]["id_pessoa"], false);
}
if (isset($empresa)) :
    //PEGAMOS SOMENTE OS NUMEROS DO CNPJ
    $cnpj      = str_replace(".", "", str_replace("/", "", str_replace("-", "", $empresa[0]["cpf_cnpj"])));
    //PEGAMOS O DIRETORIO BASE DO ICONE E DO LOGO
    $dir_logo  = "img/" . $cnpj .  "/logo/";
    $dir_icone = "img/" . $cnpj  . "/icone/";

    $full_icone = ($icone ? $dir_icone . $icone[0]["nome_arquivo"] : 'img/icon.png');
    $full_logo  = ($logo ? $dir_logo . $logo[1]["nome_arquivo"] : 'img/icon.png');
    define(
        "EMPRESA",
        array(
            "nome_fantasia" => $empresa[0]["nome_fantasia"],
            "sobrenome_razao" => $empresa[0]["sobrenome_razao"],
            "cpf_cnpj" => $empresa[0]["cpf_cnpj"],
            "rg_ie" => $empresa[0]["rg_ie"],
            "nascimento_fundacao" => $empresa[0]["nascimento_fundacao"],
            "logo" => $full_logo,
            "logo_nome" => $logo,
            "logo_dados" => '[{ caption: "' . $logo[1]["nome_arquivo"] . '", size: "' . strval(filesize($full_logo)) . '", key: 0 }]',
            "icone" => $full_icone,
            "icone_tamanho" => filesize($full_icone),
            "icone_nome" => $icone
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
