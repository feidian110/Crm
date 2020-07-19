<?php


namespace addons\Crm\common\enums;


use common\enums\BaseEnum;

class DispatchEnum extends BaseEnum
{
    const DISABLED = 0;
    const ENABLED = 1;


    public static function getMap(): array
    {
        return [
            self::DISABLED => '<span class="label label-warning">待派单</span>',

            self::ENABLED => '<span class="label label-success">已派单</span>',
        ];
    }
}