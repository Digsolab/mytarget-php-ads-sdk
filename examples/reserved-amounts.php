<?php

namespace Foo;

use Dsl\MyTarget\Operator\V2\ReservedAmountsOperator;

list($client, $mapper, $config) = require __DIR__ . "/bootstrap.php";

$op = new ReservedAmountsOperator($client, $mapper);

$response = $op->find($config["agency_client_id"]);

var_dump($response);
