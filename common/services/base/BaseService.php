<?php
namespace addons\Crm\common\services\base;

use addons\Crm\common\enums\CrmTypeEnum;
use addons\Crm\common\enums\TimeRangeEnum;

use addons\Crm\common\models\base\ActionRecord;
use addons\Crm\common\models\base\Field;
use common\components\Service;


class BaseService extends Service
{



    /**
     * 创建数据编号
     * @param $model
     * @param $crmType
     * @return int|string
     */
    public function createSn($model,$crmType)
    {
        $date = date('Ymd');
        $time['start'] = mktime(0, 0, 0, date('m'), date('d'), date('y'));
        $time['end'] = mktime(0, 0, 0, date('m'), date('d') + 1, date('y'))-1;

        $prefix = $this->getPrefix($crmType);
        $data = $model::find()->where(['merchant_id'=>$this->getMerchantId()])
            ->where(['between','created_at',$time['start'],$time['end']])
            ->orderBy(['created_at'=>SORT_DESC] )
            ->one();
        if( $data == null ){
            $sn = $prefix.$date.$this->getMerchantId().'00001';
        }else{
            $position = strpos($data['sn'],$prefix);
            $str = strlen($prefix);
            $count =substr_replace($data['sn'],"",$position,$str)+1;
            $sn =$prefix.$count;
        }
        return $sn;
    }


    /**
     * 获取Crm类型表单前缀
     * @param $crmType
     * @return bool|string
     */
    public function getPrefix($crmType)
    {
        switch ($crmType){
            case CrmTypeEnum::LEADS :
                return "XS_";
                break;
            case CrmTypeEnum::CUSTOMER:
                return "KH_";
                break;
            case CrmTypeEnum::BUSINESS:
                return "SJ_";
                break;
            case CrmTypeEnum::CONTACT:
                return "LXR_";
                break;
            case CrmTypeEnum::CONTRACT:
                return "HT_";
                break;
            case CrmTypeEnum::FOLLOW:
                return "GJ_";
                break;
            case CrmTypeEnum::RECEIPT:
                return "SK_";
                break;
            case CrmTypeEnum::PAY:
                return "FK_";
                break;
            case CrmTypeEnum::WORKS:
                return "GD_";
                break;
        }
        return false;
    }

