<?php

use app\database\models\Arquivo;

//CRIAMOS A CLASSE PROPRIO
$Arquivo = new Arquivo();
$logo    = $Arquivo->find("titulo", "logo", false);
$icone   = $Arquivo->find("titulo", "icone", false);
if ($logo) :
    //SELECIONAMOS O CAMINHO IMAGEM DO LOGO TIPO SALVOS NO BANCO.
    define("LOGO_DIR", $logo[0]["diretorio"]);
else :
    //DIRETÓRIO BASE DA APLICAÇÃO.
    define("LOGO_DIR", dirname(__FILE__, 3) . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "icon.png");
endif;

if ($icone) :
    //SELECIONAMOS O CAMINHO IMAGEM DO ICONE TIPO SALVOS NO BANCO.
    define("ICONE_DIR", $icone[0]["diretorio"]);
else :
    //DIRETÓRIO BASE DA APLICAÇÃO.
    define("ICONE_DIR", dirname(__FILE__, 3) . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "icon.png");
endif;
//DIRETÓRIO BASE DA APLICAÇÃO.
define("ROOT", dirname(__FILE__, 3));
//DIRETÓRIO DAS VIEWS
define("DIR_VIEWS", ROOT . "/app/views/");
//EXTENSSÃO PADRÃO DAS VIEWS
define("EXT_VIEWS", ".html");
