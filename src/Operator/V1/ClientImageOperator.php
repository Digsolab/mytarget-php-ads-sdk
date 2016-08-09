<?php

namespace Dsl\MyTarget\Operator\V1;

use Dsl\MyTarget\Client;
use Dsl\MyTarget\Domain\V1\Image\UploadImage;
use Dsl\MyTarget\Mapper\Mapper;

class ClientImageOperator extends ImageOperator
{
    /**
     * @var string
     */
    private $username;

    /**
     * @param string $username
     * @param Client $client
     * @param Mapper $mapper
     */
    public function __construct($username, Client $client, Mapper $mapper)
    {
        parent::__construct($client, $mapper);

        $this->username = $username;
    }

    public function upload($file, UploadImage $image, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::upload($file, $image, $context);
    }
}
