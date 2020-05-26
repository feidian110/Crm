<?php


namespace addons\Crm\merchant\controllers;


use addons\Crm\common\models\customer\Customer;

use common\models\base\SearchModel;
use common\traits\MerchantCurd;
use Yii;

class CustomerController extends BaseController
{

    use MerchantCurd;

    public $modelClass = Customer::class;

    public function actionIndex()
    {

        $searchModel = new SearchModel([
            'model' => $this->modelClass,
            'scenario' => 'default',
            'partialMatchAttributes' => ['title', 'act_time'], // 模糊查询
            'defaultOrder' => [
                'id' => SORT_DESC
            ],
            'pageSize' => $this->pageSize
        ]);

        $dataProvider = $searchModel
            ->search(Yii::$app->request->queryParams);
        $dataProvider->query

            ->andFilterWhere(['merchant_id' => $this->getMerchantId()]);

        return $this->render($this->action->id, [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionAjaxEdit()
    {
        return $this->render( $this->action->id );
    }
}