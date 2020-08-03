<?php


namespace addons\Crm\merchant\controllers;


use addons\Crm\common\models\contact\Contact;
use common\traits\MerchantCurd;
use Yii;

class ContactController extends BaseController
{
    use MerchantCurd;

    public $modelClass = Contact::class;

    public function actionIndex()
    {
        return $this->render( $this->action->id );
    }

    public function actionCreate()
    {
        $customerId = Yii::$app->request->get('id','');
        $model = new Contact();
        $customer = Yii::$app->crmService->customer->getNormalAllDataDropdown();
        if( Yii::$app->request->isPost ){
            // ajax 校验
            $this->activeFormValidate($model);
            if( $model->create(Yii::$app->request->post()) ){
                if( $customerId ){
                    return $this->message('联系人添加成功！', $this->redirect(['customer/view','id'=>$customerId]), 'success');
                }
                return $this->message('联系人添加成功！', $this->redirect(['index']), 'success');
            }
            if( $customerId ){
                return $this->message($this->getError($model), $this->redirect(['customer/view','id'=>$customerId]), 'error');
            }
            return $this->message($this->getError($model), $this->redirect(['index']), 'error');
        }
        return $this->renderAjax( $this->action->id,[
            'customerId' => $customerId,
            'model' => $model,
            'customer' => $customer
        ] );
    }
}