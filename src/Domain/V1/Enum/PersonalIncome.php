<?php

namespace Dsl\MyTarget\Domain\V1\Enum;

use Dsl\MyTarget\Domain\AbstractEnum;

class PersonalIncome extends AbstractEnum
{
    const INCOME1 = "income-1";
    const INCOME2 = "income-2";
    const INCOME3 = "income-3";
    const INCOME4 = "income-4";
    const INCOME5 = "income-5";

    /**
     * @return PersonalIncome
     */
    public static function income1()
    {
        return PersonalIncome::fromValue(self::INCOME1);
    }

    /**
     * @return PersonalIncome
     */
    public static function income2()
    {
        return PersonalIncome::fromValue(self::INCOME2);
    }

    /**
     * @return PersonalIncome
     */
    public static function income3()
    {
        return PersonalIncome::fromValue(self::INCOME3);
    }

    /**
     * @return PersonalIncome
     */
    public static function income4()
    {
        return PersonalIncome::fromValue(self::INCOME4);
    }

    /**
     * @return PersonalIncome
     */
    public static function income5()
    {
        return PersonalIncome::fromValue(self::INCOME5);
    }
}
