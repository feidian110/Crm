<?php
namespace addons\Crm\common\services;

use common\components\Service;

/**
 * Class Application
 * @package addons\Crm\common\services
 * @property \addons\Crm\common\services\field\FieldService $crmField 自定义字段
 */

class Application extends Service
{
    public $childService = [
        'crmField' => 'addons\Crm\common\services\field\FieldService',
    ];
}