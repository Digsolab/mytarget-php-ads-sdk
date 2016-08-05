<?php

namespace Dsl\MyTarget\Domain\V1\Remarketing;

use Dsl\MyTarget\Domain\V1\Enum\RemarketingType;
use Dsl\MyTarget\Mapper\Annotation\Field;

class RemarketingContextPhrasesInterval extends RemarketingInterval
{
    /**
     * @var int
     * @Field(name="remarketing_context_phrases_id", type="int")
     */
    private $contextPhrasesId;

    /**
     * @param int $contextPhrasesId
     * @param int $left
     * @param int $right
     * @param RemarketingType $type
     */
    public function __construct($contextPhrasesId, $left, $right, RemarketingType $type)
    {
        parent::__construct($left, $right, $type);

        $this->contextPhrasesId = $contextPhrasesId;
    }

    /**
     * @return int
     */
    public function getContextPhrasesId()
    {
        return $this->contextPhrasesId;
    }
}
