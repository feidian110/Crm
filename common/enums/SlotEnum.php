<?php


namespace addons\Crm\common\enums;


use common\enums\BaseEnum;

class SlotEnum extends BaseEnum
{
    const MOR = 0;
    const NOON = 1;
    const AFTER = 2;
    const NIGHT = 3 ;
    const DAY = 4;



    /**
     * @return array
     */
    public static function getMap(): array
    {
        return [
            self::MOR => '早上',
            self::NOON => '中午',
            self::AFTER => '下午',
            self::NIGHT => '晚上',
            self::DAY => '全天',

        ];
    }
}