<?php

namespace Dsl\MyTarget\Limiting;

use Psr\Http\Message\ResponseInterface;

class HeaderLimitExtractor implements LimitExtractor
{
    /**
     * @inheritdoc
     */
    public function extractLimits(ResponseInterface $response)
    {
        $limits = new Limits();

        if ($header = $response->getHeader('X-RateLimit-RPS-Remaining')) {
            $limits->bySecond = (int) $header[0];
        }

        if ($header = $response->getHeader('X-RateLimit-Minutely-Remaining')) {
            $limits->byMinute = (int) $header[0];
        }

        if ($header = $response->getHeader('X-RateLimit-Hourly-Remaining')) {
            $limits->byHour = (int) $header[0];
        }

        if ($header = $response->getHeader('X-RateLimit-Daily-Remaining')) {
            $limits->byDay = (int) $header[0];
        }

        return $limits;
    }
}
