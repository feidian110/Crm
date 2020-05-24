<?php

namespace addons\Crm\common\models\leads;

use common\behaviors\MerchantBehavior;
use common\models\merchant\Member;
use Yii;

/**
 * This is the model class for table "{{%addon_crm_leads}}".
 *
 * @property string $id
 * @property string $merchant_id 所属商户
 * @property string $store_id 所属门店
 * @property string $customer_id 线索转化为客户ID
 * @property string $act_time 活动时间
 * @property string $slot 时段
 * @property string $act_place 活动地点
 * @property int $nature_id 活动性质
 * @property int $is_transform 1已转化
 * @property string $name 线索名称
 * @property string $source 线索来源
 * @property string $telephone 电话
 * @property string $mobile 手机
 * @property string $industry 客户行业
 * @property string $level 客户级别
 * @property string $detail_address 地址
 * @property string $remark 备注
 * @property int $create_id 创建人ID
 * @property int $owner_id 负责人ID
 * @property string $next_time 下次联系时间
 * @property string $follow 跟进
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class Leads extends \common\models\base\BaseModel
{
    use MerchantBehavior;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_crm_leads}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['act_time', 'slot','act_place','nature_id','mobile'],'required'],
            [['merchant_id', 'store_id', 'customer_id', 'nature_id', 'is_transform', 'create_id', 'owner_id', 'created_at', 'updated_at'], 'integer'],
            [['act_time'], 'required'],
            [['act_time', 'next_time'], 'safe'],
            [['remark'], 'string'],
            [['slot'], 'string', 'max' => 10],
            [['act_place'], 'string', 'max' => 100],
            [['name', 'telephone', 'mobile', 'detail_address'], 'string', 'max' => 255],
            [['source', 'industry', 'level'], 'string', 'max' => 500],
            [['follow'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getCreate()
    {
        return $this->hasOne( Member::class,['id'=>'create_id'] );
    }

    public function getOwner()
    {
        return $this->hasOne( Member::class,['id'=>'owner_id'] );
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'merchant_id' => '所属商户',
            'store_id' => '所属门店',
            'customer_id' => '客户ID',
            'act_time' => '活动时间',
            'slot' => '时段',
            'act_place' => '活动地点',
            'nature_id' => '性质',
            'is_transform' => '是否转化',
            'name' => '线索名称',
            'source' => '线索来源',
            'telephone' => '电话号码',
            'mobile' => '手机号码',
            'industry' => '所属行业',
            'level' => '客户级别',
            'detail_address' => '详细地址',
            'remark' => '备注',
            'create_id' => '创建人',
            'owner_id' => '负责人',
            'next_time' => '下次沟通时间',
            'follow' => '跟进',
            'created_at' => '创建时间',
            'updated_at' => '最后更新时间',
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->create_id = Yii::$app->user->getId();
            $this->owner_id = Yii::$app->user->getId();
            $this->store_id = 1;
        }
        return parent::beforeSave($insert);
    }
}
