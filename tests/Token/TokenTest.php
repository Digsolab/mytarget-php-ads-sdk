<?php

namespace tests\Dsl\MyTarget\Token;

use Dsl\MyTarget\Token\Token;

class TokenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function constructDataProvider()
    {
        return [
            [null, null, new \DateTime(), null],
            [0, 1, new \DateTime(), 2],
            [[], new \stdClass(), new \DateTime(), 'foo']
        ];
    }

    /**
     * @param mixed     $access
     * @param mixed     $type
     * @param \DateTime $expiresAt
     * @param mixed     $refresh
     *
     * @dataProvider constructDataProvider
     */
    public function testConstruct($access, $type, \DateTime $expiresAt, $refresh)
    {
        $token = new Token($access, $type, $expiresAt, $refresh);

        $this->assertSame($access, $token->getAccessToken());
        $this->assertSame($type, $token->getTokenType());
        $this->assertSame($expiresAt, $token->getExpiresAt());
        $this->assertSame($refresh, $token->getRefreshToken());
    }

    /**
     * @return array
     */
    public function fromArrayDataProvider()
    {
        return [
            [[], null],
            [['access' => 'bar'], null],
            [['type' => 'foo'], null],
            [['refresh' => 'zzz'], null],
            [['expires_at' => 'rrr'], null],
            [['access' => '132', 'type' => 100, 'refresh' => 'abc', 'expires_at' => null], null],
            [['access' => '132', 'type' => 100, 'refresh' => 'abc', 'expires_at' => '2016-01-01T00:00:00+0000'], Token::class],
        ];
    }

    /**
     * @param array $array
     * @param mixed $class
     *
     * @dataProvider fromArrayDataProvider
     */
    public function testFromArray($array, $class)
    {
        $token = Token::fromArray($array);

        $this->assertSame($class, $token ? get_class($token) : $token);

        if ($token) {
            $this->assertSame($array['access'], $token->getAccessToken());
            $this->assertSame($array['type'], $token->getTokenType());
            $this->assertSame($array['expires_at'], $token->getExpiresAt()->format(\DateTime::ISO8601));
            $this->assertSame($array['refresh'], $token->getRefreshToken());
        }
    }

    /**
     * @return array
     */
    public function fromResponseDataProvider()
    {
        return [
            [[], null],
            [['access_token' => 'bar'], null],
            [['token_type' => 'foo'], null],
            [['refresh_token' => 'zzz'], null],
            [['expires_in' => 'rrr'], null],
            [['access_token' => '132', 'token_type' => 100, 'refresh_token' => 'abc', 'expires_in' => 6000], Token::class],
        ];
    }

    /**
     * @param array $array
     * @param mixed $class
     *
     * @dataProvider fromResponseDataProvider
     */
    public function testFromResponse($array, $class)
    {
        $now = new \DateTime();

        $token = Token::fromResponse($array, $now);

        $this->assertSame($class, $token ? get_class($token) : $token);

        if ($token) {
            $this->assertSame($array['access_token'], $token->getAccessToken());
            $this->assertSame($array['token_type'], $token->getTokenType());
            $this->assertSame(
                $now->add(new \DateInterval(sprintf('PT%dS', $array['expires_in'])))->format(\DateTime::ISO8601),
                $token->getExpiresAt()->format(\DateTime::ISO8601)
            );
            $this->assertSame($array['refresh_token'], $token->getRefreshToken());
        }
    }

    public function testToArray()
    {
        $now = new \DateTime();
        $token = new Token('access', 'type', $now, 'refresh');

        $this->assertSame(
            [
                'access' => 'access',
                'type' => 'type',
                'refresh' => 'refresh',
                'expires_at' => $now->format(\DateTime::ISO8601),
            ],
            $token->toArray()
        );
    }

    /**
     * @return array
     */
    public function isExpiredAtDataProvider()
    {
        $now = new \DateTimeImmutable('2016-01-01 00:00:00');

        return [
            [$now->sub(new \DateInterval('P1D')), true],
            [$now, true],
            [$now->add(new \DateInterval('PT29M')), true],
            [$now->add(new \DateInterval('PT30M')), false],
        ];
    }

    /**
     * @param \DateTimeInterface $expiresAt
     * @param           $expect
     *
     * @dataProvider isExpiredAtDataProvider
     */
    public function testIsExpiredAt(\DateTimeInterface $expiresAt, $expect)
    {
        $token = new Token('', '', $expiresAt, '');

        $this->assertSame($expect, $token->isExpiredAt(new \DateTimeImmutable('2016-01-01 00:00:00')));
    }

}
