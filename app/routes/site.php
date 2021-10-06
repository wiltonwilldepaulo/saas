<?php
//Adionamos no use o Namespace do home
use app\controllers\Home;
use app\controllers\Proprio;

$app->get('/', Home::class . ":home");
$app->get('/listaproprio', Proprio::class . ":listaproprio");
$app->get('/proprio', Proprio::class . ":proprio");
$app->post('/controleproprio', Proprio::class . ":controle");
