<?php

namespace MyTarget\Token;

use DSL\LockInterface;
use MyTarget\Token\Exception\TokenLockException;

class LockManager
{

    /** @var  LockInterface */
    private $lock;

    /** @var  int */
    private $lifetime;

    /** @var callable  */
    private $hashFunction;

    /**
     * LockManager constructor.
     *
     * @param LockInterface $lock
     * @param int           $lifetime
     * @param callable      $hashFunction
     */
    public function __construct(LockInterface $lock, $lifetime, callable $hashFunction = null)
    {
        $this->lock = $lock;
        $this->lifetime = $lifetime;
        $this->hashFunction = $hashFunction ?: function($id) { return $id; };
    }

    /**
     * @param string $id
     *
     * @throws TokenLockException
     */
    public function lock($id)
    {
        $name = $this->hash($id);
        if ( ! $this->lock->lock($name, $this->lifetime)) {
            throw new TokenLockException(sprintf('Could not obtain temporary cache lock: %s', $name));
        }
    }

    /**
     * @param string $id
     */
    public function unlock($id)
    {
        $this->lock->unlock($this->hash($id));
    }

    /**
     * @param string $id
     *
     * @return string
     */
    private function hash($id)
    {
        $f = $this->hashFunction;

        return $f($id);
    }

}
