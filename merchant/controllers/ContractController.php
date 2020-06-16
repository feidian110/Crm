<?php


namespace addons\Crm\merchant\controllers;


use addons\Crm\common\enums\CrmTypeEnum;
use addons\Crm\common\enums\CustomerStatusEnum;
use addons\Crm\common\models\contract\Contract;
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
        $role = Yii::$app->services->rbacAuthRole->getRole();
        if( $role['app_id'] == AppEnum::MERCHANT && $role['pid'] == 0 ){
            $where = [
                'merchant_id' => $this->getMerchantId(),
            ];
        }else{
            $where = [
                'merchant_id' => $this->getMerchantId(),
            ];
        }
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
            ->andFilterWhere($where);

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