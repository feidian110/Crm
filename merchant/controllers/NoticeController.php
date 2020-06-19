<?php


namespace addons\Crm\merchant\controllers;


use addons\Crm\common\models\base\WorkNotice;
use addons\Store\common\models\store\Store;
use common\enums\StatusEnum;
use common\traits\MerchantCurd;
use Yii;

class NoticeController extends BaseController
{
    use MerchantCurd;

    public $modelClass = WorkNotice::class;

    public function actionIndex()
    {
        $store = Store::find()
            ->where(['merchant_id'=>$this->getMerchantId()])
            ->andWhere(['>','status',StatusEnum::DISABLED])
            ->with('crmNotice')
            ->asArray()
            ->all();
        return $this->render( $this->action->id,[
            'model' => $store
        ] );
    }

    public function actionAjaxEdit()
    {
        $id = Yii::$app->request->get('id');
        $model = WorkNotice::findOne(['merchant_id' =>$this->getMerchantId(),'store_id' =>$id]);
        if( $model == null ){
            $model = new WorkNotice();
        }
        if( Yii::$app->request->isPost ){
            // ajax 校验
            $this->activeFormValidate($model);
            $post = Yii::$app->request->post();
            $model->store_id = $id;
            if( $model->load($post) && $model->save() ){
                return $this->message('信息更新成功！', $this->redirect(['index']), 'success');
            }
            return $this->message($this->getError($model), $this->redirect(['index']), 'error');
        }
        return $this->renderAjax( $this->action->id,[
            'model' =>$model,
        ] );
    }





}