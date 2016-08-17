<?php

namespace Dsl\MyTarget\Operator\V1\Remarketing;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingUserList;
use Dsl\MyTarget\Domain\V1\Remarketing\UploadUserList;
use Dsl\MyTarget\Mapper\Mapper;
use Psr\Http\Message\StreamInterface;

class RemarketingUserListsOperator
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
     * @param resource|string|StreamInterface $file
     * @param UploadUserList $upload
     * @param array|null $context
     * @return RemarketingUserList
     */
    public function create($file, UploadUserList $upload, array $context = null)
    {
        $file = \Dsl\MyTarget\streamOrResource($file);

        $body = [
            ["name" => "name", "contents" => $upload->getName()],
            ["name" => "type", "contents" => $upload->getType()],
            ["name" => "base", "contents" => $upload->getBase()],
            ["name" => "file", "contents" => $file]
        ];

        $json = $this->client->postMultipart("/api/v1/remarketing_users_lists.json", $body, null, $context);

        return $this->mapper->hydrateNew(RemarketingUserList::class, $json);
    }

    /**
     * @param array|null $context
     *
     * @return RemarketingUserList[]
     */
    public function all(array $context = null)
    {
        $json = $this->client->get("/api/v1/remarketing_users_lists.json", null, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(RemarketingUserList::class, $json);
        }, $json);
    }

    /**
     * @param int $id
     * @param array|null $context
     */
    public function delete($id, array $context = null)
    {
        $path = sprintf("/api/v1/remarketing_users_list/%d.json", $id);
        $this->client->delete($path, null, $context);
    }
}
