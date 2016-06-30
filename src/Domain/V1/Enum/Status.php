<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;
use MyTarget\Exception\UnexpectedValueException;

class Status extends AbstractEnum
{
    const ACTIVE = 'active';
    const DELETED = 'deleted';
    const BLOCKED = 'blocked';

    /**
     * @param Status[] $withStatuses
     * @return string|null
     */
    public static function inApiFormat(array $withStatuses)
    {
        $withStatuses = array_values(array_unique($withStatuses, SORT_REGULAR));
        $withStatuses = array_map(function (Status $s) { return $s->getValue(); }, $withStatuses);

        $apiStatus = null;
        if ($withStatuses && count($withStatuses) !== 3) {
            if (count($withStatuses) === 1) {
                $apiStatus = $withStatuses[0];
            } elseif (count($withStatuses) === 2) {
                $withStatuses = array_diff([Status::ACTIVE, Status::BLOCKED, Status::DELETED], $withStatuses);
                $apiStatus = '-' . reset($withStatuses);
            } else {
                throw new UnexpectedValueException("Unreachable statement: there can't be more than 3 statuses");
            }
        }

        return $apiStatus;
    }
}
