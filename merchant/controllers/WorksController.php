<?php
namespace addons\Crm\merchant\controllers;



use addons\Crm\common\enums\CrmTypeEnum;
use addons\Crm\common\models\works\Works;

use common\enums\StatusEnum;
use common\models\base\SearchModel;
use common\traits\MerchantCurd;
use Yii;

class WorksController extends BaseController
{
    use MerchantCurd;

    public $modelClass = Works::class;

    public $type = CrmTypeEnum::WORKS;

    public function actionIndex()
    {
        $searchModel = new SearchModel([
            'model' => $this->modelClass,
            'scenario' => 'default',
            'partialMatchAttributes' => ['title'], // 模糊查询
            'defaultOrder' => [
                'id' => SORT_DESC
            ],
            'pageSize' => $this->pageSize
        ]);

        $dataProvider = $searchModel
            ->search(Yii::$app->request->queryParams);
        $dataProvider->query
            ->where(['>=','status',StatusEnum::DISABLED])
            ->andFilterWhere(['merchant_id'=>$this->getMerchantId()]);

        return $this->render($this->action->id, [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionCreate()
    {
        $model = new Works();
        if( Yii::$app->request->isPost ){
            $post = Yii::$app->request->post();

            if( $model->create($post) ){

            }
            return $model->getErrors();
        }
        return $this->render( $this->action->id,[
            'model' =>$model,
            'sn' => Yii::$app->crmService->base->createSn($this->modelClass,$this->type),
            'storeId' => $this->getStoreId(),
            'store' => Yii::$app->storeService->store->getDropDown()
        ] );
    }
}