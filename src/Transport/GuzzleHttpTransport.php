<?php

namespace Dsl\MyTarget\Transport;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Exception as guzzleEx;
use Dsl\MyTarget\Transport\Exception as mtEx;

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
            if ($e instanceof guzzleEx\RequestException) {
                $response = $e->getResponse();
            } else {
                $response = null;
            }

            throw new mtEx\NetworkException($e->getMessage(), $request, $response, $e);
        }
    }
}
