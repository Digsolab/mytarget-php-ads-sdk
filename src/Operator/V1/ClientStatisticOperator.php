<?php

namespace Dsl\MyTarget\Operator\V1;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\DateRange;
use Dsl\MyTarget\Domain\V1\Enum\ObjectType;
use Dsl\MyTarget\Domain\V1\Enum\StatisticType;
use Dsl\MyTarget\Mapper\Mapper;

class ClientStatisticOperator extends StatisticOperator
{
    /**
     * @var string
     */
    private $username;

    /**
     * @param string $username
     * @param Client $client
     * @param Mapper $mapper
     */
    public function __construct($username, Client $client, Mapper $mapper)
    {
        parent::__construct($client, $mapper);

        $this->username = $username;
    }

    public function one($id, ObjectType $objectType, StatisticType $statType, DateRange $datesPredicate = null, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::one($id, $objectType, $statType, $datesPredicate, $context);
    }

    public function all(array $ids, ObjectType $objectType, StatisticType $statType, DateRange $datesPredicate = null, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::all($ids, $objectType, $statType, $datesPredicate, $context);
    }
}
