<?php


namespace addons\Crm\merchant\controllers;


use addons\Crm\common\models\contract\Contract;
use common\enums\AppEnum;
use common\models\base\SearchModel;
use common\models\member\Member;
use common\traits\MerchantCurd;
use Yii;

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

        $dataProvider = $searchModel
            ->search(Yii::$app->request->queryParams);
        $dataProvider->query
            ->andFilterWhere($where);

        return $this->render($this->action->id, [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionMine()
    {

    }

    public function actionCreate()
    {
        $model = new Contract();
        return $this->render( $this->action->id,[
            'model' => $model
        ] );
    }

    public function actionEdit()
    {

    }

    public function actionView()
    {

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

    public function actionSelectProduct()
    {

    }

    public function actionSearchUser()
    {
       if( Yii::$app->request->isPost ){
           $mobile = Yii::$app->request->post('mobile');

           $member = Member::findOne(['mobile'=>$mobile]);

       }
    }
}