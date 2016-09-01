<?php

namespace Dsl\MyTarget\Operator\V1;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\V1\Image\Image;
use Dsl\MyTarget\Domain\V1\Image\UploadImage;
use Dsl\MyTarget\Mapper\Mapper;
use Dsl\MyTarget as f;
use Psr\Http\Message\StreamInterface;

class ImageOperator
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
     * @param string $username
     *
     * @return ClientImageOperator
     */
    public function forClient($username)
    {
        return new ClientImageOperator($username, $this->client, $this->mapper);
    }

    /**
     * @param resource|string|StreamInterface $file Can be a StreamInterface instance, resource or a file path
     * @param UploadImage $image
     * @param array|null $context
     * @param str|null $filename
     *
     * @return Image
     */
    public function upload($file, UploadImage $image, array $context = null, $filename = null)
    {
        $file = f\streamOrResource($file);

        $imageInfo = $this->mapper->snapshot($image);
        $imageInfo = array_filter($imageInfo, function ($v) { return $v !== null; });

        $body = [];
        foreach ($imageInfo as $key => $value) {
            $body[] = ["name" => $key, "contents" => $value];
        }

        $parameters = ["name" => "image_file", "contents" => $file];
        if (null !== $filename) {
            $parameters['filename'] = $filename;
        }

        $body[] = $parameters;

        $json = $this->client->postMultipart("/api/v1/images.json", $body, null, $context);

        return $this->mapper->hydrateNew(Image::class, $json);
    }
}
