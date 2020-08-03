<?php


namespace addons\Crm\common\services\common;


use addons\Crm\common\models\contact\Contact;
use common\components\Service;
use common\helpers\ArrayHelper;

class ContactService extends  Service
{
    public function getContactByCustomerId($id)
    {
        $contact = Contact::find()
            ->where(['customer_id'=>$id])
            ->filterWhere(['merchant_id'=>$this->getMerchantId()])
            ->orderBy(['is_main'=>SORT_DESC])
            ->asArray()
            ->all();
        return $contact;
    }

    public function getContactDropDown($id)
    {
        $list = $this->getNormalAllData($id);
        return ArrayHelper::map($list,'id','name');
    }

    public function getNormalAllData($id)
    {
        return Contact::find()
            ->where(['customer_id' => $id])
            ->andWhere(['merchant_id'=>$this->getMerchantId()])->asArray()->all();
    }
}