<?php

namespace app\traits;

use app\database\Connection as Connect;

trait Connection
{
    protected $connection;
    public function __construct()
    {
        $this->connection = Connect::connection();
    }
}
