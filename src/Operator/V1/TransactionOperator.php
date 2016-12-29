<?php

namespace Dsl\MyTarget\Operator\V1;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Context;
use Dsl\MyTarget\Domain\V1\Transaction;
use Dsl\MyTarget\Mapper\Mapper;

class TransactionOperator
{
    const LIMIT_GIVE = "transaction-give";
    const LIMIT_TAKE = "transaction-take";

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
     * @param Context|null $context
     *
     * @return Transaction
     */
    public function give($userId, $amount, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_GIVE);
        $path = sprintf("/api/v1/transactions/to/%s.json", rawurlencode($userId));

        $json = $this->client->post($path, null, ["amount" => $amount], $context);

        return $this->mapper->hydrateNew(Transaction::class, $json);
    }

    /**
     * @param string|int $userId Numeric ID or an email
     * @param string $amount
     * @param Context|null $context
     *
     * @return Transaction
     */
    public function take($userId, $amount, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_TAKE);
        $path = sprintf("/api/v1/transactions/from/%s.json", rawurlencode($userId));

        $json = $this->client->post($path, null, ["amount" => $amount], $context);

        return $this->mapper->hydrateNew(Transaction::class, $json);
    }
}
