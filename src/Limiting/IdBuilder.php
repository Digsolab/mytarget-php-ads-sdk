<?php

namespace MyTarget\Limiting;

interface IdBuilder
{
    /**
     * @param string      $limitBy
     * @param string|null $username
     *
     * @return string
     */
    public function buildId($limitBy, $username = null);
}
