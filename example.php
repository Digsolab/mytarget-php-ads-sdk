<?php

use MyTarget\DomainFactory;
use Doctrine\Instantiator\Instantiator;
use MyTarget\Transport\RequestFactory;
use MyTarget\Transport\Middleware\HttpMiddlewareStackPrototype;
use MyTarget\Transport\GuzzleHttpTransport;
use MyTarget\Token\DoctrineCacheTokenStorage;
use MyTarget\Token\ClientCredentials\Credentials;
use MyTarget\Token\ClientGrantMiddleware;
use MyTarget\Client;
use MyTarget\Operator\V1\CampaignOperator;
use MyTarget\Operator\V1\Fields\CampaignFields;
use MyTarget\Token\TokenManager;
use MyTarget\Token\TokenAcquirer;
use GuzzleHttp\Psr7 as psr7;
use GuzzleHttp\Client as GuzzleClient;
use Doctrine\Common\Cache\FilesystemCache as DoctrineFileCache;

require_once __DIR__ . "/vendor/autoload.php";

$domainFactory = new DomainFactory(new Instantiator());

$requestFactory = new RequestFactory(new psr7\Uri("https://target.my.com"));

$guzzleClient = new GuzzleClient();
$http = new GuzzleHttpTransport($guzzleClient);

$httpStack = HttpMiddlewareStackPrototype::newEmpty($http);

$config = include __DIR__ . '/config.php';

$tokenCache = new DoctrineFileCache(__DIR__ . "/var");
$tokenStorage = new DoctrineCacheTokenStorage($tokenCache, function ($i) { return ""; });
$credentials = new Credentials($config["client_id"], $config["client_secret"]);
$tokenAcquirer = new TokenAcquirer(new psr7\Uri("https://target.my.com"), $http, $credentials);
$tokenManager = new TokenManager($tokenAcquirer, $tokenStorage);

$httpStack->push(new ClientGrantMiddleware($tokenManager));

$client = new Client($requestFactory, $httpStack);

$operator = new CampaignOperator($client, $domainFactory);

$campaigns = $operator->forClient($config["username"])
    ->all(CampaignFields::createEmpty()
        ->withBanners()
        ->withName()
        ->withId()
        ->withStatus());

var_dump($campaigns);
