<?php


namespace addons\Crm\common\enums;


use common\enums\BaseEnum;

class IndustryEnum extends BaseEnum
{
    const IT = 0;
    const BANKING = 1;
    const MEDIA = 2;
    const GOV = 3 ;
    const PROPERTY = 4;
    const BUSINESS = 5;
    const PRODUCE = 6;
    const LOG =7;

    /**
     * @return array
     */
    public static function getMap(): array
    {
        return [
            self::IT => 'IT行业',
            self::BANKING => '金融',
            self::MEDIA => '传媒',
            self::GOV => '政府',
            self::PROPERTY => '房地产',
            self::BUSINESS => '商业服务',
            self::PRODUCE => '生产',
            self::LOG => '运输/物流'
        ];
    }
}