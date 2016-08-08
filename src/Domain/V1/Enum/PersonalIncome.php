<?php

namespace MyTarget\Domain\V1\Enum;

use MyTarget\Domain\AbstractEnum;

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
    public function income1()
    {
        return PersonalIncome::fromValue(self::INCOME1);
    }

    /**
     * @return PersonalIncome
     */
    public function income2()
    {
        return PersonalIncome::fromValue(self::INCOME2);
    }

    /**
     * @return PersonalIncome
     */
    public function income3()
    {
        return PersonalIncome::fromValue(self::INCOME3);
    }

    /**
     * @return PersonalIncome
     */
    public function income4()
    {
        return PersonalIncome::fromValue(self::INCOME4);
    }

    /**
     * @return PersonalIncome
     */
    public function income5()
    {
        return PersonalIncome::fromValue(self::INCOME5);
    }
}
