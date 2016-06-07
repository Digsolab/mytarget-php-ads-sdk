<?php

namespace MyTarget\Token\ClientCredentials;

use Psr\Http\Message\RequestInterface;

interface CredentialsProvider
{
    /**
     * @param RequestInterface $request
     * @param mixed|null $context
     *
     * @return Credentials
     */
    public function getCredentials(RequestInterface $request, $context = null);
}
