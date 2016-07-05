<?php

namespace MyTarget\Limiting;

use Doctrine\Common\Cache\Cache;
use Psr\Http\Message\ResponseInterface;

class DoctrineCacheRateLimitProvider implements RateLimitProvider
{
    /**
     * @var Cache
     */
    private $cache;

    /**
     * @var IdBuilder
     */
    private $idBuilder;

    /**
     * @var LimitExtractor
     */
    private $limitExtractor;

    public function __construct(Cache $cache, IdBuilder $idBuilder = null, LimitExtractor $limitExtractor = null)
    {
        $this->cache = $cache;
        $this->idBuilder = $idBuilder ?: new SimpleIdBuilder();
        $this->limitExtractor = $limitExtractor ?: new HeaderLimitExtractor();
    }

    /**
     * @inheritdoc
     */
    public function isLimitReached($limitBy, $username = null)
    {
        $id = $this->idBuilder->buildId($limitBy, $username);
        $limits = $this->cache->fetch($id);

        if (false === $limits) {
            return false;
        }

        foreach ($limits as $type => $limit) {
            if (0 === $limit) {
                return true;
            }
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function refreshLimits(ResponseInterface $response, $limitBy, $username = null)
    {
        $id = $this->idBuilder->buildId($limitBy, $username);
        $limits = $this->limitExtractor->extractLimits($response);
        $this->cache->save($id, $limits);
    }
}
