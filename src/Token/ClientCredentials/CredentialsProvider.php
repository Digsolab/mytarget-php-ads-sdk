<?php

namespace Dsl\MyTarget\Token\ClientCredentials;

use Psr\Http\Message\RequestInterface;

interface CredentialsProvider
{
    /**
     * @param RequestInterface $request
     * @param array|null $context
     *
     * @return Credentials
     */
    public function getCredentials(RequestInterface $request, array $context = null);
}
