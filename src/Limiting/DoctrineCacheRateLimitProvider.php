<?php

namespace Dsl\MyTarget\Limiting;

use Doctrine\Common\Cache\Cache;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class DoctrineCacheRateLimitProvider implements RateLimitProvider
{
    /**
     * @var Cache
     */
    private $cache;

    /**
     * @var LimitExtractor
     */
    private $limitExtractor;

    /**
     * @var callable callable($id, $username)
     */
    private $hashFunction;

    /**
     * @var callable callable(): \DateTimeInterface
     */
    private $momentGenerator;

    /**
     * DoctrineCacheRateLimitProvider constructor.
     *
     * @param Cache               $cache
     * @param LimitExtractor|null $limitExtractor
     * @param callable|null       $hashFunction callable(string $limitBy, RequestInterface, array $context)
     */
    public function __construct(Cache $cache, LimitExtractor $limitExtractor = null, callable $hashFunction = null)
    {
        $this->cache = $cache;
        $this->limitExtractor = $limitExtractor ?: new HeaderLimitExtractor();

        $this->hashFunction = $hashFunction ?: function($limitBy, RequestInterface $request, array $context) {
            $username = isset($context["username"]) ? $context["username"] : "";
            return sprintf("%s#%s", $limitBy, $username);
        };

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
    public function isLimitReached($limitBy, RequestInterface $request, array $context = null)
    {
        $id = call_user_func($this->hashFunction, $limitBy, $request, $context ?: []);
        $limitsArray = $this->cache->fetch($id);

        if ( ! is_array($limitsArray) || ! $limitsArray) {
            return false;
        }

        $limits = Limits::buildFromArray($limitsArray);
        if ( ! $limits) {
            return false;
        }

        $now = call_user_func($this->momentGenerator); /** @var \DateTimeInterface $now */
        $diff = $now->diff($limits->getMoment());

        if (( ! $diff->invert && $now != $limits->getMoment()) || $diff->days) {
            return false;
        }

        if (($limits->getBySecond() === 0 && $now->format("dHis") === $limits->getMoment()->format("dHis")) ||
            ($limits->getByMinute() === 0 && $now->format("dHi" ) === $limits->getMoment()->format("dHi" )) ||
            ($limits->getByHour()   === 0 && $now->format("dH"  ) === $limits->getMoment()->format("dH"  )) ||
            ($limits->getByDay()    === 0 && $now->format("d"   ) === $limits->getMoment()->format("d"   ))) {

            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function refreshLimits(RequestInterface $request, ResponseInterface $response, $limitBy, array $context = null)
    {
        $limits = $this->limitExtractor->extractLimits($response, call_user_func($this->momentGenerator));

        $id = call_user_func($this->hashFunction, $limitBy, $request, $context ?: []);

        $this->cache->save($id, $limits->toArray());
    }
}
