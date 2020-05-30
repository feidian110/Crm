<?php


namespace addons\Crm\merapi\controllers;


use addons\Crm\common\models\customer\Customer;
use merapi\controllers\OnAuthController;
use Yii;

class CustomerController extends OnAuthController
{
    public $modelClass = Customer::class;

    protected $authOptional = ['index'];

    public function actionIndex()
    {
        $id = Yii::$app->request->get('id');
        $customer = Customer::find()->select('id,act_time,slot,act_place,nature_id')
            ->where(['id'=>$id])
            ->orderBy(['act_time'=>SORT_DESC])
            ->one();
        return $customer;
    }

}