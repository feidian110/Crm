<?php


namespace addons\Crm\common\enums;


use common\enums\BaseEnum;

class ContractStatusEnum extends BaseEnum
{
    const DISABLED = 0;
    const ENABLED = 1;
    const DELAY = 2;
    const WORKS = 3;
    const EXECUTE = 4;
    const COMPLETE = 5;
    const BACK = 6;
    const CHARGE = 7;
    const DELETE = -1;



    public static function getMap(): array
    {
        return [
            self::ENABLED => '待派单',
            self::COMPLETE => '已完成',
            self::DELAY => '延期中',
            self::WORKS => '已派单',
            self::EXECUTE => '执行中',
            self::DISABLED => '待付款',
            self::BACK => '退单中',
            self::CHARGE => '已退单',
            self::DELETE => '已删除',

        ];
    }
}