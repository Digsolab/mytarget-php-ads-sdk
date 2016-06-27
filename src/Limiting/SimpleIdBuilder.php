<?php

namespace MyTarget\Limiting;

use Psr\Http\Message\RequestInterface;

class SimpleIdBuilder implements IdBuilder
{
    /**
     * @inheritdoc
     */
    public function buildId(RequestInterface $request, $username = null)
    {
        $uriPath = $request->getUri()->getPath();
        $method = $request->getMethod();

        $path = preg_replace('/(\/\d+\/)/u', '/PARAM/', $uriPath);
        $path = preg_replace('/(\/\d+.json)/u', '/PARAM.json', $path);

        $id = (string)$username . '#' . $method . ':' . $path;

        return $id;
    }
}
