<?php

namespace Dsl\MyTarget;

use Dsl\MyTarget as f;
use Dsl\MyTarget\Exception\MyTargetException;
use GuzzleHttp\Psr7 as psr;
use Dsl\MyTarget\Transport\Middleware\HttpMiddlewareStackPrototype;
use Dsl\MyTarget\Transport\RequestFactory;
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

    public function __construct(RequestFactory $requestFactory, HttpMiddlewareStackPrototype $httpStack)
    {
        $this->requestFactory = $requestFactory;
        $this->http = $httpStack;
    }

    /**
     * Makes GET request and returns JSON-decoded response
     *
     * @param string $path
     * @param array|null $query
     * @param array|null $context Arbitrary context-table
     *
     * @return mixed
     * @throws MyTargetException
     */
    public function get($path, array $query = null, array $context = null)
    {
        $request = $this->requestFactory->create('GET', $path, $query);

        $response = $this->http->freeze()->request($request, $context);

        return f\json_decode((string) $response->getBody());
    }

    /**
     * Makes POST request and returns JSON-decoded response
     *
     * @param string $path
     * @param array|null $query
     * @param array|null $body
     * @param array|null $context
     *
     * @return mixed
     * @throws MyTargetException
     */
    public function post($path, array $query = null, $body = null, array $context = null)
    {
        $request = $this->requestFactory->create('POST', $path, $query);

        if ($body !== null) {
            /** @var RequestInterface $request */
            $request = $request->withBody(psr\stream_for(json_encode($body)));
        }

        $response = $this->http->freeze()->request($request, $context);

        return f\json_decode((string) $response->getBody());
    }

    /**
     * Makes DELETE request and returns JSON-decoded response
     *
     * @param string $path
     * @param array|null $query
     * @param array|null $context
     *
     * @return mixed
     * @throws MyTargetException
     */
    public function delete($path, array $query = null, array $context = null)
    {
        $request = $this->requestFactory->create("DELETE", $path, $query);

        $response = $this->http->freeze()->request($request, $context);

        return f\json_decode((string) $response->getBody());
    }

    /**
     * @param string $path
     * @param array $body
     * @param array|null $query
     * @param array|null $context
     *
     * @return mixed
     * @throws MyTargetException
     */
    public function postMultipart($path, array $body, array $query = null, array $context = null)
    {
        $request = $this->requestFactory->create("POST", $path, $query);
        $request = $request->withBody(new psr\MultipartStream($body));
        /** @var RequestInterface $request */

        $response = $this->http->freeze()->request($request, $context);

        return f\json_decode((string) $response->getBody());
    }
}
