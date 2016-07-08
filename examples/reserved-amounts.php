<?php

namespace Foo;

use MyTarget\Operator\V2\ReservedAmountsOperator;

list($client, $mapper) = require __DIR__ . "/bootstrap.php";

$config = include __DIR__ . "/.config.php";

$op = new ReservedAmountsOperator($client, $mapper);

$response = $op->find($config["agency_client_id"]);

var_dump($response);
