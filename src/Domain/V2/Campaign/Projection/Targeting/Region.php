<?php

namespace Dsl\MyTarget\Domain\V2\Campaign\Projection\Targeting;

use Dsl\MyTarget\Mapper\Annotation\Field;

class Region
{
    /**
     * @var int
     * @Field(type="int")
     */
    private $id;

    /**
     * @var string[]
     * @Field(name="user_geo", type="array<string>")
     */
    private $userGeo;

    public function __construct($id, array $userGeo = [])
    {
        $this->id = $id;
        $this->userGeo = $userGeo;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \string[]
     */
    public function getUserGeo()
    {
        return $this->userGeo;
    }

}
