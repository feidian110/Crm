<?php


namespace addons\Crm\merchant\controllers;


use addons\Crm\common\enums\NatureEnum;
use addons\Crm\common\enums\SlotEnum;
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
                'id' => SORT_DESC
            ],
            'pageSize' => $this->pageSize
        ]);

        $dataProvider = $searchModel
            ->search(Yii::$app->request->queryParams);
        $dataProvider->query

            ->andFilterWhere(['merchant_id' => $this->getMerchantId()]);

        return $this->render($this->action->id, [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
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
                $arr = [
                    'key' => '66a4d093-94c2-4807-9c5c-13d11820632e',
                    'content' => ' **新增:客户信息 <font color="info">1 条</font>,详情如下：**
                                 > 时间：'.$model['act_time'].'-'.SlotEnum::getValue($model['slot']).'                 
                                 > 地点：'.$model['act_place'].'
                                 > 性质：'.NatureEnum::getValue($model['nature_id']).'
                                 > 负责人：'.$model['owner']['realname'].'
                                 > 创建人：'.$model['create']['realname'].'
                                 > 创建时间: '.date('Y-m-d H:i',$model['created_at']).'
                                 > 测试信息，不用理睬
                                 '
                ];
                Yii::$app->workService->message->markdown($arr,'customer');
                return $this->message('客户信息添加成功！', $this->redirect(['index']), 'success');
            }
            $this->message($this->getError($contact), $this->redirect(['index']), 'error');
        }
        return $this->renderAjax( $this->action->id,[
            'model' =>$model,
            'contact' => $contact
        ] );
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