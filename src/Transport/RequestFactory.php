<?php

namespace MyTarget\Transport;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class RequestFactory
{
    /**
     * @var UriInterface
     */
    private $baseAddress;

    public function __construct(UriInterface $baseAddress)
    {
        $this->baseAddress = $baseAddress;
    }

    /**
     * @param string $method
     * @param string $path
     * @param array|null $query
     *
     * @return RequestInterface
     */
    public function create($method, $path, array $query = null)
    {
        $uri = $this->baseAddress->withPath($path);

        if ($query) {
            $uri = $uri->withQuery(http_build_query($query));
        }

        $request = new Request($method, $uri, ['Accept-Encoding' => 'gzip, deflate, compress']);

        return $request;
    }
}
