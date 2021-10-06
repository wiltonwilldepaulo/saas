<?php

require "../vendor/autoload.php";

use Slim\Factory\AppFactory;


$app = AppFactory::create();
define("BASE_URL", $app->getBasePath());
//INCLUIMOS AS CONFIGURAÇÕES
require "../app/helpers/config.php";
//INCLUIMOS TODAS AS ROTAS.
require "../app/routes/site.php";
//RUM APP
$app->run();
