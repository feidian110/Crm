<?php


namespace addons\Crm\common\services\common;


use addons\Finance\common\models\base\Supplier;
use common\components\Service;
use common\enums\StatusEnum;
use common\helpers\ArrayHelper;

class SupplierService extends Service
{

    public function getDownEdit()
    {
        $list =Supplier::find()
            ->where(['merchant_id' =>$this->getMerchantId()])
            ->where(['=','status',StatusEnum::DISABLED])
            ->all();
        return ArrayHelper::map($list,'id' ,'title');
    }

}