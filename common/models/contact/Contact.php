<?php

namespace addons\Crm\common\models\contact;

use Yii;

/**
 * This is the model class for table "{{%addon_crm_contact}}".
 *
 * @property string $id 主键
 * @property string $leads_id 线索ID
 * @property string $customer_id 客户ID
 * @property string $merchant_id 商户ID
 * @property string $store_id 门店ID
 * @property string $creater_id 创建人
 * @property string $owner_id 负责人
 * @property string $name 联系人姓名
 * @property string $telephone 电话
 * @property string $mobile 手机号码
 * @property string $email 邮箱
 * @property int $gender 性别
 * @property string $remark 备注
 * @property string $extend 扩展
 * @property int $sort 排序
 * @property int $status 状态
 * @property int $created_at 创建时间
 * @property int $updated_at 最后更新时间
 */
class Contact extends \common\models\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_crm_contact}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['leads_id', 'customer_id', 'merchant_id', 'store_id', 'creater_id', 'owner_id', 'gender', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['extend'], 'required'],
            [['extend'], 'string'],
            [['name'], 'string', 'max' => 30],
            [['telephone', 'mobile'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 200],
            [['remark'], 'string', 'max' => 2000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'leads_id' => 'Leads ID',
            'customer_id' => 'Customer ID',
            'merchant_id' => 'Merchant ID',
            'store_id' => 'Store ID',
            'creater_id' => 'Creater ID',
            'owner_id' => 'Owner ID',
            'name' => 'Name',
            'telephone' => 'Telephone',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'gender' => 'Gender',
            'remark' => 'Remark',
            'extend' => 'Extend',
            'sort' => 'Sort',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
