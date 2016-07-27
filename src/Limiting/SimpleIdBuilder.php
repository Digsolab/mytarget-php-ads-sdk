<?php

namespace MyTarget\Limiting;

class SimpleIdBuilder implements IdBuilder
{
    /**
     * @inheritdoc
     */
    public function buildId($limitBy, $username = null)
    {
        return $limitBy . '#' . (string) $username;
    }
}
