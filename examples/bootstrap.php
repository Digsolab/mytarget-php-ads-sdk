<?php

use MyTarget\Token\ClientCredentials\Credentials;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Client as GuzzleClient;
use Doctrine\Common\Annotations\AnnotationRegistry;
use MyTarget\Transport\Middleware\HttpMiddlewareStackPrototype;
use MyTarget\Transport\Middleware\Impl\RequestResponseLoggerMiddleware;
use MyTarget\Transport\Middleware\Impl\ResponseValidatingMiddleware;
use MyTarget\Limiting\DoctrineCacheRateLimitProvider;
use MyTarget\Limiting\LimitingMiddleware;
use MyTarget\Token\TokenAcquirer;
use MyTarget\Token\TokenManager;
use MyTarget\Token\ClientGrantMiddleware;
use MyTarget\Client;
use MyTarget\Token\LockManager;

$autoloader = require_once __DIR__ . '/../vendor/autoload.php';

AnnotationRegistry::registerLoader([$autoloader, 'loadClass']);

$config = include __DIR__ . '/.config.php';
$credentials = new Credentials($config['client_id'], $config['client_secret']);

$baseUri = new Uri('https://target.my.com');

$requestFactory = new \MyTarget\Transport\RequestFactory($baseUri);
$http = new \MyTarget\Transport\GuzzleHttpTransport(new GuzzleClient());

$httpStack = HttpMiddlewareStackPrototype::newEmpty($http);
$httpStack->push(new RequestResponseLoggerMiddleware($config['logger']));
$httpStack->push(new ResponseValidatingMiddleware());

$rateLimitProvider = new DoctrineCacheRateLimitProvider($config['cache']);
$httpStack->push(new LimitingMiddleware($rateLimitProvider));

$lockManager = new LockManager($config['lock'], 'lock_my_target', 300);

$tokenAcquirer = new TokenAcquirer($baseUri, $http, $credentials);
$tokenManager = new TokenManager($tokenAcquirer, $config['token_storage']);
$httpStack->push(new ClientGrantMiddleware($tokenManager, $lockManager, $config['cache']));

$client = Client($requestFactory, $httpStack);

$mapper = \MyTarget\simpleMapper(true);

return [$client, $mapper, $config];
