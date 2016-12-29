<?php

namespace Dsl\MyTarget\Token\ClientCredentials;

use Dsl\MyTarget\Context;
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
     * @param Context|null $context
     *
     * @return $this
     */
    public function getCredentials(RequestInterface $request, Context $context = null)
    {
        return $this;
    }
}
