<?php

namespace MyTarget\Domain\V2\SharingKeys;

use MyTarget\Mapper\Annotation\Field;

class ShareObjects
{
    /**
     * @var bool
     * @Field(name="send_email", type="bool")
     */
    private $sendEmail;

    /**
     * @var ShareClient[]
     * @Field(type="array<MyTarget\Domain\V2\SharingKeys\ShareClient>")
     */
    private $users;

    /**
     * @var ShareSource[]
     * @Field(type="array<MyTarget\Domain\V2\SharingKeys\ShareSource>")
     */
    private $sources;

    /**
     * @param bool $sendEmail
     * @param ShareClient[] $users
     * @param ShareSource[] $sources
     */
    public function __construct($sendEmail, array $users, array $sources)
    {
        $this->sendEmail = $sendEmail;
        $this->users = $users;
        $this->sources = $sources;
    }

    /**
     * @return bool
     */
    public function isSendEmail()
    {
        return $this->sendEmail;
    }

    /**
     * @return ShareClient[]
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @return ShareSource[]
     */
    public function getSources()
    {
        return $this->sources;
    }
}
