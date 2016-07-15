<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

class AdditionalUserInfo
{
    /**
     * @var string
     * @Field(type="string")
     */
    private $name;

    /**
     * @var string
     * @Field(type="string")
     */
    private $email;

    /**
     * @var string
     * @Field(type="string")
     */
    private $phone;

    /**
     * @var string
     * @Field(type="string")
     */
    private $address;

    /**
     * @var string
     * @Field(type="string", name="client_name")
     */
    private $clientName;

    /**
     * @var string
     * @Field(type="string", name="client_info")
     */
    private $clientInfo;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * @param string $clientName
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;
    }

    /**
     * @return string
     */
    public function getClientInfo()
    {
        return $this->clientInfo;
    }

    /**
     * @param string $clientInfo
     */
    public function setClientInfo($clientInfo)
    {
        $this->clientInfo = $clientInfo;
    }
}
