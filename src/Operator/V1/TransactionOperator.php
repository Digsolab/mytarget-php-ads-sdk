<?php

namespace Dsl\MyTarget\Operator\V1;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\V1\Transaction;
use Dsl\MyTarget\Mapper\Mapper;

class TransactionOperator
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var Mapper
     */
    private $mapper;

    public function __construct(Client $client, Mapper $mapper)
    {
        $this->client = $client;
        $this->mapper = $mapper;
    }

    /**
     * @param string|int $userId Numeric ID or an email
     * @param string $amount
     * @param array|null $context
     *
     * @return Transaction
     */
    public function give($userId, $amount, array $context = null)
    {
        $context = (array)$context + ["limit-by" => "transaction-give"];
        $path = sprintf("/api/v1/transactions/to/%s.json", rawurlencode($userId));

        $json = $this->client->post($path, null, ["amount" => $amount], $context);

        return $this->mapper->hydrateNew(Transaction::class, $json);
    }

    /**
     * @param string|int $userId Numeric ID or an email
     * @param string $amount
     * @param array|null $context
     *
     * @return Transaction
     */
    public function take($userId, $amount, array $context = null)
    {
        $context = (array)$context + ["limit-by" => "transaction-take"];
        $path = sprintf("/api/v1/transactions/from/%s.json", rawurlencode($userId));

        $json = $this->client->post($path, null, ["amount" => $amount], $context);

        return $this->mapper->hydrateNew(Transaction::class, $json);
    }
}
