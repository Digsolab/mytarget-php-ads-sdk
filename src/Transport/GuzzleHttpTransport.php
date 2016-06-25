<?php

namespace MyTarget\Transport;

use GuzzleHttp\ClientInterface as Client;
use Psr\Http\Message\RequestInterface;

class GuzzleHttpTransport implements HttpTransport
{
    /**
     * @var Client
     */
    private $guzzle;

    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    /**
     * TODO convert guzzle exceptions to our own domain
     *
     * @inheritdoc
     */
    public function request(RequestInterface $request, array $context = null)
    {
        return $this->guzzle->send($request, ["http_errors" => false]);
    }
}
