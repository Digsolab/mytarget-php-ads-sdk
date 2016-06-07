<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

class Mailing extends AbstractEnum
{
    const NEWS = 'news';
    const FINANCE = 'finance';
    const EVENT = 'event';
    const MODERATION = 'moderation';
    const OTHER = 'other';
}
