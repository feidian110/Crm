<?php
namespace addons\Crm\merchant\controllers;

use addons\Crm\common\models\config\Field;
use Yii;

class FieldController extends BaseController
{
    public $param;

    public function actionIndex()
    {
        $type = Yii::$app->request->get('type','crm');
        $types_arr = [
            '0' => ['types' => 'leads','name' => '线索管理'],
            '1' => ['types' => 'customer','name' => '客户管理'],
            '2' => ['types' => 'contacts','name' => '联系人管理'],
            '3' => ['types' => 'product','name' => '产品管理'],
            '4' => ['types' => 'business','name' => '商机管理'],
            '5' => ['types' => 'contract','name' => '合同管理'],
            '6' => ['types' => 'receivables','name' => '回款管理'],
        ];
        $examine_types_arr = [];
        switch ($type) {
            case 'crm' : $typesArr = $types_arr; break;
            case 'examine' : $typesArr = $examine_types_arr; break;
            default : $typesArr = $types_arr; break;
        }
        foreach ($types_arr as $k=>$v) {
            $typesArr[$k]['updated_at'] = Field::find()->where(['types' => $v['types']])->orderBy('updated_at DESC')->limit(1)->all();
        }

        return $this->render( $this->action->id,[
            'model' => $typesArr
        ] );
    }

}