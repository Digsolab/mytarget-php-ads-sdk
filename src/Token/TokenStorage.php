<?php

namespace Dsl\MyTarget\Token;

use Psr\Http\Message\RequestInterface;

interface TokenStorage
{
    /**
     * @param string $id
     * @param RequestInterface $request
     * @param array|null $context
     *
     * @return Token
     */
    public function getToken($id,  RequestInterface $request, array $context = null);

    /**
     * @param string $id
     * @param Token $token
     * @param RequestInterface $request
     * @param array|null $context
     */
    public function updateToken($id, Token $token, RequestInterface $request, array $context = null);
}
