<?php

namespace Dsl\MyTarget\Domain\V2;

use Dsl\MyTarget\Mapper\Annotation\Field;

class Token
{
    /**
     * @var string
     * @Field(type="string", name="access_token")
     */
    private $access;

    /**
     * @var string
     * @Field(type="string", name="token_type")
     */
    private $type;

    /**
     * @var int
     * @Field(type="int", name="expires_in")
     */
    private $expiresIn;

    /**
     * @var string
     * @Field(type="string", name="refresh_token")
     */
    private $refresh;

    /**
     * @return string
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * @return string
     */
    public function getRefresh()
    {
        return $this->refresh;
    }
}
