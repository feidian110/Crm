<?php


namespace addons\Crm\common\enums;


use common\enums\BaseEnum;

class SourceEnum extends BaseEnum
{
    const A = 0;
    const B = 1;
    const C = 2;
    const D = 3 ;
    const E = 4;
    const F = 5;
    const G = 6;
    const H = 7;
    const I = 8;

    /**
     * @return array
     */
    public static function getMap(): array
    {
        return [
            self::A => '活动促销',
            self::B => '搜索引擎',
            self::C => '广告',
            self::D => '转介绍',
            self::E => '线上注册',
            self::F => '预约上门',
            self::G => '电话咨询',
            self::H => '邮件咨询',
            self::I => '关系'
        ];
    }
}