<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

class Sex extends AbstractEnum
{
    const MALE = 'M';
    const FEMALE = 'F';
    const BOTH = 'MF';
}
