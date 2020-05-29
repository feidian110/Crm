<?php
namespace addons\Crm\common\services\common;

use addons\Crm\common\models\customer\Customer;
use common\components\Service;
use common\enums\AppEnum;
use addons\Crm\common\enums\CustomerStatusEnum;
use common\helpers\ArrayHelper;
use Yii;

class CustomerService extends  Service
{
    /**
     * 获取客户信息下拉
     * @return array
     * @throws \yii\web\UnauthorizedHttpException
     */
    public function getDropDown()
    {
        $role = Yii::$app->services->rbacAuthRole->getRole();
        if( $role['app_id'] == AppEnum::MERCHANT && $role['pid'] == 0 ){
            $customer = $this->getAllCustomer();
        }else{
            $customer = $this->getStoreAllCustomer();
        }
        return ArrayHelper::map($customer,'id','title');
    }

    /**
     * 获取门店的所有客户信息
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getStoreAllCustomer()
    {
        return Customer::find()
            ->where(['merchant_id'=>$this->getMerchantId()])
            ->andWhere(['store_id'=>0])
            ->andWhere(['between','status',CustomerStatusEnum::DISABLED,CustomerStatusEnum::ENABLED])
            ->orderBy(['act_time'=>SORT_DESC])
            ->asArray()->all();
    }

    /**
     * 获取商户所有的客户信息
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getAllCustomer()
    {
        return Customer::find()
            ->where(['merchant_id'=>$this->getMerchantId()])
            ->andWhere(['between','status',CustomerStatusEnum::DISABLED,CustomerStatusEnum::ENABLED])
            ->orderBy(['act_time'=>SORT_DESC])
            ->asArray()->all();
    }

    /**
     * 根据id获取客户信息
     * @param $id
     * @return Customer|null
     */
    public function getCustomerByCustomerID($id)
    {
        return Customer::findOne(['id' => $id,'merchant_id'=>$this->getMerchantId()]);
    }
}