    /**
     * 获取时间区间
     * @param array $TimeRange
     * @return array
     */
    public function getRange($TimeRange=[] )
    {
        $data = [];
        switch ($TimeRange){
                //今天
            case TimeRangeEnum::TODAY :
                $data['start_time'] = mktime(0,0,0,date('m'),date('d'),date('Y'));
                $data['end_time'] = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
                break;
                //本周
            case TimeRangeEnum::WEEK:
                $data['start_time'] = mktime(0,0,0,date("m"),date("d")-date("w")+1,date("Y"));
                $data['end_time'] = mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y"));
                break;
                //本月
            case TimeRangeEnum::MONTH:
                $data['start_time'] = mktime(0,0,0,date('m'),1,date('Y'));
                $data['end_time'] = mktime(23,59,59,date('m'),date('t'),date('Y'));
                break;
                //本季度
            case TimeRangeEnum::QUARTER:
                $quarter = empty($param) ? ceil((date('n'))/3) : $param;
                $data['start_time'] = mktime(0, 0, 0,$quarter*3-2,1,date('Y'));
                $data['end_time'] = mktime(0, 0, 0,$quarter*3+1,1,date('Y'))-1;
                break;
                //今年
            case TimeRangeEnum::YEAR:
                $data['start_time'] = strtotime(date('Y-01-01'));
                $data['end_time'] = strtotime(date('Y-12-31 23:59:59'));
                break;
                //昨天
            case TimeRangeEnum::YESTERDAY:
                $data['start_time'] = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
                $data['end_time'] = mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
                break;
                //上周
            case TimeRangeEnum::LAST_WEEK:
                $data['start_time'] = mktime(0,0,0,date('m'),date('d')-date('w')+1-7,date('Y'));
                $data['end_time'] = mktime(23,59,59,date('m'),date('d')-date('w')+7-7,date('Y'));
                break;
                //上月
            case TimeRangeEnum::LAST_MONTH:
                $data['start_time'] = strtotime(date('Y-m-01',strtotime('-1 month')));
                $data['end_time'] = strtotime(date('Y-m-01'))-1;
                break;
                //上季度
            case TimeRangeEnum::LAST_QUARTER:
                $quarter = empty($param) ? ceil((date('n'))/3)-1 : $param;
                $data['start_time'] = mktime(0, 0, 0,$quarter*3-2,1,date('Y'));
                $data['end_time'] = mktime(0, 0, 0,$quarter*3+1,1,date('Y'))-1;
                break;
                //去年
            case TimeRangeEnum::LAST_YEAR:
                $data['start_time'] = strtotime(date('Y-01-01',strtotime('-1 year')));
                $data['end_time'] = strtotime(date('Y-01-01'))-1;
                break;
                //明天
            case TimeRangeEnum::TOMORROW:
                $data['start_time'] = mktime(0,0,0,date('m'),date('d')+1,date('Y'));
                $data['end_time'] = mktime(0,0,0,date('m'),date('d')+2,date('Y'))-1;
                break;
                //下周
            case TimeRangeEnum::NEXT_WEEK:
                $data['start_time'] = mktime(0,0,0,date("m"),date("d")-date("w")+8,date("Y"));
                $data['end_time'] = mktime(23,59,59,date("m"),date("d")-date("w")+14,date("Y"));
                break;
                //下月
            case TimeRangeEnum::NEXT_MONTH:
                $data['start_time'] = mktime(0,0,0,date('m')+1,1,date('Y'));
                $data['end_time'] = strtotime(date('Y-m-1 23:59:59',strtotime('next month')).'+1 month -1 day');
                break;
                //下季度
            case TimeRangeEnum::NEXT_QUARTER:
                $quarter = empty($param) ? ceil((date('n'))/3)+1 : $param;
                $data['start_time'] = mktime(0, 0, 0,$quarter*3-2,1,date('Y'));
                $data['end_time'] = mktime(0, 0, 0,$quarter*3+1,1,date('Y'))-1;
                break;
                //下一年
            case TimeRangeEnum::NEXT_YEAR:
                $data['start_time'] = strtotime((date('Y',time())+1).'-01-01 00:00:00');
                $data['end_time'] = strtotime((date('Y',time())+1).'-12-31 23:59:59');
                break;
                //后天
            case  TimeRangeEnum::AFTER_DAY:
                $data['start_time'] = mktime(0,0,0,date('m'),date('d')+2,date('Y'));
                $data['end_time'] = mktime(0,0,0,date('m'),date('d')+3,date('Y'))-1;
                break;
                //前天
            case TimeRangeEnum::BEFORE_YESTERDAY:
                $data['start_time'] = mktime(0,0,0,date('m'),date('d')-2,date('Y'));
                $data['end_time'] = mktime(0,0,0,date('m'),date('d')-1,date('Y'))-1;
                break;
        }
        return $data;
    }


    public function updateActionLog($store_id,$staff_id, $types, $action_id, $oldData = [], $newData = [], $content = '')
    {
        if (is_array($oldData) && is_array($newData) && $staff_id) {
            $differentData = array_diff_assoc($newData, $oldData); //获取差异值
            $fieldModel = new Field();
            $field_arr = $fieldModel->getField(['types' => $types,'unFormType' => ['file','form']]); //获取字段属性
        }elseif ($content){
            $a = new ActionRecord();
            $a->store_id = $store_id;
            $a-> staff_id = $staff_id;
            $a-> types = $types;
            $a-> action_id = $action_id;
            $a-> content = $content;
            $a->save();
        }

    }
}