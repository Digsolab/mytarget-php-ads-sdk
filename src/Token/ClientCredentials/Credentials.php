<?php

namespace MyTarget\Token\ClientCredentials;

use Psr\Http\Message\RequestInterface;

class Credentials implements CredentialsProvider
{
    /**
     * @var int
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @param int $clientId
     * @param string $clientSecret
     */
    public function __construct($clientId, $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param RequestInterface $request
     * @param mixed|null $context
     *
     * @return $this
     */
    public function getCredentials(RequestInterface $request, $context = null)
    {
        return $this;
    }
}
