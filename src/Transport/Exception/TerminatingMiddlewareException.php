<?php

namespace MyTarget\Transport\Exception;

use MyTarget\Exception\MyTargetException;
use Psr\Http\Message\RequestInterface;

class TerminatingMiddlewareException extends \RuntimeException
    implements MyTargetException
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        parent::__construct("No middleware could process the request (stack is empty)");

        $this->request = $request;
    }
}
