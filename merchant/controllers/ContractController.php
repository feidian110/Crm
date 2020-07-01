<?php


namespace addons\Crm\merchant\controllers;


use addons\Crm\common\enums\CrmTypeEnum;
use addons\Crm\common\enums\CustomerStatusEnum;
use addons\Crm\common\models\contract\Contract;
use addons\Finance\common\enums\AuditStatusEnum;
use addons\Store\common\models\product\Sku;
use common\enums\AppEnum;
use common\enums\StatusEnum;
use common\models\base\SearchModel;

use common\traits\MerchantCurd;
use Yii;
use yii\db\Expression;

class ContractController extends BaseController
{
    use MerchantCurd;

    public $modelClass = Contract::class;

    public function actionIndex()
    {
        $searchModel = new SearchModel([
            'model' => $this->modelClass,
            'scenario' => 'default',
            'partialMatchAttributes' => ['title', 'groom_name', 'bride_name', 'company_name'], // 模糊查询
            'defaultOrder' => [
                'act_time' => SORT_DESC,
                'id' => SORT_DESC
            ],
            'pageSize' => $this->pageSize
        ]);
        $data = Yii::$app->request->get();
        $start_time = isset($data['start_time']) ? $data['start_time'] : date('Y-m-01');
        $end_time = isset($data['end_time']) ? $data['end_time'] : date( 'Y-12-31' );
        $time = isset($data['queryDate']) ? ['between','act_time',$data['start_time'],$data['end_time']] : [];
        $title = isset($data['title']) ? $data['title'] : "";
        $dataProvider = $searchModel
            ->search(Yii::$app->request->queryParams);
        $dataProvider->query
            ->where($time)
            ->andWhere($title ? ['like','title',$data['title']] : [])
            ->andWhere(['>=','status',CustomerStatusEnum::DISABLED])
            ->andFilterWhere(['merchant_id' => $this->getMerchantId()])
            ->andFilterWhere($this->getStoreId() ? [ 'store_id' =>$this->getStoreId() ] : []);

        return $this->render($this->action->id, [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'startTime' => $start_time,
            'endTime' => $end_time,
            'title' => $title
        ]);
    }

    public function actionMine()
    {

    }

    public function actionCreate()
    {
        $model = new Contract();
        if( Yii::$app->request->isPost ){
            $post = Yii::$app->request->post();
            if( $model->create($post) ){
                return $this->message('订单添加成功！', $this->redirect(['index']), 'success');
            }
            return $this->message("订单添加失败！", $this->redirect(['index']), 'error');
        }
        return $this->render( $this->action->id,[
            'model' => $model,
            'store' => Yii::$app->storeService->store->getDropDown(),
            'customer' => Yii::$app->crmService->customer->getDropDown(),
            'contract_sn' => Yii::$app->crmService->base->createSn($this->modelClass,CrmTypeEnum::CONTRACT)
        ] );
    }

    public function actionEdit()
    {

    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        return $this->render( $this->action->id,[
            'model' =>$model
        ] );
    }

    public function actionAudit()
    {
        $id = Yii::$app->request->get('id');
        $status = Yii::$app->request->get('status');
        $model = $this->findModel($id);
        $result = $model::updateAll(['audit_status' =>$status,'audit_time' => $status== AuditStatusEnum::ENABLED ? time() : null,'audit_person' => Yii::$app->user->getId() ],['id' =>$id]);
        if( $result ){
            return $this->message('状态更新成功！', $this->redirect(['view','id'=>$id]), 'success');
        }
        return $this->message("状态更新失败！", $this->redirect(['view','id'=>$id]), 'error');
    }


    public function actionPrint()
    {

    }

    public function actionExport()
    {

    }

    public function actionBatchPrint()
    {

    }

    public function actionBatchExport()
    {

    }


    public function actionSelect_products()
    {
        $product = Sku::find()
            ->where(['merchant_id'=>$this->getMerchantId()])
            ->andWhere( new Expression('FIND_IN_SET(:store, store_id)',[':store'=>0]) )
            ->andWhere(['status'=>StatusEnum::ENABLED])->with('product')
            ->asArray()->all();
        $total = Sku::find()
            ->where(['merchant_id'=>$this->getMerchantId()])
            ->andWhere(new Expression('FIND_IN_SET(:store, store_id)',[':store'=>0]))
            ->andWhere(['status'=>StatusEnum::ENABLED])->count();
        if( Yii::$app->request->isPost ){

        }
        $this->layout = "@addons/Crm/merchant/views/layouts/product";
        return $this->render( "select_products",[
            'product' => $product,
            'total' => $total
        ] );
    }
}