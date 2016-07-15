<?php

namespace MyTarget\Operator\V1\Remarketing;

use MyTarget\Client;
use MyTarget\Domain\V1\Remarketing\UploadUserList;
use MyTarget\Mapper\Mapper;

class ClientRemarketingUserListsOperator extends RemarketingUserListsOperator
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

    public function create($file, UploadUserList $upload, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::create($file, $upload, $context);
    }

    public function all(array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        return parent::all($context);
    }

    public function delete($id, array $context = null)
    {
        $context = (array)$context + ["username" => $this->username];

        parent::delete($id, $context);
    }
}
