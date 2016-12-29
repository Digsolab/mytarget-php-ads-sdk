<?php

namespace Dsl\MyTarget\Operator\V2;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Context;
use Dsl\MyTarget\Domain\V2\Id;
use Dsl\MyTarget\Domain\V2\SharingKeys\SharedObjects;
use Dsl\MyTarget\Domain\V2\SharingKeys\ShareObjects;
use Dsl\MyTarget\Mapper\Mapper;

class SharingKeysOperator
{
    const LIMIT_SHARE = "v2-sharing-keys-share";
    const LIMIT_APPROVE = "v2-sharing-keys-approve";
    const LIMIT_REVOKE = "v2-sharing-keys-revoke";

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
     * @param ShareObjects $share
     * @param Context|null $context
     *
     * @return SharedObjects
     */
    public function share(ShareObjects $share, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_SHARE);
        $rawShare = $this->mapper->snapshot($share);

        $json = $this->client->post("/api/v2/sharing_keys.json", null, $rawShare, $context);

        return $this->mapper->hydrateNew(SharedObjects::class, $json);
    }

    /**
     * @param string $sharingKey
     * @param string $username
     * @param Context|null $context
     *
     * @return Id
     */
    public function approve($sharingKey, $username, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_APPROVE);
        $path = sprintf("/api/v2/sharing_keys/%s/users/%s.json", $sharingKey, $username);
        $json = $this->client->post($path, null, ["status" => "active"], $context);

        return $this->mapper->hydrateNew(Id::class, $json);
    }

    /**
     * @param int $usersListId
     * @param string $userId
     * @param Context|null $context
     */
    public function revokeAccess($usersListId, $userId, Context $context = null)
    {
        $path = sprintf("/api/v2/remarketing/users_lists/%d/users/%d.json", $usersListId, $userId);
        $this->client->delete($path, null, Context::withLimitBy($context, self::LIMIT_REVOKE));
    }
}
