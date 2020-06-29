<?php


namespace addons\Crm\merchant\controllers;


use addons\Crm\common\enums\CrmTypeEnum;
use addons\Crm\common\models\execute\Execute;
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
            var_dump(Yii::$app->request->post());die;
        }

        return $this->render( $this->action->id,[
            'model' => $model,
            'store' => Yii::$app->storeService->store->getDropDown(),
            'sn' => Yii::$app->crmService->base->createSn($this->modelClass,CrmTypeEnum::EXECUTE)
        ] );
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