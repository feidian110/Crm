<?php


namespace addons\Crm\merapi\modules\v1\controllers;


use addons\Crm\common\models\contract\Contract;
use addons\Crm\common\models\forms\ContractQueryForm;
use common\enums\StatusEnum;
use merapi\controllers\UserAuthController;
use Yii;
use yii\web\NotFoundHttpException;

class ContractController extends UserAuthController
{

    public $modelClass = Contract::class;

    /**
     * 无需验证的方法
     * 开发时允许，正式后删除
     * @var string[]
     */


    public function actionIndex()
    {
        $model = new ContractQueryForm();
        $model->attributes = Yii::$app->request->get();

        return Yii::$app->crmService->contract->query($model);
    }

    public function actionInfo($id)
    {
        $with = ['creator','owner','profile'];
        // 简单的查询订单基本信息
        if ($simplify = Yii::$app->request->get('simplify')) {
            $with = [];
        }

        $model = $this->modelClass::find()->where(['id' => $id])
            ->andWhere(['>=','status',StatusEnum::DISABLED])
            ->andFilterWhere(['merchant_id' => $this->getMerchantId()])
            ->with($with)
            ->asArray()
            ->one();
        if (!$model) {
            throw new NotFoundHttpException('找不到订单信息');
        }
        return $model;
    }

}