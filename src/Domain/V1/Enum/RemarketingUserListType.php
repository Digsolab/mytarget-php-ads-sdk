<?php

namespace MyTarget\Domain\V1\Enum;

use Dsl\MyTarget\Domain\AbstractEnum;

class RemarketingUserListType extends AbstractEnum
{
    const OK = "ok";
    const MM = "mm";
    const VK = "vk";
    const PHONES = "phones";
    const EMAILS = "emails";
    const DEVICE = "device_id";
    const ANDROID = "android_id";
    const ADVERTISING = "advertising_id";
    const IDFA = "idfa";
    const DMP = "dmp_id";

    /**
     * @return RemarketingUserListType
     */
    public static function ok()
    {
        return self::fromValue(self::OK);
    }

    /**
     * @return RemarketingUserListType
     */
    public static function mm()
    {
        return self::fromValue(self::MM);
    }

    /**
     * @return RemarketingUserListType
     */
    public static function vk()
    {
        return self::fromValue(self::VK);
    }

    /**
     * @return RemarketingUserListType
     */
    public static function phones()
    {
        return self::fromValue(self::PHONES);
    }

    /**
     * @return RemarketingUserListType
     */
    public static function emails()
    {
        return self::fromValue(self::EMAILS);
    }

    /**
     * @return RemarketingUserListType
     */
    public static function device()
    {
        return self::fromValue(self::DEVICE);
    }

    /**
     * @return RemarketingUserListType
     */
    public static function android()
    {
        return self::fromValue(self::ANDROID);
    }

    /**
     * @return RemarketingUserListType
     */
    public static function advertising()
    {
        return self::fromValue(self::ADVERTISING);
    }

    /**
     * @return RemarketingUserListType
     */
    public static function idfa()
    {
        return self::fromValue(self::IDFA);
    }

    /**
     * @return RemarketingUserListType
     */
    public static function dmp()
    {
        return self::fromValue(self::DMP);
    }
}
