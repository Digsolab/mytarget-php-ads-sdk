<?php

namespace MyTarget\Limiting;

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
        if (null === $limits->moment) {
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
    public function refreshLimits(RequestInterface $request, ResponseInterface $response, $limitBy, array $context = null)
    {
        $limits = $this->limitExtractor->extractLimits($response);
        $limits->moment = call_user_func($this->momentGenerator);

        $id = call_user_func($this->hashFunction, $limitBy, $request, $context ?: []);

        $this->cache->save($id, $limits->toArray());
    }
}
