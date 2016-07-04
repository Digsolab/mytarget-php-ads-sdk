<?php

namespace MyTarget\Token;

use Psr\Http\Message\RequestInterface;

interface TokenStorage
{
    /**
     * @param RequestInterface $request
     * @param array|null $context
     *
     * @return Token
     */
    public function getToken(RequestInterface $request, array $context = null);

    /**
     * @param Token $token
     * @param RequestInterface $request
     * @param array|null $context
     */
    public function updateToken(Token $token, RequestInterface $request, array $context = null);

    /**
     * @param string $username
     * @param RequestInterface $request
     * @param array|null $context
     *
     * @return Token
     */
    public function getClientToken($username, RequestInterface $request, array $context = null);

    /**
     * @param string $username
     * @param Token $token
     * @param RequestInterface $request
     * @param array|null $context
     */
    public function updateClientToken($username, Token $token, RequestInterface $request, array $context = null);
}
