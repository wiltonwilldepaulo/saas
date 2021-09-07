<?php

require "../vendor/autoload.php";

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->get('/', function ($request, $response) {
    $response->getBody()->write("Hello");
    return $response;
});

// Run app
$app->run();
