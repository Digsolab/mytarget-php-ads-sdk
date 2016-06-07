<?php

namespace MyTarget;

use MyTarget as f;
use MyTarget\Exception\MyTargetException;
use GuzzleHttp\Psr7 as psr;
use MyTarget\Transport\Middleware\HttpMiddlewareStackPrototype;
use MyTarget\Transport\RequestFactory;
use Psr\Http\Message\RequestInterface;

class Client
{
    /**
     * @var RequestFactory
     */
    private $requestFactory;

    /**
     * @var HttpMiddlewareStackPrototype
     */
    private $http;

    public function __construct(RequestFactory $requestFactory, HttpMiddlewareStackPrototype $http)
    {
        $this->requestFactory = $requestFactory;
        $this->http = $http;
    }

    /**
     * @param string $path
     * @param array|null $query
     * @param string|null $username
     * @param mixed|null $context
     *
     * @return mixed
     * @throws MyTargetException
     */
    public function get($path, array $query = null, $username = null, $context = null)
    {
        $request = $this->requestFactory->create('GET', $path, $query);

        $response = $this->http->freeze()->request($request, $username, $context);

        return f\json_decode((string)$response->getBody());
    }

    /**
     * @param string $path
     * @param array|null $query
     * @param array|null $body
     * @param string|null $username
     * @param mixed|null $context
     *
     * @return mixed
     * @throws MyTargetException
     */
    public function post($path, array $query = null, array $body = null, $username = null, $context = null)
    {
        $request = $this->requestFactory->create('POST', $path, $query);

        if ($body !== null) {
            /** @var RequestInterface $request */
            $request = $request->withBody(psr\stream_for(json_encode($body)));
        }

        $response = $this->http->freeze()->request($request, $username, $context);

        return f\json_decode((string)$response->getBody());
    }
}
