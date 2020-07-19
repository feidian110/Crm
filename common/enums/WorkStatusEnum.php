<?php


namespace addons\Crm\common\enums;


use common\enums\BaseEnum;

class WorkStatusEnum extends BaseEnum
{
    const DISABLED = 0;
    const ENABLED = 1;
    const COMPLETE = 2;

    public static function getMap(): array
    {
        return [
            self::DISABLED => '<span class="label bg-purple-gradient">待派单</span>',
            self::COMPLETE => '<span class="label bg-yellow-gradient">已派单</span>',
            self::ENABLED => '<span class="label bg-red">部分派单</span>',
        ];
    }
}