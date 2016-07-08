<?php

namespace MyTarget;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Instantiator\Instantiator as DoctrineInstantiator;
use Doctrine\Common\Cache\FilesystemCache as DoctrineFileCache;
use GuzzleHttp\Psr7 as psr7;
use GuzzleHttp\Client as GuzzleClient;

use MyTarget\Exception\DecodingException;
use MyTarget\Limiting as lim;
use MyTarget\Token as tok;
use MyTarget\Transport as trans;
use MyTarget\Transport\Middleware as mid;
use MyTarget\Mapper\Mapper;
use MyTarget\Mapper\Type as t;

/**
 * Creates simple client, mostly used for testing.
 * It is better to use memory cache instead of file cache
 * in production.
 *
 * @param tok\ClientCredentials\Credentials $credentials
 * @param string $cacheDir
 * @param psr7\Uri $baseUri
 *
 * @return Client
 */
function simpleClient(tok\ClientCredentials\Credentials $credentials, $cacheDir, psr7\Uri $baseUri = null)
{
    $baseUri = $baseUri ?: new psr7\Uri("https://target.my.com");

    $requestFactory = new trans\RequestFactory($baseUri);
    $http = new trans\GuzzleHttpTransport(new GuzzleClient());

    $httpStack = mid\HttpMiddlewareStackPrototype::newEmpty($http);
    $httpStack->push(new mid\impl\ResponseValidatingMiddleware());

    $doctrineCache = new DoctrineFileCache($cacheDir);

    $rateLimitProvider = new lim\DoctrineCacheRateLimitProvider($doctrineCache);
    $httpStack->push(new lim\LimitingMiddleware($rateLimitProvider));

    $tokenAcquirer = new tok\TokenAcquirer($baseUri, $http, $credentials);
    $tokenStorage = new tok\DoctrineCacheTokenStorage($doctrineCache);
    $tokenManager = new tok\TokenManager($tokenAcquirer, $tokenStorage);
    $httpStack->push(new tok\ClientGrantMiddleware($tokenManager));

    return new Client($requestFactory, $httpStack);
}

/**
 * @param bool $debug
 * @return Mapper
 */
function simpleMapper($debug = false)
{
    $annotationReader = new CachedReader(new AnnotationReader(), new ArrayCache(), $debug);

    $mapper = new Mapper([
        "array" => new t\ArrayType(),
        "scalar" => new t\ScalarType(),
        "date" => new t\DateTimeType(),
        "enum" => new t\EnumType(),
        "object" => new t\ObjectType($annotationReader, new DoctrineInstantiator()),
        "mixed" => new t\MixedType()
    ]);

    return $mapper;
}

/**
 * @param \DateTime $date
 * @return string
 */
function stringFromDate(\DateTime $date)
{
    return $date->format("Y-m-d H:i:s");
}

/**
 * @param string $json
 * @return mixed
 * @throws DecodingException
 */
function json_decode($json)
{
    $decoded = @\json_decode($json, true);

    if ($decoded === null && null !== ($error = json_last_error_msg())) {
        throw new DecodingException($error);
    }

    return $decoded;
}
