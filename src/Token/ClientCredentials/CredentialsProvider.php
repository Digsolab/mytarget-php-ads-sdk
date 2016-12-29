<?php

namespace Dsl\MyTarget\Token\ClientCredentials;

use Dsl\MyTarget\Context;
use Psr\Http\Message\RequestInterface;

interface CredentialsProvider
{
    /**
     * @param RequestInterface $request
     * @param Context|null $context
     *
     * @return Credentials
     */
    public function getCredentials(RequestInterface $request, Context $context = null);
}
