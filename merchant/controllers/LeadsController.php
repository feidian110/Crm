<?php
namespace addons\Crm\merchant\controllers;

use addons\Crm\common\enums\NatureEnum;
use addons\Crm\common\models\leads\Leads;
use addons\Crm\common\enums\SlotEnum;
use common\models\base\SearchModel;
use common\traits\MerchantCurd;
use Yii;

class LeadsController extends BaseController
{
    use MerchantCurd;

    public $modelClass = Leads::class;

    public function actionIndex()
    {

        $searchModel = new SearchModel([
            'model' => $this->modelClass,
            'scenario' => 'default',
            'partialMatchAttributes' => ['name', 'mobile'], // 模糊查询
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
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        if( Yii::$app->request->isPost ){
            $data = Yii::$app->request->post();
            $model-> name = $data['Leads']['act_time'].'-'.SlotEnum::getValue($data['Leads']['slot']).'-'.NatureEnum::getValue($data['Leads']['nature_id']).'-'.$data['Leads']['act_place'];
            // ajax 校验
            $this->activeFormValidate($model);
            if( $model->load(Yii::$app->request->post()) && $model->save() ){
                $arr = [
                    'key' => 'a6e4d145-a4ed-4d05-b8f4-4a380ea62031',
                    'content' => ' **新增：线索信息 <font color="info">1 条</font>，详情：**
                                 > 时间：'.$model['act_time'].'-'.SlotEnum::getValue($model['slot']).'                 
                                 > 地点：'.$model['act_place'].'
                                 > 性质：'.NatureEnum::getValue($model['nature_id']).'
                                 > 负责人：'.$model['owner']['realname'].'
                                 > 创建人:'.$model['create']['realname'].'
                                 > 创建时间: '.date('Y-m-d H:i',$model['created_at']).'
                                 '
                ];
                Yii::$app->workService->message->markdown($arr,'customer');
                return $this->message('线索添加成功！', $this->redirect(['index']), 'success');
            }
            return $this->message($this->getError($model), $this->redirect(['index']), 'error');
        }
        return $this->renderAjax( $this->action->id,[
            'model' =>$model
        ] );
    }
}