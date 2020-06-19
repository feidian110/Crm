<?php


namespace addons\Crm\common\services\base;


use addons\Crm\common\models\base\ActionRecord;
use common\components\Service;

class ActionRecordService extends Service
{
    public function getRecordAllData($type,$actionId)
    {
        $data = ActionRecord::find()
            ->where(['types'=>$type])
            ->andWhere(['action_id' =>$actionId])->with('staff')
            ->orderBy(['created_at'=>SORT_ASC])
            ->asArray()
            ->all();
        return $data;
    }

}