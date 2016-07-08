<?php

use MyTarget\Operator\V1\CampaignOperator;
use MyTarget\Operator\V1\Fields\CampaignFields;

list($client, $converter) = require __DIR__ . "/bootstrap.php";

$operator = new CampaignOperator($client, $converter);

$campaigns = $operator->forClient($config["username"])
    ->all(CampaignFields::createEmpty()
        ->withBanners()
        ->withName()
        ->withId()
        ->withStatus());

var_dump($campaigns);
