<?php
namespace addons\Crm\common\services\common;


use addons\Crm\common\models\contract\Contract;
use addons\Crm\common\models\contract\ContractProduct;
use addons\Crm\common\models\forms\ContractQueryForm;
use addons\Store\common\enums\OrderStatusEnum;
use common\components\Service;
use common\enums\StatusEnum;
use common\helpers\AddonHelper;
use yii\data\Pagination;

class ContractService extends Service
{

    public function query(ContractQueryForm $queryForm)
    {
        $data = Contract::find()
            ->alias('o')
            ->where(['>=', 'o.status', StatusEnum::DISABLED])
            ->andFilterWhere(['o.merchant_id' => $this->getMerchantId()]);
        $pages = new Pagination([
            'totalCount' => $data->count(),
            'pageSize' => $this->pageSize,
            'validatePage' => false,
        ]);
        $models = $data->offset($pages->offset)
            ->orderBy('id desc')->with('owner')
            ->asArray()
            ->limit($pages->limit)
            ->all();

        return $models;

    }



    /**
     * 变更订单的商品合计金额
     * @param $orderId
     * @return bool|int
     */
    public function updateOrderProductPrice($orderId)
    {
        $model = $this->getOrderInfo($orderId);
        $total = $this->getContractProductTotal($orderId);
        if( $model == null ){
            return false;
        }
        if( $total == 0 ){
            return true;
        }
        return  $model::updateAll(['product_total'=>$total],['id'=>$orderId]) ? true : false;
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

    public function getContractByCustomerId($id)
    {
        $contract = Contract::find()
            ->where(['customer_id' => $id])
            ->filterWhere(['merchant_id' => $this->getMerchantId()])
            ->andFilterWhere(['>=','status',OrderStatusEnum::NOT_PAY])
            ->orderBy(['act_time' => SORT_DESC])
            ->asArray()
            ->all();
        return $contract;

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