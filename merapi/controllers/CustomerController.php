<?php


namespace addons\Crm\merapi\controllers;


use addons\Crm\common\enums\CustomerStatusEnum;
use addons\Crm\common\models\customer\Customer;
use merapi\controllers\OnAuthController;
use Yii;

class CustomerController extends OnAuthController
{
    public $modelClass = Customer::class;

    protected $authOptional = ['index','list'];

    public function actionIndex()
    {
        $id = Yii::$app->request->get('id');
        $customer = Customer::find()->select('id,act_time,slot,act_place,nature_id')
            ->where(['id'=>$id])
            ->orderBy(['act_time'=>SORT_DESC])
            ->one();
        return $customer;
    }

    public function actionList()
    {
        $id = Yii::$app->request->post('id');
        $customer = Customer::find()->select('id,title')
            ->where(['store_id' => $id])
            ->andWhere(['between','status',CustomerStatusEnum::DISABLED,CustomerStatusEnum::EXECUTE])
            ->orderBy(['act_time'=>SORT_DESC])
            ->asArray()
            ->all();
        return $customer;
    }
}