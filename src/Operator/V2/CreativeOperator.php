<?php

namespace MyTarget\Operator\V2;

use MyTarget\Client;
use MyTarget\Domain\V2\Enum\CreativeType;
use MyTarget\Mapper\Mapper;
use MyTarget\Operator\Exception\UnexpectedFileArgumentException;
use MyTarget\Domain\V2\Creative;
use MyTarget\Domain\V2\UploadCreative;
use Psr\Http\Message\StreamInterface;

class CreativeOperator
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
     * @param resource|string|StreamInterface $file Can be a StreamInterface instance, resource or a file path
     * @param CreativeType $type
     * @param UploadCreative $creative
     * @param array|null $context
     *
     * @return Creative
     */
    public function create($file, CreativeType $type, UploadCreative $creative, array $context = null)
    {
        if (is_string($file)) { // assume it's a file path
            $file = fopen($file, 'r');
        }
        if ( ! $file instanceof StreamInterface && ! is_resource($file)) {
            throw new UnexpectedFileArgumentException($file);
        }

        $rawCreative = $this->mapper->snapshot($creative);
        $body = [
            ["name" => "file", "contents" => $file],
            ["name" => "data", "contents" => \json_encode($rawCreative)]];

        $path = sprintf("/api/v2/content/%s.json", $type->getValue());
        $json = $this->client->postMultipart($path, $body, null, $context);

        return $this->mapper->hydrateNew(Creative::class, $json);
    }
}
