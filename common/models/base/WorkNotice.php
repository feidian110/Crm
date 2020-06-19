<?php

namespace addons\Crm\common\models\base;

use common\behaviors\MerchantBehavior;
use Yii;

/**
 * This is the model class for table "{{%addon_crm_work_notice}}".
 *
 * @property string $id 主键
 * @property string $merchant_id 商家
 * @property string $store_id 门店
 * @property int $open_notice 开启企业微信通知[0：关闭,1:开启]
 * @property string $leads_key 线索webhook地址
 * @property string $contact_key 联系人webhook地址
 * @property string $customer_key 客户webhook地址
 * @property string $contract_key 合同webhook地址
 * @property string $receipt_key 收款webhook地址
 * @property string $record_key 跟进记录webhook地址
 * @property string $work_key 工单webhook地址
 * @property string $payment_key 付款webhook地址
 * @property int $created_at 创建时间
 * @property int $updated_at 最后更新时间
 */
class WorkNotice extends \common\models\base\BaseModel
{
    use MerchantBehavior;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_crm_work_notice}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'store_id', 'open_notice', 'created_at', 'updated_at'], 'integer'],
            [['leads_key', 'contact_key', 'customer_key', 'contract_key', 'receipt_key', 'record_key', 'work_key', 'payment_key'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'merchant_id' => 'Merchant ID',
            'store_id' => 'Store ID',
            'open_notice' => '消息通知',
            'leads_key' => '线索通知',
            'contact_key' => '联系人通知',
            'customer_key' => '客户通知',
            'contract_key' => '合同通知',
            'receipt_key' => '收款通知',
            'record_key' => '跟进通知',
            'work_key' => '工单通知',
            'payment_key' => '付款通知',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
