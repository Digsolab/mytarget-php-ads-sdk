<?php

namespace MyTarget\Domain\V1\Remarketing;

use MyTarget\Domain\V1\Enum\RemarketingType;
use MyTarget\Mapper\Annotation\Field;

class RemarketingUsersList
{
    /**
     * @var int
     * @Field(name="remarketing_users_list_id", type="int")
     */
    private $listId;

    /**
     * @var RemarketingType
     * @Field(type="MyTarget\Domain\V1\Enum\RemarketingType")
     */
    private $type;

    /**
     * @param int $listId
     * @param RemarketingType $type
     */
    public function __construct($listId, RemarketingType $type)
    {
        $this->listId = $listId;
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getListId()
    {
        return $this->listId;
    }

    /**
     * @return RemarketingType
     */
    public function getType()
    {
        return $this->type;
    }
}
