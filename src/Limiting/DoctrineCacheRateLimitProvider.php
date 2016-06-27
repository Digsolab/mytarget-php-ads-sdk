<?php

namespace MyTarget\Limiting;

use MyTarget\Limiting\Exception\ThrottleException;
use Doctrine\Common\Cache\Cache;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class DoctrineCacheRateLimitProvider implements RateLimitProvider
{
    private $cache;
    private $idBuilder;
    private $limitExtractor;

    public function __construct(Cache $cache, IdBuilder $idBuilder = null, LimitExtractor $limitExtractor = null)
    {
        $this->cache = $cache;
        $this->idBuilder = (null !== $idBuilder) ? $idBuilder : new SimpleIdBuilder();
        $this->limitExtractor = (null !== $limitExtractor) ? $limitExtractor : new HeaderLimitExtractor();
    }

    /**
     * @inheritdoc
     */
    public function throttleIfNeeded(RequestInterface $request, $username = null)
    {
        $id = $this->idBuilder->buildId($request, $username);
        $limits = $this->cache->fetch($id);

        if (false === $limits) {
            return;
        }

        foreach ($limits as $type => $limit) {
            if (0 === $limit) {
                throw new ThrottleException();
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function updateLimits(RequestInterface $request, ResponseInterface $response, $username = null)
    {
        $id = $this->idBuilder->buildId($request, $username);
        $limits = $this->limitExtractor->extractLimits($response);
        $this->cache->save($id, $limits);
    }
}
