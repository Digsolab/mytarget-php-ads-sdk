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

    /**
     * @var callable callable(): \DateTimeInterface
     */
    private $momentGenerator;

    public function __construct(Cache $cache, IdBuilder $idBuilder = null, LimitExtractor $limitExtractor = null)
    {
        $this->cache = $cache;
        $this->idBuilder = $idBuilder ?: new SimpleIdBuilder();
        $this->limitExtractor = $limitExtractor ?: new HeaderLimitExtractor();
        $this->momentGenerator = function () {
            return new \DateTimeImmutable();
        };
    }

    /**
     * @param callable $generator callable(): \DateTimeInterface
     */
    public function setMomentGenerator(callable $generator)
    {
        $this->momentGenerator = $generator;
    }

    /**
     * @inheritdoc
     */
    public function isLimitReached($limitBy, $username = null)
    {
        $id = $this->idBuilder->buildId($limitBy, $username);
        $limits = $this->cache->fetch($id);

        if ( ! $limits instanceof Limits || $limits->moment === null) {
            return false;
        }

        $now = call_user_func($this->momentGenerator); /** @var \DateTimeInterface $now */
        $diff = $now->diff($limits->moment);

        if (( ! $diff->invert && $now != $limits->moment) || $diff->days) {
            return false;
        }

        if (($limits->bySecond === 0 && $now->format("dHis") === $limits->moment->format("dHis")) ||
            ($limits->byMinute === 0 && $now->format("dHi" ) === $limits->moment->format("dHi" )) ||
            ($limits->byHour   === 0 && $now->format("dH"  ) === $limits->moment->format("dH"  )) ||
            ($limits->byDay    === 0 && $now->format("d"   ) === $limits->moment->format("d"   ))) {

            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function refreshLimits(ResponseInterface $response, $limitBy, $username = null)
    {
        $limits = $this->limitExtractor->extractLimits($response);
        $limits->moment = call_user_func($this->momentGenerator);

        $id = $this->idBuilder->buildId($limitBy, $username);

        $this->cache->save($id, $limits);
    }
}
