<?php

namespace Dsl\MyTarget\Limiting;

use Psr\Http\Message\ResponseInterface;

class HeaderLimitExtractor implements LimitExtractor
{
    /**
     * @inheritdoc
     */
    public function extractLimits(ResponseInterface $response, callable $momentGenerator = null)
    {
        $moment = $bySecond = $byMinute = $byHour = $byDay = null;

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

        if ($momentGenerator) {
            $moment = call_user_func($momentGenerator);
        }

        $limits = new Limits($moment, $bySecond, $byMinute, $byHour, $byDay);

        return $limits;
    }
}
