<?php

namespace app\controllers;

use Exception;
use Slim\Views\Twig;

abstract class Base
{
    public function getTwig()
    {
        try {
            //
            return Twig::create(DIR_VIEWS);
        } catch (Exception $e) {
            //RETORNAMOS O ERRO.
            var_dump($e->getMessage());
        }
    }

    public function setView($name)
    {
        return $name . EXT_VIEWS;
    }
}
