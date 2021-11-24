<?php
//Adionamos no use o Namespace do home

use app\controllers\Arquivos;
use app\controllers\Home;
use app\controllers\Proprio;
use app\controllers\Enderecos;
use app\controllers\Contatos;

$app->get('/', Home::class . ":home");
$app->get('/listaproprio', Proprio::class . ":listaproprio");
$app->get('/proprio', Proprio::class . ":proprio");
$app->post('/controleproprio', Proprio::class . ":controle");
$app->post('/controlearquivo', Arquivos::class . ":controle");
$app->post('/controleendereco', Enderecos::class . ":controle");
$app->post('/controlecontato', Contatos::class . ":controle");
