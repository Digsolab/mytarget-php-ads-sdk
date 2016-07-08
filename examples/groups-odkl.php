<?php

namespace Foo;
use MyTarget\Operator\V1\GroupsOperator;

list($client, $converter) = require __DIR__ . "/bootstrap.php";

$op = new GroupsOperator($client, $converter);

$groups = $op->getOdklGroups("коты");

var_dump($groups);
