<?php

namespace Dsl\MyTarget\Transport\Exception;

use Dsl\MyTarget\Exception\MyTargetException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RequestException extends \RuntimeException
    implements MyTargetException
{

    /**
     * @var RequestInterface
     */
    public $request;

    /**
     * @var ResponseInterface
     */
    public $response;

    /**
     * @param string $message
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param \Exception $previous
     */
    public function __construct($message, RequestInterface $request, ResponseInterface $response = null, \Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);

        $this->request = $request;
        $this->response = $response;
    }
}
