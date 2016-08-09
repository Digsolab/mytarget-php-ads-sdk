<?php

namespace Dsl\MyTarget\Token;

use DSL\LockInterface;
use Dsl\MyTarget\Token\Exception\TokenLockException;

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
        $name = call_user_func($this->hashFunction, $id);

        if ( ! $this->lock->lock($name, $this->lifetime)) {
            throw new TokenLockException(sprintf('Could not obtain temporary lock: %s', $name));
        }
    }

    /**
     * @param string $id
     */
    public function unlock($id)
    {
        $this->lock->unlock(call_user_func($this->hashFunction, $id));
    }
}
