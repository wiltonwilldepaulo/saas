<?php

namespace app\database\models;

use app\traits\Read;
use app\traits\Connection;
use app\traits\Create;

abstract class BaseDB
{
    use Create, Read, Connection;
}
