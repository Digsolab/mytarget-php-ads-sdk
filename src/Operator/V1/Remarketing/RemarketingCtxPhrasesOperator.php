<?php

namespace MyTarget\Operator\V1\Remarketing;

use MyTarget\Client;
use MyTarget\Domain\V1\Remarketing\RemarketingContextPhrases;
use MyTarget\Mapper\Mapper;
use Psr\Http\Message\StreamInterface;

class RemarketingCtxPhrasesOperator
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
     * @param resource|StreamInterface|string $file
     * @param string $name
     * @param array|null $context
     *
     * @return RemarketingContextPhrases
     */
    public function create($file, $name, array $context = null)
    {
        $file = \MyTarget\streamOrResource($file);

        $body = [
            ["name" => "name", "contents" => $name],
            ["name" => "file", "contents" => $file]
        ];

        $json = $this->client->postMultipart("/api/v1/remarketing_context_phrases.json", $body, null, $context);

        return $this->mapper->hydrateNew(RemarketingContextPhrases::class, $json);
    }

    /**
     * @param array|null $context
     *
     * @return RemarketingContextPhrases[]
     */
    public function all(array $context = null)
    {
        $json = $this->client->get("/api/v1/remarketing_context_phrases.json", null, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(RemarketingContextPhrases::class, $json);
        }, $json);
    }

    /**
     * @param int $id
     * @param array|null $context
     */
    public function delete($id, array $context = null)
    {
        $path = sprintf("/api/v1/remarketing_context/phrases/%d.json", $id);
        $this->client->delete($path, null, $context);
    }
}
