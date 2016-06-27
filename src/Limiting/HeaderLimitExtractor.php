<?php

namespace MyTarget\Limiting;

use Psr\Http\Message\ResponseInterface;

class HeaderLimitExtractor implements LimitExtractor
{
    private $limitHeaders = [
        'X-RateLimit-RPS-Limit',
        'X-RateLimit-RPS-Remaining',
        'X-RateLimit-Minutely-Limit',
        'X-RateLimit-Minutely-Remaining',
        'X-RateLimit-Hourly-Limit',
        'X-RateLimit-Hourly-Remaining',
        'X-RateLimit-Daily-Limit',
        'X-RateLimit-Daily-Remaining'
    ];

    /**
     * @inheritdoc
     */
    public function extractLimits(ResponseInterface $response)
    {
        $limits = [];

        foreach ($this->limitHeaders as $limitHeader) {
            if ($response->hasHeader($limitHeader)) {
                $limits[$limitHeader] = (int)$response->getHeader($limitHeader);
            }
        }

        return $limits;
    }
}
