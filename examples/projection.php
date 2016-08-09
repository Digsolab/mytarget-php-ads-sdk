<?php

namespace Foo;

use Dsl\MyTarget\Domain\V1\Targeting\CampaignTargeting;
use Dsl\MyTarget\Domain\V1\Enum\Sex;
use Dsl\MyTarget\Domain\V1\Campaign\Package;
use Dsl\MyTarget\Domain\V1\Targeting\Pad\Pad;
use Dsl\MyTarget\Domain\V1\Campaign\Projection\ProjectionCampaign;
use Dsl\MyTarget\Domain\V1\User;
use Dsl\MyTarget\Operator\V1\ProjectionOperator;

list($client, $mapper, $config) = require __DIR__ . "/bootstrap.php";

$projectionOp = new ProjectionOperator($client, $mapper);

$package = new Package(83);

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
