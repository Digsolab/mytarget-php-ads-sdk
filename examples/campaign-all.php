<?php

use Dsl\MyTarget\Operator\V1\CampaignOperator;
use Dsl\MyTarget\Operator\V1\Fields\CampaignFields;

list($client, $mapper, $config) = require __DIR__ . "/bootstrap.php";

$operator = new CampaignOperator($client, $mapper);

$campaigns = $operator->forClient($config["username"])
    ->all(CampaignFields::create());

var_dump($campaigns);
