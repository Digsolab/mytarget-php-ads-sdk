<?php

namespace Dsl\MyTarget;

class Context
{
    /**
     * @var string|null
     */
    private $username;

    /**
     * @var string
     */
    private $limitBy;

    /**
     * @var array|null
     */
    private $parameters;

    /**
     * @param string|null $username
     * @param string|null $limitBy
     * @param array|null $parameters
     */
    public function __construct($username = null, $limitBy = null, array $parameters = null)
    {
        $this->username = $username;
        $this->limitBy = $limitBy;
        $this->parameters = $parameters;
    }

    /**
     * @param string $username
     * @param array|null $parameters
     * @return static
     */
    public static function forClient($username, array $parameters = null)
    {
        return new static($username, null, $parameters);
    }

    /**
     * @param array|null $parameters
     * @return static
     */
    public static function params(array $parameters = null)
    {
        return new static(null, null, $parameters);
    }

    /**
     * @param Context|null $ctx
     * @param string $limitBy
     * @return static
     */
    public static function withLimitBy(Context $ctx = null, $limitBy)
    {
        if ($ctx) {
            $ctx->limitBy = $limitBy;
        } else {
            $ctx = new static(null, $limitBy);
        }

        return $ctx;
    }

    /**
     * @return bool
     */
    public function hasUsername()
    {
        return $this->username !== null;
    }

    /**
     * @return null|string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return null|string
     */
    public function getLimitBy()
    {
        return $this->limitBy;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function addParameter($key, $value)
    {
        $this->parameters[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function hasParameter($key)
    {
        return isset($this->parameters[$key]);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getParameter($key)
    {
        return isset($this->parameters[$key]) ? $this->parameters[$key] : null;
    }

    /**
     * @return array|null
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}
