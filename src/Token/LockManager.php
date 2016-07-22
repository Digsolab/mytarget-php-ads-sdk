<?php

namespace MyTarget\Token;

use DSL\LockInterface;
use MyTarget\Token\Exception\TokenLockException;

class LockManager
{

    /** @var  LockInterface */
    private $lock;

    /** @var  string */
    private $prefix;

    /** @var  int */
    private $lifetime;

    /**
     * LockManager constructor.
     *
     * @param LockInterface $lock
     * @param string        $prefix
     * @param int           $lifetime
     */
    public function __construct(LockInterface $lock, $prefix, $lifetime)
    {
        $this->lock = $lock;
        $this->prefix = $prefix;
        $this->lifetime = $lifetime;
    }

    /**
     * @param string $id
     *
     * @throws TokenLockException
     */
    public function lock($id)
    {
        $name = $this->getLockNameById($id);
        if ( ! $this->lock->lock($name, $this->lifetime)) {
            throw new TokenLockException(sprintf('Could not obtain temporary cache lock: %s', $name));
        }
    }

    /**
     * @param string $id
     */
    public function unlock($id)
    {
        $this->lock->unlock($this->getLockNameById($id));
    }

    private function getLockNameById($id)
    {
        return sprintf("%s_%s", $this->prefix, $id);
    }

}
