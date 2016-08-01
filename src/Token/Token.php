<?php

namespace MyTarget\Token;

class Token
{
    /**
     * Token is considered expired even if it still has 30 minutes or less to live
     */
    const SAFE_TIME_BUFFER = "PT30M";

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $tokenType;

    /**
     * @var \DateTime
     */
    private $expiresAt;

    /**
     * @var string
     */
    private $refreshToken;

    /**
     * @param string $accessToken
     * @param string $tokenType
     * @param \DateTime $expiresAt
     * @param string $refreshToken
     */
    public function __construct($accessToken, $tokenType, \DateTime $expiresAt, $refreshToken)
    {
        $this->accessToken = $accessToken;
        $this->tokenType = $tokenType;
        $this->expiresAt = $expiresAt;
        $this->refreshToken = $refreshToken;
    }

    /**
     * @param array $token
     * @return Token|null
     */
    public static function fromArray(array $token)
    {
        if ( ! isset($token["access"], $token["type"], $token["refresh"], $token["expires_at"])) {
            return null;
        }

        $expiresAt = \DateTime::createFromFormat(\DateTime::ISO8601, $token["expires_at"]);
        if ($expiresAt === false) {
            return null;
        }

        return new Token($token["access"], $token["type"], $expiresAt, $token["refresh"]);
    }

    /**
     * @param array $token
     * @param \DateTimeInterface $now
     * @return Token|null
     */
    public static function fromResponse(array $token, \DateTimeInterface $now)
    {
        if ( ! isset($token["access_token"], $token["token_type"], $token["expires_in"], $token["refresh_token"])) {
            return null;
        }

        /** @var \DateTime|\DateTimeImmutable $now */
        $now = clone $now;
        $expiresAt = $now->add(new \DateInterval(sprintf("PT%dS", $token["expires_in"])));

        return new Token($token["access_token"], $token["token_type"], $expiresAt, $token["refresh_token"]);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            "access" => $this->accessToken,
            "type" => $this->tokenType,
            "refresh" => $this->refreshToken,
            "expires_at" => $this->expiresAt->format(\DateTime::ISO8601)
        ];
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @return string
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param \DateTime $moment
     *
     * @return bool
     */
    public function isExpiredAt(\DateTime $moment)
    {
        return $this->expiresAt->sub(new \DateInterval(self::SAFE_TIME_BUFFER)) < $moment;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @param Token $token
     *
     * @return bool
     */
    public function isEqual(Token $token)
    {
        return $this->accessToken === $token->accessToken;
    }
}
