<?php

namespace Dsl\MyTarget\Operator\V2;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Context;
use Dsl\MyTarget\Domain\V2\Token;
use Dsl\MyTarget\Mapper\Mapper;
use Dsl\MyTarget\Token\ClientCredentials\Credentials;

class TokenOperator
{
    const TOKEN_URL = '/api/v2/oauth2/token.json';

    const GRANT_TYPE_AGENCY  = 'agency_client_credentials';
    const GRANT_TYPE_CLIENT  = 'client_credentials';
    const GRANT_TYPE_REFRESH = 'refresh_token';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Mapper
     */
    private $mapper;

    public function __construct(Client $client, Mapper $mapper)
    {
        $this->client = $client;
        $this->mapper = $mapper;
    }

    /**
     * @param Credentials $credentials
     * @param Context|null $context
     *
     * @return Token
     */
    public function acquire(Credentials $credentials, Context $context = null)
    {
        $username = $context->hasUsername() ? $context->getUsername() : null;

        $payload = [
            'grant_type'    => $username ? self::GRANT_TYPE_CLIENT : self::GRANT_TYPE_AGENCY,
            'client_id'     => $credentials->getClientId(),
            'client_secret' => $credentials->getClientSecret()
        ];

        if ($username) {
            $payload['agency_client_name'] = $username;
        }

        $json = $this->client->postMultipart(self::TOKEN_URL, $payload, null, $context);

        return $this->mapper->hydrateNew(Token::class, $json);
    }

    /**
     * @param Credentials $credentials
     * @param Token       $token
     * @param Context|null $context
     *
     * @return Token
     */
    public function refresh(Credentials $credentials, Token $token, Context $context = null)
    {
        $payload = [
            'grant_type'    => self::GRANT_TYPE_REFRESH,
            'refresh_token' => $token->getRefresh(),
            'client_id'     => $credentials->getClientId(),
            'client_secret' => $credentials->getClientSecret()
        ];

        $json = $this->client->postMultipart(self::TOKEN_URL, $payload, null, $context);

        return $this->mapper->hydrateNew(Token::class, $json);
    }
}
