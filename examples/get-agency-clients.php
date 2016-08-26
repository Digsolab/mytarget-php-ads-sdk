<?php

namespace Foo;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Operator\V1\ClientOperator;

list($client, $mapper) = require __DIR__ . "/bootstrap.php";

$clientOp = new ClientOperator($client, $mapper);

$clients = $clientOp->all();

var_dump($clients);
