<?php


namespace addons\Crm\merchant\controllers;


use addons\Crm\common\enums\CrmTypeEnum;
use addons\Crm\common\models\execute\Execute;
use addons\Finance\common\enums\AuditStatusEnum;
use addons\Finance\common\enums\BillTypeEnum;
use addons\Finance\common\models\report\Invoice;
use addons\Store\common\models\product\Sku;
use common\enums\StatusEnum;
use common\models\base\SearchModel;
use common\traits\MerchantCurd;
use Yii;
use yii\db\Expression;

class ExecuteController extends BaseController
{
    use MerchantCurd;

    public $modelClass = Execute::class;

    public function actionIndex()
    {
        $title = Yii::$app->request->get('title');
        $start_time = Yii::$app->request->get('start_time', date('Y-m-d', strtotime("-60 day")));
        $end_time = Yii::$app->request->get('end_time', date('Y-m-d', strtotime("+1 day")));
        $searchModel = new SearchModel([
            'model' => $this->modelClass,
            'scenario' => 'default',
            'partialMatchAttributes' => ['title'], // 模糊查询
            'defaultOrder' => [
                'act_time' => SORT_DESC,
                'id' => SORT_DESC
            ],
            'pageSize' => $this->pageSize
        ]);
        //$data = Curd::find()
        //    ->andWhere(['merchant_id' => $this->getMerchantId()])
        //    ->andFilterWhere(['like', 'title', $title])
        //    ->andFilterWhere(['between', 'created_at', strtotime($start_time), strtotime($end_time)]);
       // $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => $this->pageSize]);
       // $models = $data->offset($pages->offset)
        //    ->limit($pages->limit)
       //     ->all();
        $dataProvider = $searchModel
            ->search(Yii::$app->request->queryParams);

        $dataProvider->query
            ->andWhere(['>=','status',StatusEnum::DISABLED])
            ->andFilterWhere(['merchant_id' => $this->getMerchantId()])
            ->andFilterWhere($this->getStoreId() ? [ 'store_id' =>$this->getStoreId() ] : []);
        return $this->render($this->action->id, [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionCreate()
    {
        $model = new Execute();
        if( Yii::$app->request->isPost ){
            // ajax 校验
            $this->activeFormValidate($model);
            $post = Yii::$app->request->post();
            if( $model->create($post) ){
                return $this->message('执行单添加成功！', $this->redirect(['index']), 'success');
            }
            return $this->message("执行单添加失败！", $this->redirect(['index']), 'error');
        }

        return $this->render( $this->action->id,[
            'model' => $model,
            'store' => Yii::$app->storeService->store->getDropDown(),
            'sn' => Yii::$app->crmService->base->createSn($this->modelClass,CrmTypeEnum::EXECUTE)
        ] );
    }

    public function actionSelect_products()
    {
        $name = Yii::$app->request->post('name', "");
        $product = Sku::find()
            ->where(['merchant_id'=>$this->getMerchantId()])
            ->andWhere( new Expression('FIND_IN_SET(:store, store_id)',[':store'=>0]) )
            ->andWhere(empty($name) ? [] : ['like','product_name',$name])
            ->andWhere(['status'=>StatusEnum::ENABLED])->with('product')
            ->asArray()->all();
        $total = Sku::find()
            ->where(['merchant_id'=>$this->getMerchantId()])
            ->andWhere(new Expression('FIND_IN_SET(:store, store_id)',[':store'=>0]))
            ->andWhere(empty($name) ? [] : ['like','product_name',$name])
            ->andWhere(['status'=>StatusEnum::ENABLED])->count();
        $this->layout = "@addons/Crm/merchant/views/layouts/product";
        return $this->render( "select_products",[
            'product' => $product,
            'total' => $total,
            'name' =>$name
        ] );
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        return $this->renderAjax( $this->action->id,[
            'model'=>$model
        ] );
    }

    public function actionAudit()
    {
        $id = Yii::$app->request->get('id');
        $status = Yii::$app->request->get('status');
        $model = $this->findModel($id);
        $result = $model::updateAll(['status'=> $status,'audit_status' =>$status,'audit_time' => $status== AuditStatusEnum::ENABLED ? time() : null,'auditor_id' => Yii::$app->user->getId() ],['id' =>$id]);

        $res = Invoice::updateAll(['status' =>$status],['obj_id' =>$id, 'bill_type' => BillTypeEnum::WORKS]);
        if( $result && $res ){
            return $this->message('状态更新成功！', $this->redirect(['index']), 'success');
        }
        return $this->message("状态更新失败！", $this->redirect(['index']), 'error');
    }
}