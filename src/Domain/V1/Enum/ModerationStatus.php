<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

class ModerationStatus extends AbstractEnum
{
    const NEW_ = 'new';
    const CHANGED = 'changed';
    const DELAYED = 'delayed';
    const ALLOWED = 'allowed';
    const BANNED = 'banned';
}
