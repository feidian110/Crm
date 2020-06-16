<?php


namespace addons\Crm\common\enums;


use common\enums\BaseEnum;

class PayStatusEnum extends BaseEnum
{
    const DISABLED = 0;
    const ENABLED = 2;
    const PART = 1;

    public static function getMap(): array
    {
        return [
            self::DISABLED => '<span class="label bg-purple-gradient">待付款</span>',
            self::PART => '<span class="label bg-yellow-gradient">部分付款</span>',
            self::ENABLED => '<span class="label bg-red">已付款</span>',
        ];
    }
}