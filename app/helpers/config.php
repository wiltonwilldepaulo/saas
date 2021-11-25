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
    if (!empty($icone[0])) :
        $full_icone = ($icone ? $dir_icone . $icone[0]["nome_arquivo"] : 'img/icon.png');
    else :
        $full_icone = "";
    endif;
    if (!empty($logo[1])) :
        $full_logo  = ($logo ? $dir_logo . $logo[1]["nome_arquivo"] : 'img/icon.png');
    else :
        $full_logo  = "";
    endif;
    define(
        "EMPRESA",
        array(
            "nome_fantasia" => $empresa[0]["nome_fantasia"],
            "sobrenome_razao" => $empresa[0]["sobrenome_razao"],
            "cpf_cnpj" => $empresa[0]["cpf_cnpj"],
            "rg_ie" => $empresa[0]["rg_ie"],
            "nascimento_fundacao" => $empresa[0]["nascimento_fundacao"],
            "logo_dados" => json_encode(
                array(
                    //CAPTURAMOS O NOME DA IMAGEM
                    "caption" => (($logo[0]) ? $logo[0]["nome_arquivo"] : ""),
                    //CAPTURAMOS O TAMANHO DA IMAGEM
                    "size" => ((file_exists($full_logo)) ? strval(filesize($full_logo)) : 0),
                    //DEFINIMOS O LINK PARA QUISIÇÕES DELETE 
                    "url" => "controlearquivo",
                    //PASSA O ID OU CÓDIGO DO ARQUIVO E A AÇÃO 
                    "extra" => array("id" => ((!empty($logo[1])) ? $logo[1]["id"] : "0"), "edtacao" => "dlogo", "dir" => $full_logo)
                )
            ),
            "icone_dados" => json_encode(
                array(
                    //CAPTURAMOS O NOME DA IMAGEM
                    "caption" => ((!empty($icone[0])) ? $icone[0]["nome_arquivo"] : ""),
                    //CAPTURAMOS O TAMANHO DA IMAGEM
                    "size" => strval((file_exists($full_icone)) ? filesize($full_icone) : 0),
                    //DEFINIMOS O LINK PARA QUISIÇÕES DELETE 
                    "url" => "controlearquivo",
                    //PASSA O ID OU CÓDIGO DO ARQUIVO E A AÇÃO 
                    "extra" => array("id" => (!empty($icone[0]) ? $icone[0]["id"] : "0"), "edtacao" => "dicone", "dir" => $full_icone)
                )
            ),
            "logo" => $full_logo,
            "icone" => $full_icone
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
