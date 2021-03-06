<?php
namespace addons\Crm\common\services;

use common\components\Service;

/**
 * Class Application
 * @package addons\Crm\common\services
 * @property \addons\Crm\common\services\field\FieldService $crmField 自定义字段
 * @property \addons\Crm\common\services\base\BaseService $base 基础
 * @property \addons\Crm\common\services\base\ActionRecordService $actionRecord
 * @property \addons\Crm\common\services\base\CrmStatService $crmStat 数据统计
 * @property \addons\Crm\common\services\common\LeadsService $leads 线索
 * @property \addons\Crm\common\services\common\CustomerService $customer 客户
 * @property \addons\Crm\common\services\common\ContactService $contact 联系人
 * @property \addons\Crm\common\services\common\ContractService $contract 合同
 * @property \addons\Crm\common\services\common\SupplierService $supplier 供应商
 */

class Application extends Service
{
    public $childService = [
        'base' => 'addons\Crm\common\services\base\BaseService',
        'actionRecord' => 'addons\Crm\common\services\base\ActionRecordService',
        'crmStat' => 'addons\Crm\common\services\base\CrmStatService',
        'crmField' => 'addons\Crm\common\services\field\FieldService',
        'leads' => 'addons\Crm\common\services\common\LeadsService',
        'customer' => 'addons\Crm\common\services\common\CustomerService',
        'contact' => 'addons\Crm\common\services\common\ContactService',
        'contract' => 'addons\Crm\common\services\common\ContractService',
        'supplier' => 'addons\Crm\common\services\common\SupplierService'
    ];
}