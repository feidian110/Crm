<?php


namespace addons\Crm\merchant\controllers;


use addons\Crm\common\enums\CrmTypeEnum;
use addons\Crm\common\enums\NatureEnum;
use addons\Crm\common\enums\SlotEnum;
use addons\Crm\common\enums\TimeRangeEnum;
use addons\Crm\common\models\contact\Contact;
use addons\Crm\common\models\customer\Customer;

use common\enums\WhetherEnum;
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
            ->andFilterWhere($time)
            ->andWhere($title ? ['like','title',$data['title']] : [] )
            ->andFilterWhere(['merchant_id' => $this->getMerchantId()])
            ->andFilterWhere( $this->getStoreId() ? ['store_id' => $this->getStoreId()] : []);

        return $this->render($this->action->id, [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'startTime' => $start_time,
            'endTime' => $end_time,
            'title' => $title
        ]);
    }

    public function actionAjaxEdit()
    {
        $id =  Yii::$app->request->get('id');
        $model = $this->findModel($id);
        $contact = $this->findContactModel($id);
        if( Yii::$app->request->isPost ){
            // ajax 校验
            $this->activeFormValidate($model);
            $post = Yii::$app->request->post();
            if( $model->create($post) ){

                return $this->message('客户信息添加成功！', $this->redirect(['index']), 'success');
            }
            return $this->message($this->getError($contact), $this->redirect(['index']), 'error');
        }
        return $this->renderAjax( $this->action->id,[
            'model' =>$model,
            'sn' => Yii::$app->crmService->base->createSn($this->modelClass,CrmTypeEnum::CUSTOMER),
            'store' => Yii::$app->storeService->store->getDropDown(),
            'contact' => $contact
        ] );
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        return $this->render( $this->action->id,[
            'model' =>$model,
            'contact' => Yii::$app->crmService->contact->getContactByCustomerId($id),
            'contract' => Yii::$app->crmService->contract->getContractByCustomerId($id),
            'receipt' => Yii::$app->financeService->getMerchantId(),
            'action' => Yii::$app->crmService->actionRecord->getRecordAllData(CrmTypeEnum::CUSTOMER,$id)
        ] );
    }


    /**
     * 转移客户
     * @return string
     */
    public function actionChange()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        return $this->renderAjax($this->action->id,[
            'model' =>$model,
            'staff' => Yii::$app->storeService->staff->getDropDown($model['store_id'])
        ]);
    }

    /**
     * 获取客户主要联系人信息
     * @param $id
     * @return Contact
     */
    protected function findContactModel($id)
    {
        $contact =Contact::findOne(['customer_id'=>$id,'is_main'=> WhetherEnum::ENABLED]);
        return $contact ?? new Contact();
    }
}