<?php

namespace Dsl\MyTarget\Limiting;

use Psr\Http\Message\ResponseInterface;

class HeaderLimitExtractor implements LimitExtractor
{
    /**
     * @inheritdoc
     */
    public function extractLimits(ResponseInterface $response, \DateTimeInterface $moment)
    {
        $bySecond = $byMinute = $byHour = $byDay = null;

        if ($header = $response->getHeader('X-RateLimit-RPS-Remaining')) {
            $bySecond = (int) $header[0];
        }

        if ($header = $response->getHeader('X-RateLimit-Minutely-Remaining')) {
            $byMinute = (int) $header[0];
        }

        if ($header = $response->getHeader('X-RateLimit-Hourly-Remaining')) {
            $byHour = (int) $header[0];
        }

        if ($header = $response->getHeader('X-RateLimit-Daily-Remaining')) {
            $byDay = (int) $header[0];
        }

        $limits = new Limits($moment, $bySecond, $byMinute, $byHour, $byDay);

        return $limits;
    }
}
