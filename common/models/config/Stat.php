<?php

namespace addons\Crm\common\models\config;

use Yii;

/**
 * This is the model class for table "{{%addon_crm_stat}}".
 *
 * @property string $id 主键
 * @property string $merchant_id 所属商家
 * @property string $store_id 所属门店
 * @property string $date 日期
 * @property int $create_leads 新增线索数量
 * @property int $del_leads 删除线索数量
 * @property int $create_customer 创建客户数量
 * @property int $del_customer 删除客户数量
 * @property int $create_contact 创建联系人数量
 * @property int $del_contact 删除联系人数量
 * @property int $create_contract 创建合同数量
 * @property int $del_contract 删除合同数量
 * @property int $create_business 创建商机数量
 * @property int $del_business 删除商机数量
 * @property int $create_follow 添加跟进数量
 * @property int $del_follow 删除跟进数量
 * @property int $create_works 添加工单数量
 * @property int $del_works 删除工单数量
 * @property int $status 状态
 * @property int $created_at 创建时间
 * @property int $updated_at 最后更新时间
 */
class Stat extends \common\models\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_crm_stat}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'store_id', 'create_leads', 'del_leads', 'create_customer', 'del_customer', 'create_contact', 'del_contact', 'create_contract', 'del_contract', 'create_business', 'del_business', 'create_follow', 'del_follow', 'create_works', 'del_works', 'status', 'created_at', 'updated_at'], 'integer'],
            [['date'], 'required'],
            [['date'], 'safe'],
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
            'date' => 'Date',
            'create_leads' => 'Create Leads',
            'del_leads' => 'Del Leads',
            'create_customer' => 'Create Customer',
            'del_customer' => 'Del Customer',
            'create_contact' => 'Create Contact',
            'del_contact' => 'Del Contact',
            'create_contract' => 'Create Contract',
            'del_contract' => 'Del Contract',
            'create_business' => 'Create Business',
            'del_business' => 'Del Business',
            'create_follow' => 'Create Follow',
            'del_follow' => 'Del Follow',
            'create_works' => 'Create Works',
            'del_works' => 'Del Works',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
