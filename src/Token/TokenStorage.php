<?php

namespace Dsl\MyTarget\Token;

use Dsl\MyTarget\Context;
use Psr\Http\Message\RequestInterface;

interface TokenStorage
{
    /**
     * @param string $id
     * @param RequestInterface $request
     * @param Context $context
     *
     * @return Token
     */
    public function getToken($id,  RequestInterface $request, Context $context);

    /**
     * @param string $id
     * @param Token $token
     * @param RequestInterface $request
     * @param Context $context
     */
    public function updateToken($id, Token $token, RequestInterface $request, Context $context);
}
