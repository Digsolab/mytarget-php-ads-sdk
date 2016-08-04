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
     * @param string|null $clientName
     * @param string|null $clientInfo
     * @param string|null $name
     * @param string|null $email
     * @param string|null $phone
     * @param string|null $address
     */
    public function __construct($clientName = null, $clientInfo = null, $name = null, $email = null, $phone = null, $address = null)
    {
        $this->clientName = $clientName;
        $this->clientInfo = $clientInfo;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * @return string
     */
    public function getClientInfo()
    {
        return $this->clientInfo;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @param string $clientName
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;
    }

    /**
     * @param string $clientInfo
     */
    public function setClientInfo($clientInfo)
    {
        $this->clientInfo = $clientInfo;
    }
}
