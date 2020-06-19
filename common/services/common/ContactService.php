<?php


namespace addons\Crm\common\services\common;


use addons\Crm\common\models\contact\Contact;
use common\components\Service;

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
}