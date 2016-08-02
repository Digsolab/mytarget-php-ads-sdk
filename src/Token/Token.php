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
     * @var \DateTime|null
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
        if (
            ! isset($token["access_token"], $token["token_type"], $token["expires_in"])
            || !array_key_exists("refresh_token", $token)
        ) {
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
     * @param \DateTime $now
     * @return Token|null
     */
    public static function fromResponse(array $token, \DateTime $now)
    {
        if (
            ! isset($token["access_token"], $token["token_type"], $token["expires_in"])
            || !array_key_exists("refresh_token", $token)
        ) {
            return null;
        }

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
            "expires_at" => (null === $this->expiresAt) ?: $this->expiresAt->format(\DateTime::ISO8601)
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
     * @return \DateTime|null
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
        if (null === $this->expiresAt) {
            return false;
        }

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
     * It makes the the token invalid by deleting its TTL
     *
     * @return void
     */
    public function invalidate()
    {
        $this->expiresAt = null;
    }
}
