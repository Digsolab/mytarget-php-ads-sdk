<?php

namespace MyTarget\Transport;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Exception as guzzleEx;
use MyTarget\Transport\Exception as mtEx;

/**
 * An implementation of HttpTransport that uses Guzzle and depends on "guzzlehttp/guzzle" composer package
 */
class GuzzleHttpTransport implements HttpTransport
{
    /**
     * @var ClientInterface
     */
    private $guzzle;

    public function __construct(ClientInterface $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    /**
     * @inheritdoc
     */
    public function request(RequestInterface $request, array $context = null)
    {
        try {
            return $this->guzzle->send($request, ["http_errors" => false]);
        } catch (guzzleEx\GuzzleException $e) {
            throw new mtEx\HttpTransportException($e->getMessage(), $request, null, $e);
        }
    }
}
