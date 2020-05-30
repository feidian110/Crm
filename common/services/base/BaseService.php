<?php
namespace addons\Crm\common\services\base;

use addons\Crm\common\enums\CrmTypeEnum;
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
        }
        return false;
    }
}