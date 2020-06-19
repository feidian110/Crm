<?php


namespace addons\Crm\common\enums;


use common\enums\BaseEnum;

class CustomerStatusEnum extends BaseEnum
{
    const DISABLED = 0;
    const ENABLED = 1;
    const SIGN = 2;
    const EXECUTE = 3;
    const COMPLETE = 4;
    const DELETE = -1;



    public static function getMap(): array
    {
        return [
            self::ENABLED => '跟进中',
            self::COMPLETE => '已完成',
            self::SIGN => '已签订',
            self::EXECUTE => '执行中',
            self::DISABLED => '待处理',
            self::DELETE => '不再跟进',

        ];
    }

    public static function getLabel(): array
    {
        return [
            self::ENABLED => '<span class="label bg-purple-gradient">跟进中</span>',
            self::COMPLETE => '<span class="label bg-gray">已完成</span>',
            self::SIGN => '<span class="label bg-light-blue">已签订</span>',
            self::EXECUTE => '<span class="label bg-green">执行中</span>',
            self::DISABLED => '<span class="label bg-yellow-gradient">待处理</span>',
            self::DELETE => '<span class="label bg-red">不再跟进</span>',

        ];
    }
}