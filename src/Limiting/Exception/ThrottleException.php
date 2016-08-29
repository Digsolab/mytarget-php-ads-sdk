<?php

namespace Dsl\MyTarget\Limiting\Exception;

use Dsl\MyTarget\Transport\Exception\RequestException;
use Dsl\MyTarget\Exception\ApiException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ThrottleException extends RequestException
    implements ApiException
{
    /**
     * @var int Number of seconds we need to wait until we can make a request again
     */
    public $timeout;

    /**
     * @param int|null $timeout
     * @param string $message
     * @param RequestInterface $request
     * @param ResponseInterface|null $response
     * @param \Exception|null $previous
     */
    public function __construct($timeout, $message, RequestInterface $request, ResponseInterface $response = null, \Exception $previous = null)
    {
        parent::__construct($message, $request, $response, $previous);

        $this->timeout = $timeout;
    }
}
