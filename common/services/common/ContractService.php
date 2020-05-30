<?php
namespace addons\Crm\common\services\common;


use addons\Crm\common\models\contract\Contract;
use addons\Crm\common\models\contract\ContractProduct;
use common\components\Service;
use common\enums\StatusEnum;

class ContractService extends Service
{
    /**
     * 变更订单的商品合计金额
     * @param $orderId
     * @return bool|int
     */
    public function updateOrderProductPrice($orderId)
    {
        $model = $this->getOrderInfo($orderId);
        $total = $this->getContractProductTotal($orderId);
        if( $model == null || $total == null ){
            return false;
        }
        return  $model::updateAll(['product_total'=>$total],['id'=>$orderId]) ?? false;
    }

    /**
     * 获取订单的商品合计金额
     * @param $orderId
     * @return bool|int|mixed|string|null
     */
    public function getContractProductTotal($orderId)
    {
        $total = ContractProduct::find()
            ->where(['order_id'=>$orderId])
            ->andWhere(['merchant_id'=>$this->getMerchantId()])
            ->andWhere(['>=','status',StatusEnum::DISABLED])
            ->sum('product_money');
        return $total;
    }

    /**
     * 获取订单信息
     * @param $orderId
     * @return array|\yii\db\ActiveRecord|null
     */
    public function getOrderInfo($orderId)
    {
        $model = Contract::find()
            ->where(['id'=>$orderId])
            ->one();
        return $model;
    }
}