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
    public function rateLimitTimeout($limitBy, RequestInterface $request, array $context = null)
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

        $now = call_user_func($this->momentGenerator); /** @var \DateTimeImmutable $now */
        $moment = $limits->getMoment();
        $diff = $now->diff($limits->getMoment());

        if (( ! $diff->invert && $now != $limits->getMoment()) || $diff->days) {
            return false;
        }

        $delay = null;
        if ($limits->getByDay() === 0 && $now->format("d") === $moment->format("d")) {
            $nextDay = $now->modify("next day 00:00");
            $delay = $nextDay->getTimestamp() - $now->getTimestamp();
        } elseif ($limits->getByHour() === 0 && $now->format("dH") === $moment->format("dH")) {
            $delay = (59 - (int)$now->format("i")) * 60 + (60 - (int)$now->format("s"));
        } elseif ($limits->getByMinute() === 0 && $now->format("dHi") === $moment->format("dHi")) {
            $delay = 60 - (int)$now->format("s");
        } elseif ($limits->getBySecond() === 0 && $now->format("dHis") === $moment->format("dHis")) {
            $delay = 1;
        }

        return $delay ?: false;
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
