<?php

namespace MyTarget\Domain\V1;

use MyTarget\Domain\V1\Enum\Mailing;
use MyTarget\Domain\V1\Enum\Status;

class User extends AbstractHydratedObject
{
    private $id;

    private $username;

    private $firstName;

    private $lastName;

    private $email;

    private $types;

    /** @var Status */
    private $status;

    private $additionalInfo;

    /** @var Mailing[] */
    private $mailings;

    /** @var mixed */
    private $permissions;

    private $account;

    private $agency;

    private $agencyUsername;

    private $branchUsername;

    private $bf;

    private $flags;

    private $maxActiveBannersCount;

    private $activeBannersCount;

    private $appendUtm;

    private $showCompactView;

    private $infoCurrency;

    private $currency;
}
