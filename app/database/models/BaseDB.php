<?php

namespace app\database\models;

use app\traits\Read;
use app\traits\Connection;

abstract class BaseDB
{
    use Read, Connection;

}
