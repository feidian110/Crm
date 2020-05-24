<?php


namespace addons\Crm\common\enums;


use common\enums\BaseEnum;

class NatureEnum extends BaseEnum
{
    const MARRY = 0;
    const BACK = 1;
    const JOINT = 2;
    const BIRTHDAY = 3 ;
    const BUSINESS = 4;
    const LONG = 5;
    const OTHER = 6;


    /**
     * @return array
     */
    public static function getMap(): array
    {
        return [
            self::MARRY => '结婚',
            self::BACK => '回门',
            self::JOINT => '合办',
            self::BIRTHDAY => '生日',
            self::BUSINESS => '会议',
            self::LONG => '寿宴',
            self::OTHER => '其他',
        ];
    }
}