<?php

namespace Dsl\MyTarget\Operator\V1\Remarketing;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Context;
use Dsl\MyTarget\Domain\V1\Remarketing\RemarketingContextPhrases;
use Dsl\MyTarget\Mapper\Mapper;
use Psr\Http\Message\StreamInterface;

class RemarketingCtxPhrasesOperator
{
    const LIMIT_CREATE = "remarketing-phrases-create";
    const LIMIT_FIND = "remarketing-phrases-find";
    const LIMIT_DELETE = "remarketing-phrases-delete";

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
     * @param Context|null $context
     *
     * @return RemarketingContextPhrases
     */
    public function create($file, $name, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_CREATE);
        $file = \Dsl\MyTarget\streamOrResource($file);

        $body = [
            ["name" => "name", "contents" => $name],
            ["name" => "file", "contents" => $file]
        ];

        $json = $this->client->postMultipart("/api/v1/remarketing_context_phrases.json", $body, null, $context);

        return $this->mapper->hydrateNew(RemarketingContextPhrases::class, $json);
    }

    /**
     * @param Context|null $context
     *
     * @return RemarketingContextPhrases[]
     */
    public function all(Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_FIND);
        $json = $this->client->get("/api/v1/remarketing_context_phrases.json", null, $context);

        return array_map(function ($json) {
            return $this->mapper->hydrateNew(RemarketingContextPhrases::class, $json);
        }, $json);
    }

    /**
     * @param int $id
     * @param Context|null $context
     */
    public function delete($id, Context $context = null)
    {
        $context = Context::withLimitBy($context, self::LIMIT_DELETE);
        $path = sprintf("/api/v1/remarketing_context/phrases/%d.json", $id);
        $this->client->delete($path, null, $context);
    }
}
