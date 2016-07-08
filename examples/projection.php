<?php

namespace Foo;

use MyTarget\Domain\V1\CampaignTargeting;
use MyTarget\Domain\V1\Enum\Sex;
use MyTarget\Domain\V1\Package;
use MyTarget\Domain\V1\Pad\Pad;
use MyTarget\Domain\V1\ProjectionCampaign;
use MyTarget\Domain\V1\User;
use MyTarget\Operator\V1\ProjectionOperator;

list($client, $mapper) = require __DIR__ . "/bootstrap.php";

$config = include __DIR__ . "/.config.php";

$projectionOp = new ProjectionOperator($client, $mapper);

$package = new Package();
$package->setId(83);

$targeting = new CampaignTargeting();
$targeting->setAge(range(20, 40));
$targeting->setSex(Sex::fromValue(Sex::MALE));

$pad = new Pad();
$pad->setId(5206);
$targeting->setPads([$pad]);

$user = new User();
$user->setId($config["user_id"]);

$campaign = new ProjectionCampaign($package, $targeting, $user);

$projection = $projectionOp->projection($campaign);

var_dump($projection);
