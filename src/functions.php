<?php

namespace MyTarget;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache as DoctrineCache;
use Doctrine\Instantiator\Instantiator as DoctrineInstantiator;
use GuzzleHttp\Psr7 as psr7;
use GuzzleHttp\Client as GuzzleClient;

use MyTarget\Exception\DecodingException;
use MyTarget\Operator\Exception\UnexpectedFileArgumentException;
use MyTarget\Token\ClientCredentials\CredentialsProvider;
use MyTarget\Limiting as lim;
use MyTarget\Token as tok;
use MyTarget\Transport as trans;
use MyTarget\Transport\Middleware as mid;
use MyTarget\Mapper\Mapper;
use MyTarget\Mapper\Type as t;
use Psr\Http\Message\StreamInterface;
use Psr\Log\LoggerInterface;

/**
 * Creates simple client, mostly used for testing.
 * It is better to use memory cache instead of file cache
 * in production.
 *
 * @param CredentialsProvider $credentials
 * @param string $cacheDir
 * @param tok\TokenStorage $tokenStorage
 * @param psr7\Uri $baseUri
 * @param LoggerInterface $logger
 *
 * @return Client
 */
function simpleClient(CredentialsProvider $credentials, $cacheDir, tok\TokenStorage $tokenStorage, psr7\Uri $baseUri = null, LoggerInterface $logger)
{
    $baseUri = $baseUri ?: new psr7\Uri("https://target.my.com");

    $requestFactory = new trans\RequestFactory($baseUri);
    $http = new trans\GuzzleHttpTransport(new GuzzleClient());

    $httpStack = mid\HttpMiddlewareStackPrototype::newEmpty($http);
    $httpStack->push(new mid\Impl\RequestResponseLoggerMiddleware($logger));
    $httpStack->push(new mid\Impl\ResponseValidatingMiddleware());

    $doctrineCache = new DoctrineCache\ChainCache([
        new DoctrineCache\ArrayCache(),
        new DoctrineCache\FilesystemCache($cacheDir)]);

    $rateLimitProvider = new lim\DoctrineCacheRateLimitProvider($doctrineCache);
    $httpStack->push(new lim\LimitingMiddleware($rateLimitProvider));

    $tokenAcquirer = new tok\TokenAcquirer($baseUri, $http, $credentials);
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
    $annotationReader = new CachedReader(new AnnotationReader(), new DoctrineCache\ArrayCache(), $debug);

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
 * @param string $json
 * @return mixed
 * @throws DecodingException
 */
function json_decode($json)
{
    if ($json === "") {
        return null;
    }

    $decoded = @\json_decode($json, true);

    if ($decoded === null && null !== ($error = json_last_error_msg())) {
        throw new DecodingException($error);
    }

    return $decoded;
}

/**
 * @param resource|string|StreamInterface $file
 * @return resource|StreamInterface
 */
function streamOrResource($file)
{
    if (is_string($file)) { // assume it's a file path
        $file = fopen($file, 'r');
    }
    if ( ! $file instanceof StreamInterface && ! is_resource($file)) {
        throw new UnexpectedFileArgumentException($file);
    }

    return $file;
}
