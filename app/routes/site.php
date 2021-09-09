<?php
//Adionamos no use o Namespace do home
use app\controllers\Home;

$app->get('/', Home::class.":home");