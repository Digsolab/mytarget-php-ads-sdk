<?php

namespace Dsl\MyTarget\Operator\V1;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Context;
use Dsl\MyTarget\Domain\V1\UserApi;
use Dsl\MyTarget\Mapper\Mapper;
use Dsl\MyTarget\Operator\V1\Fields\UserFields;

class UserOperator
{
    const LIMIT_EDIT = 'user-edit';

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

    public function edit(UserApi $user, UserApiFields $fields, Context $context = null)
    {
        $path = '/api/v1/user.json';
        $query = ['fields' => $this->mapFields($fields->getFields())];
        $rawUser = $this->mapper->snapshot($user);
        $context = Context::withLimitBy($context, self::LIMIT_EDIT);

        $json = $this->client->post($path, $query, $rawUser, $context);

        return $this->mapper->hydrateNew(UserApi::class, $json);
    }

    /**
     * TODO to be changed
     *
     * @param array $fields
     * @return string
     */
    private function mapFields(array $fields)
    {
        $fields = array_map(function ($field) {
            return strtolower(preg_replace('~(?<=\\w)([A-Z])~', '_$1', $field));
        }, $fields);

        return implode(",", $fields);
    }
}
