<?php

namespace app\database\models;

use app\traits\Read;
use app\traits\Connection;
use app\traits\Create;
use app\traits\Delete;
use app\traits\Update;

abstract class BaseDB
{
    use Update, Create, Read, Delete, Connection;
}
