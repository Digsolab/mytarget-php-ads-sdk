<?php

namespace MyTarget\Limiting;

class SimpleIdBuilder implements IdBuilder
{
    /**
     * @inheritdoc
     */
    public function buildId($limitBy, $username = null)
    {
        $id =  $limitBy . '#' . (string)$username;

        return $id;
    }
}
