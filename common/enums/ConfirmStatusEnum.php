<?php
namespace addons\Crm\common\enums;

use common\enums\BaseEnum;

class ConfirmStatusEnum extends BaseEnum
{
    const DISABLED = 0;
    const ENABLED = 1;
    const DELETE = -1;
    const REJECT = 2;

    public static function getMap(): array
    {
        return [
            self::DISABLED => '<span class="label label-warning">待确认</span>',

            self::ENABLED => '<span class="label label-success">已确认</span>',

            self::REJECT => '<span class="label label-danger">已驳回</span>',

            self::DELETE => '<span class="label label-default">已删除</span>'
        ];
    }
}