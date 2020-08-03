<?php


namespace addons\Crm\common\enums;


use common\enums\BaseEnum;

class RecordMethodEnum extends BaseEnum
{
    const TEL = 1;
    const WECHAT = 2;
    const EMAIL = 3;
    const QQ = 4;
    const STORE = 0;
    const DOOR = 5;
    const MESSAGE = 6;
    const ALIPAY = 7;
    const OTHER = 8;


    /**
     * @return array
     */
    public static function getMap(): array
    {
        return [
            self::STORE => '到店沟通',
            self::TEL => '电话沟通',
            self::WECHAT => '微信沟通',
            self::EMAIL => '电子邮箱',
            self::QQ => 'QQ沟通',
            self::DOOR => '上门拜访',
            self::MESSAGE => '短信沟通',
            self::ALIPAY => '支付宝沟通',
            self::OTHER => '其他方式',
        ];
    }
}