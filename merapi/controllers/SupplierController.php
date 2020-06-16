<?php

namespace addons\Crm\merapi\controllers;



use addons\Finance\common\models\base\Supplier;
use common\enums\StatusEnum;
use merapi\controllers\OnAuthController;
use Yii;

class SupplierController extends OnAuthController
{
    public $modelClass = Supplier::class;

    protected $authOptional = ['index','list','detail'];

    public function actionList()
    {
        $storeId = Yii::$app->request->post('id');

        $supplier = Supplier::find()->select('id,title')
            ->where(['store_id'=>$storeId])
            ->andWhere(['status'=>StatusEnum::ENABLED])
            ->asArray()
            ->all();
        return $supplier;
    }
}