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
        $customer = Yii::$app->crmService->customer->getCustomerByCustomerID($id);
        return $customer;
    }

}