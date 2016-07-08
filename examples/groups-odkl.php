<?php

namespace Foo;
use MyTarget\Operator\V1\GroupsOperator;

list($client, $mapper) = require __DIR__ . "/bootstrap.php";

$op = new GroupsOperator($client, $mapper);

$groups = $op->getOdklGroups("коты");

var_dump($groups);
