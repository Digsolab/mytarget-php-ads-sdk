<?php

namespace Dsl\MyTarget\Operator\V2;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\V2\Id;
use Dsl\MyTarget\Domain\V2\SharingKeys\SharedObjects;
use Dsl\MyTarget\Domain\V2\SharingKeys\ShareObjects;
use Dsl\MyTarget\Mapper\Mapper;

class SharingKeysOperator
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
     * @param ShareObjects $share
     * @param array|null $context
     *
     * @return SharedObjects
     */
    public function share(ShareObjects $share, array $context = null)
    {
        $rawShare = $this->mapper->snapshot($share);

        $json = $this->client->post("/api/v2/sharing_keys.json", null, $rawShare, $context);

        return $this->mapper->hydrateNew(SharedObjects::class, $json);
    }

    /**
     * @param string $sharingKey
     * @param string $username
     * @param array|null $context
     *
     * @return Id
     */
    public function approve($sharingKey, $username, array $context = null)
    {
        $path = sprintf("/api/v2/sharing_keys/%s/users/%s.json", $sharingKey, $username);
        $json = $this->client->post($path, null, ["status" => "active"], $context);

        return $this->mapper->hydrateNew(Id::class, $json);
    }

    /**
     * @param int $usersListId
     * @param string $userId
     * @param array|null $context
     */
    public function revokeAccess($usersListId, $userId, array $context = null)
    {
        $path = sprintf("/api/v2/remarketing/users_lists/%d/users/%d.json", $usersListId, $userId);
        $this->client->delete($path, null, $context);
    }
}
