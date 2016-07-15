<?php

use MyTarget\Token\ClientCredentials\Credentials;
use GuzzleHttp\Psr7 as psr7;
use MyTarget\Mapper\Type as t;

$autoloader = require_once __DIR__ . "/../vendor/autoload.php";

\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader([$autoloader, 'loadClass']);

$config = include __DIR__ . "/.config.php";
$credentials = new Credentials($config["client_id"], $config["client_secret"]);

$client = \MyTarget\simpleClient($credentials, __DIR__ . "/../var", $config["token_storage"]);
$mapper = \MyTarget\simpleMapper(true);

return [$client, $mapper, $config];
