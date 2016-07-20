<?php

namespace MyTarget\Transport\Middleware\Impl;

use MyTarget\Transport\Middleware\HttpMiddleware;
use MyTarget\Transport\Middleware\HttpMiddlewareStack;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerInterface;

class RequestResponseLoggerMiddleware implements HttpMiddleware
{

    /** @var LoggerInterface */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function request(RequestInterface $request, HttpMiddlewareStack $stack, array $context = null)
    {
        $this->logger->info(
            sprintf(
                "MyTarget request:\nProtocol: %s\nMethod: %s\nURI: %s\nHeaders:\n%s\nBody: %s",
                $request->getProtocolVersion(),
                $request->getMethod(),
                $request->getUri(),
                $this->getHeadersAsString($request),
                $request->getBody()->getContents()
            ),
            $context
        );

        $response = $stack->request($request, $context);

        $this->logger->info(
            sprintf(
                "MyTarget response:\nProtocol: %s\nCode: %s\nHeaders:\n%s\nBody: %s",
                $response->getProtocolVersion(),
                $response->getStatusCode(),
                $this->getHeadersAsString($response),
                $response->getBody()->getContents()
            ),
            $context
        );

        return $response;
    }

    /**
     * @param MessageInterface $message
     *
     * @return string
     */
    private function getHeadersAsString(MessageInterface $message)
    {
        $headers = '';
        foreach ($message->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                $headers .= sprintf("%s: %s\n", $name, $value);
            }
        }

        return rtrim($headers);
    }

}
