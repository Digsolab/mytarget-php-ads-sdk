<?php

namespace MyTarget\Domain\V1\Enum;

use Dsl\MyTarget\Domain\AbstractEnum;

class RemarketingUserListStatus extends AbstractEnum
{
    const LOADING = 'loading';
    const LOADED = 'loaded';
    const UNLOADED = 'unloaded';
    const RECEIVING = 'receiving';
    const RECEIVED = 'received';
    const MAPPING = 'mapping';
    const MAPPED = 'mapped';
    const WRITING = 'writing';
    const READY = 'ready';
    const PENDING_DELETE = 'pending_delete';
    const DELETING = 'deleting';
    const DELETED = 'deleted';
    const DELETED_TO_NOTIFY = 'deleted_to_notify';

    /**
     * @return RemarketingUserListStatus
     */
    public static function loading()
    {
        return self::fromValue(self::LOADING);
    }

    /**
     * @return RemarketingUserListStatus
     */
    public static function loaded()
    {
        return self::fromValue(self::LOADED);
    }

    /**
     * @return RemarketingUserListStatus
     */
    public static function unloaded()
    {
        return self::fromValue(self::UNLOADED);
    }

    /**
     * @return RemarketingUserListStatus
     */
    public static function receiving()
    {
        return self::fromValue(self::RECEIVING);
    }

    /**
     * @return RemarketingUserListStatus
     */
    public static function received()
    {
        return self::fromValue(self::RECEIVED);
    }

    /**
     * @return RemarketingUserListStatus
     */
    public static function mapping()
    {
        return self::fromValue(self::MAPPING);
    }

    /**
     * @return RemarketingUserListStatus
     */
    public static function mapped()
    {
        return self::fromValue(self::MAPPED);
    }

    /**
     * @return RemarketingUserListStatus
     */
    public static function writing()
    {
        return self::fromValue(self::WRITING);
    }

    /**
     * @return RemarketingUserListStatus
     */
    public static function ready()
    {
        return self::fromValue(self::READY);
    }

    /**
     * @return RemarketingUserListStatus
     */
    public static function pendingDelete()
    {
        return self::fromValue(self::PENDING_DELETE);
    }

    /**
     * @return RemarketingUserListStatus
     */
    public static function deleting()
    {
        return self::fromValue(self::DELETING);
    }

    /**
     * @return RemarketingUserListStatus
     */
    public static function deleted()
    {
        return self::fromValue(self::DELETED);
    }

    /**
     * @return RemarketingUserListStatus
     */
    public static function deletedToNotify()
    {
        return self::fromValue(self::DELETED_TO_NOTIFY);
    }
}
