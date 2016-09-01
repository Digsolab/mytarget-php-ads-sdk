<?php

namespace Dsl\MyTarget\Operator\V2;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\V2\Enum\CreativeType;
use Dsl\MyTarget\Mapper\Mapper;
use Dsl\MyTarget\Operator\Exception\UnexpectedFileArgumentException;
use Dsl\MyTarget\Domain\V2\Creative;
use Dsl\MyTarget\Domain\V2\UploadCreative;
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
     * @param str|null $filename
     *
     * @return Creative
     */
    public function create($file, CreativeType $type, UploadCreative $creative, array $context = null, $filename = null)
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
        if (null !== $filename) {
            $body[0]['filename'] = $filename;
        }

        $path = sprintf("/api/v2/content/%s.json", $type->getValue());
        $json = $this->client->postMultipart($path, $body, null, $context);

        return $this->mapper->hydrateNew(Creative::class, $json);
    }
}
