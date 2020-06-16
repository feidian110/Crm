<?php


namespace addons\Crm\common\enums;


use common\enums\BaseEnum;

class TimeRangeEnum extends BaseEnum
{

    const TODAY = 2;
    const WEEK = 15;
    const MONTH = 14;
    const QUARTER = 13 ;
    const YEAR = 12;

    const YESTERDAY = 3;
    const LAST_WEEK = 6;
    const LAST_MONTH = 7;
    const LAST_QUARTER = 8 ;
    const LAST_YEAR =9;

    const TOMORROW = 1;
    const NEXT_WEEK = 17;
    const NEXT_MONTH = 18;
    const NEXT_QUARTER = 19;
    const NEXT_YEAR = 20;
    const AFTER_DAY = 0;
    const BEFORE_YESTERDAY = 5;
    const BEFORE_DAY =4;

    /**
     * @return array
     */
    public static function getMap(): array
    {
        return [
            self::LAST_YEAR => '上年度',
            self::LAST_QUARTER => '上季度',
            self::LAST_MONTH => '上月',
            self::LAST_WEEK => '上周',
            self::YESTERDAY => '昨天',

            self::YEAR => '本年度',
            self::QUARTER => '本季度',
            self::MONTH => '本月',
            self::WEEK => '本周',
            self::TODAY => '今天',

            self::NEXT_YEAR => '下年度',
            self::NEXT_QUARTER => '下季度',
            self::NEXT_MONTH => '下月',
            self::NEXT_WEEK => '下周',
            self::TOMORROW => '明天',
            self::AFTER_DAY => '后天',
            self::BEFORE_YESTERDAY => '前天'
        ];
    }

}