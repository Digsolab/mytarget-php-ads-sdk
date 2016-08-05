<?php

namespace MyTarget\Token;

use GuzzleHttp\Psr7\Uri;
use MyTarget\Token\ClientCredentials\Credentials;
use MyTarget\Token\ClientCredentials\CredentialsProvider;
use MyTarget\Token\Exception\TokenDeletedException;
use MyTarget\Token\Exception\TokenLimitReachedException;
use MyTarget\Token\Exception\TokenRequestException;
use MyTarget\Transport\HttpTransport;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use GuzzleHttp\Psr7;

class TokenAcquirerTest extends \PHPUnit_Framework_TestCase
{
    /** @var  UriInterface */
    private $baseAddress;
    /** @var  HttpTransport|\PHPUnit_Framework_MockObject_MockObject */
    private $http;
    /** @var  CredentialsProvider */
    private $credentials;

    /** @var  TokenAcquirer */
    private $acquirer;

    /** @var  RequestInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $request;
    /** @var  ResponseInterface|\PHPUnit_Framework_MockObject_MockObject */
    private $response;

    public function setUp()
    {
        parent::setUp();

        $this->baseAddress = new Uri('http://socialkey.ru/');
        $this->http = $this->getMock(HttpTransport::class);
        $this->credentials = new Credentials('id-132', 'secret-t-t-t');

        $this->acquirer = new TokenAcquirer($this->baseAddress, $this->http, $this->credentials);

        $this->request = $this->getMock(RequestInterface::class);
        $this->response = $this->getMock(ResponseInterface::class);
    }

    /**
     * @return array
     */
    public function acquireDataProvider()
    {
        return [
            [null, [], 200, '{"access_token": "secret", "token_type": "super type", "expires_in": 100, "refresh_token": "refresh secret"}', null],
            ['user@agency', ['test' => 123], 200, '{"access_token": "secret", "token_type": "super type", "expires_in": 100, "refresh_token": "refresh secret"}', null],
            ['user@agency', ['test' => 123], 200, '', TokenRequestException::class],
            ['user@agency', ['test' => 123], 200, '{}', TokenRequestException::class],
            ['user@agency', ['test' => 123], 200, '{"access_token": "secret"}', TokenRequestException::class],
            [null, null, 403, '', TokenRequestException::class],
            [null, null, 403, 'limit reached', TokenLimitReachedException::class],
            [null, null, -1, '', TokenRequestException::class],
        ];
    }

    /**
     * @param string|null $username
     * @param array|null  $context
     * @param int         $statusCode
     * @param string      $body
     * @param string      $exception
     *
     * @dataProvider acquireDataProvider
     */
    public function testAcquire($username, $context, $statusCode, $body, $exception)
    {
        $now = new \DateTime();

        if ($exception) {
            $this->setExpectedException($exception);
        }

        $payload = [
            'grant_type'    => $username === null ? 'client_credentials' : 'agency_client_credentials',
            'client_id'     => $this->credentials->getCredentials($this->request, $context)->getClientId(),
            'client_secret' => $this->credentials->getCredentials($this->request, $context)->getClientSecret(),
        ];
        if ($username) {
            $payload['agency_client_name'] = $username;
        }

        $this->response->method('getBody')->willReturn(Psr7\stream_for($body));

        $this->response->method('getStatusCode')->willReturn($statusCode);

        $this->http->method('request')->will(
            $this->returnCallback(function (RequestInterface $request) use ($payload) {
                $this->assertSame('POST', $request->getMethod());
                $this->assertSame(['Host' => ['socialkey.ru'], 'Content-Type' => ['application/x-www-form-urlencoded']], $request->getHeaders());
                $this->assertEquals($this->baseAddress->withPath(TokenAcquirer::TOKEN_URL), $request->getUri());
                $this->assertSame(Psr7\build_query($payload), $request->getBody()->getContents());

                return $this->response;
            })
        );

        $token = $this->acquirer->acquire($this->request, $now, $username, $context);

        $this->assertSame(Token::class, get_class($token));

        $this->assertSame('secret', $token->getAccessToken());
        $this->assertSame('super type', $token->getTokenType());
        $this->assertSame('refresh secret', $token->getRefreshToken());
        $this->assertSame($now->add(new \DateInterval('PT100S'))->format(\DateTime::ISO8601), $token->getExpiresAt()->format(\DateTime::ISO8601));
    }

    /**
     * @return array
     */
    public function refreshDataProvider()
    {
        return [
            [[], 200, '{"access_token": "secret", "token_type": "super type", "expires_in": 100, "refresh_token": "refresh secret"}', null],
            [['test' => 123], 200, '{"access_token": "secret", "token_type": "super type", "expires_in": 100, "refresh_token": "refresh secret"}', null],
            [['test' => 123], 200, '', TokenRequestException::class],
            [['test' => 123], 200, '{}', TokenRequestException::class],
            [['test' => 123], 200, '{"access_token": "secret"}', TokenRequestException::class],
            [null, 401, '', TokenRequestException::class],
            [null, 401, 'deleted', TokenDeletedException::class],
            [null, -1, '', TokenRequestException::class],
        ];
    }

    /**
     * @param $context
     * @param $statusCode
     * @param $body
     * @param $exception
     *
     * @dataProvider refreshDataProvider
     */
    public function testRefresh($context, $statusCode, $body, $exception)
    {
        $now = new \DateTime();

        if ($exception) {
            $this->setExpectedException($exception);
        }

        $payload = [
            'grant_type'    => 'refresh_token',
            'refresh_token' => 'refresh secret lol',
            'client_id'     => $this->credentials->getCredentials($this->request, $context)->getClientId(),
            'client_secret' => $this->credentials->getCredentials($this->request, $context)->getClientSecret()
        ];

        $this->response->method('getBody')->willReturn(Psr7\stream_for($body));

        $this->response->method('getStatusCode')->willReturn($statusCode);

        $this->http->method('request')->will(
            $this->returnCallback(function (RequestInterface $request) use ($payload) {
                $this->assertSame('POST', $request->getMethod());
                $this->assertSame(['Host' => ['socialkey.ru'], 'Content-Type' => ['application/x-www-form-urlencoded']], $request->getHeaders());
                $this->assertEquals($this->baseAddress->withPath(TokenAcquirer::TOKEN_URL), $request->getUri());
                $this->assertSame(Psr7\build_query($payload), $request->getBody()->getContents());

                return $this->response;
            })
        );

        $token = $this->acquirer->refresh($this->request, $now, 'refresh secret lol', $context);

        $this->assertSame(Token::class, get_class($token));

        $this->assertSame('secret', $token->getAccessToken());
        $this->assertSame('super type', $token->getTokenType());
        $this->assertSame('refresh secret', $token->getRefreshToken());
        $this->assertSame($now->add(new \DateInterval('PT100S'))->format(\DateTime::ISO8601), $token->getExpiresAt()->format(\DateTime::ISO8601));
    }

}
