<?php


namespace addons\Crm\merchant\controllers;

use addons\Crm\common\models\customer\Customer;
use addons\Crm\common\models\customer\Record;
use common\traits\MerchantCurd;
use Yii;

class RecordController extends BaseController
{

    use MerchantCurd;

    public $modelClass = Record::class;

    public function actionCreate()
    {
        $customerId = Yii::$app->request->get('id');
        $model = new Record();
        $customer =  Customer::findOne($customerId);
        if( Yii::$app->request->isPost ){
            $model->customer_id = $customerId;
            $model->store_id = $customer['store_id'] ?? "";
            // ajax 校验
            $this->activeFormValidate($model);
            if( $model->create(Yii::$app->request->post()) ){
                return $this->message('信息添加成功！', $this->redirect(['customer/view','id'=>$customerId]), 'success');
            }
            return $this->message($this->getError($model), $this->redirect(['customer/view','id'=>$customerId]), 'error');
        }
        return $this->renderAjax( $this->action->id,[
            'model' => $model,
            'customer' => $customer,
            'contact' => Yii::$app->crmService->contact->getContactDropDown($customerId)
        ] );
    }

    public function actionEdit()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        $customer =  Customer::findOne($model['customer_id']);
        return $this->renderAjax( $this->action->id,[
            'model' => $model,
            'customer' => $customer,
            'contact' => Yii::$app->crmService->contact->getContactDropDown($model['customer_id'])
        ] );
    }

}