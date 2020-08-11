<?php
namespace addons\Crm\merchant\controllers;



use addons\Crm\common\enums\ContractStatusEnum;
use addons\Crm\common\enums\CrmTypeEnum;
use addons\Crm\common\models\contract\Contract;
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

        $order = Contract::find()
            ->where(['merchant_id' =>$this->getMerchantId()])
            ->andWhere(['between','status',ContractStatusEnum::DISABLED,ContractStatusEnum::COMPLETE])
            ->orderBy(['act_time' => SORT_ASC])
            ->with('owner')
            ->asArray()->all();
        return $this->render($this->action->id, [
            'order' =>$order,
        ]);
    }

    public function actionList()
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
                return $this->message('派工单添加成功！', $this->redirect(['index']), 'success');
            }
            return $this->message("派工单添加失败！", $this->redirect(['index']), 'error');
        }
        return $this->render( $this->action->id,[
            'model' =>$model,
            'sn' => Yii::$app->crmService->base->createSn($this->modelClass,$this->type),
            'storeId' => $this->getStoreId(),
            'store' => Yii::$app->storeService->store->getDropDown(),

        ] );
    }

    public function actionInfo()
    {
        $id = Yii::$app->request->get('id');
        $model = Contract::find()
            ->where(['id' =>$id])
            ->andWhere(['merchant_id' =>$this->getMerchantId()])
            ->one();
        return $this->render( $this->action->id,[
            'model' =>$model
        ] );
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        return $this->renderAjax( $this->action->id,[
            'model' =>$model
        ] );
    }
}