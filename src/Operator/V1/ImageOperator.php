<?php

namespace MyTarget\Operator\V1;

use MyTarget\Client;
use MyTarget\Domain\V1\Image;
use MyTarget\Domain\V1\UploadImage;
use MyTarget\Mapper\Mapper;
use MyTarget\Operator\Exception\UnexpectedFileArgumentException;
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
     * @param resource|string|StreamInterface $file Can be a StreamInterface instance, resource or a file path
     * @param UploadImage $image
     * @param array|null $context
     *
     * @return Image
     */
    public function upload($file, UploadImage $image, array $context = null)
    {
        if (is_string($file)) { // assume it's a file path
            $file = fopen($file, 'r');
        }
        if ( ! $file instanceof StreamInterface && ! is_resource($file)) {
            throw new UnexpectedFileArgumentException($file);
        }

        $imageInfo = $this->mapper->snapshot($image);
        $imageInfo = array_filter($imageInfo, function ($v) { return $v !== null; });

        $body = [];
        foreach ($imageInfo as $key => $value) {
            $body[] = ["name" => $key, "contents" => $value];
        }

        $body[] = ["name" => "image_file", "contents" => $file];

        $json = $this->client->postMultipart("/api/v1/images.json", $body, null, $context);

        return $this->mapper->hydrateNew(Image::class, $json);
    }
}
