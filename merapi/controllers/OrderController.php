<?php


namespace addons\Crm\merapi\controllers;


use addons\Crm\common\enums\ContractStatusEnum;
use addons\Crm\common\enums\ExecuteStatueEnum;
use addons\Crm\common\models\contract\Contract;
use addons\Crm\common\models\contract\ContractProduct;
use merapi\controllers\OnAuthController;
use Yii;

class OrderController extends OnAuthController
{
    public $modelClass = Contract::class;

    protected $authOptional = ['index','list','detail'];

    public function actionList()
    {
        $id = Yii::$app->request->post('id');
        $order = Contract::find()->select('id,title')
            ->where(['customer_id'=>$id])
            ->andWhere(['<','execute_status',ExecuteStatueEnum::ENABLED])
            ->andWhere(['between','status',ContractStatusEnum::DISABLED,ContractStatusEnum::DELAY])
            ->asArray()
            ->all();
        return $order;
    }

    public function actionDetail()
    {
        $storeId = Yii::$app->request->post('storeId');
        $orderId = Yii::$app->request->post('orderId');
        $detail = ContractProduct::find()
            ->where(['store_id'=>$storeId,'order_id'=>$orderId])
            ->andWhere(['between','status',ContractStatusEnum::DISABLED,ContractStatusEnum::WORKS])
            ->asArray()
            ->all();
        return $detail;
    }
}