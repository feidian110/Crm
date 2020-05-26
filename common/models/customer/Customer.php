<?php

namespace addons\Crm\common\models\customer;

use addons\Crm\common\models\contact\Contact;
use common\behaviors\MerchantBehavior;
use Yii;

/**
 * This is the model class for table "{{%addon_crm_customer}}".
 *
 * @property string $id 主键
 * @property string $merchant_id 所属商户
 * @property string $sore_id 所属门店
 * @property string $title 客户名称
 * @property string $act_time 活动时间
 * @property int $slot 活动时段
 * @property int $nature_id 性质
 * @property string $act_place 地点
 * @property string $address 地址
 * @property string $api_address 定位
 * @property int $level 客户级别
 * @property string $extend 扩展字段
 * @property string $remark 客户备注
 * @property string $creator_id 创建人
 * @property string $owner_id 负责人
 * @property int $status 状态
 * @property int $created_at 创建时间
 * @property int $updated_at 最后更新时间
 */
class Customer extends \common\models\base\BaseModel
{
    use MerchantBehavior;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_crm_customer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'sore_id', 'slot', 'nature_id', 'level', 'creator_id', 'owner_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['act_time', 'extend'], 'required'],
            [['act_time'], 'safe'],
            [['extend'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['act_place', 'api_address'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 200],
            [['remark'], 'string', 'max' => 2000],
        ];
    }

    public function getContact()
    {
        return $this->hasMany( Contact::class,['customer_id'=>'id'] );
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'merchant_id' => 'Merchant ID',
            'sore_id' => 'Sore ID',
            'title' => '客户名称',
            'act_time' => '活动时间',
            'slot' => '时段',
            'nature_id' => '活动性质',
            'act_place' => '活动地点',
            'address' => 'Address',
            'api_address' => 'Api Address',
            'level' => '级别',
            'extend' => '扩展',
            'remark' => '备注',
            'creator_id' => '创建人',
            'owner_id' => '负责人',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => 'Updated At',
        ];
    }
}
