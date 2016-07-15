<?php

namespace foo;

use MyTarget\Domain\V1\Enum\ObjectType;
use MyTarget\Domain\V1\Enum\StatisticType;
use MyTarget\Operator\V1\StatisticOperator;
use MyTarget\Operator\V1\CampaignOperator;
use MyTarget\Domain\V1\CampaignStat;

list($client, $mapper, $config) = require __DIR__ . "/bootstrap.php";

$campaigns = new CampaignOperator($client, $mapper);
$operator = new StatisticOperator($client, $mapper);

$all = $campaigns->forClient($config["username"])->all();
$ids = array_map(function (CampaignStat $c) { return $c->getId(); }, $all);

$stats = $operator->forClient($config["username"])->all($ids, ObjectType::campaign(), StatisticType::day());

var_dump($stats);
