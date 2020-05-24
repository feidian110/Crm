<?php


namespace addons\Crm\common\enums;


use common\enums\BaseEnum;

class CustomerLevelEnum extends BaseEnum
{
    const A = 0;
    const B = 1;
    const C = 2;
    const D = 3;



    /**
     * @return array
     */
    public static function getMap(): array
    {
        return [
            self::A => '意向客户',
            self::B => '普通客户',
            self::C => '优选客户',
            self::D => '重点客户',

        ];
    }

}