<?php
namespace addons\Crm\common\enums;

use common\enums\BaseEnum;

class CrmTypeEnum extends BaseEnum
{
    const LEADS = 0;
    const CUSTOMER = 1;
    const BUSINESS = 2;
    const CONTACT = 3;
    const CONTRACT = 4;
    const FOLLOW = 5;
    const RECEIPT = 6;
    const PAY = 7;
    const WORKS = 8;
    const EXECUTE = 9;


    /**
     * @return array
     */
    public static function getMap(): array
    {
        return [
            self::LEADS => '线索',
            self::CUSTOMER => '客户',
            self::BUSINESS => '商机',
            self::CONTACT => '联系人',
            self::CONTRACT => '合同',
            self::FOLLOW => '跟进',
            self::RECEIPT => '收款',
            self::PAY => '付款',
            self::WORKS => '工单',
            self::EXECUTE => '执行',
        ];
    }
}