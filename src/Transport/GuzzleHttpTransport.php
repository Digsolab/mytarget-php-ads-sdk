<?php

namespace MyTarget\Transport;

use GuzzleHttp\ClientInterface as Client;
use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Exception as guzzleEx;
use MyTarget\Transport\Exception as mtEx;

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
     * @inheritdoc
     */
    public function request(RequestInterface $request, array $context = null)
    {
        try {
            return $this->guzzle->send($request, ["http_errors" => false]);
        } catch (guzzleEx\ConnectException $e) {
            throw new mtEx\NetworkException($e->getMessage(), $request, null, $e);
        } catch (guzzleEx\TooManyRedirectsException $e) {
            throw new mtEx\NetworkException($e->getMessage(), $request, null, $e);
        } catch (guzzleEx\RequestException $e) {
            throw new mtEx\RequestException($e->getMessage(), $request, null, $e);
        }
    }
}
