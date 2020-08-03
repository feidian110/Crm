<?php

namespace addons\Crm\common\models\contact;

use common\behaviors\MerchantBehavior;
use common\enums\StatusEnum;
use common\enums\WhetherEnum;
use Yii;

/**
 * This is the model class for table "{{%addon_crm_contact}}".
 *
 * @property string $id 主键
 * @property string $leads_id 线索ID
 * @property string $customer_id 客户ID
 * @property string $merchant_id 商户ID
 * @property string $store_id 门店ID
 * @property int $is_main 决策人
 * @property string $creator_id 创建人
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
    use MerchantBehavior;
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
            [['leads_id', 'customer_id', 'merchant_id','is_main', 'store_id', 'creator_id', 'owner_id', 'gender', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'mobile', 'is_main'], 'required'],
            [['name'], 'string', 'max' => 30],
            [['telephone', 'mobile'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 200],
            [['remark'], 'string', 'max' => 2000],
        ];
    }

    public function create($data)
    {
        if( $data['Contact']['is_main'] == WhetherEnum::ENABLED ){
            $contact = Contact::find()
                ->where(['customer_id' =>$data['Contact']['customer_id']])
                ->andWhere(['>=','status',StatusEnum::DISABLED])
                ->one();
            if( $contact ){
                if ( !Contact::updateAll(['is_main' =>WhetherEnum::DISABLED],['id' => $contact['id'] ])){
                    return false;
                }
            }
        }
        if( $this->load($data) && $this->save() ){
            return true;
        }
        return false;
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->creator_id = Yii::$app->user->getId();
        }
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'leads_id' => '线索',
            'customer_id' => '客户',
            'merchant_id' => 'Merchant ID',
            'store_id' => 'Store ID',
            'is_main' => '主要决策人',
            'creator_id' => '创建人',
            'owner_id' => '负责人',
            'name' => '联系人',
            'telephone' => '电话号码',
            'mobile' => '手机号码',
            'email' => '电子邮箱',
            'gender' => '性别',
            'remark' => '备注',
            'extend' => 'Extend',
            'sort' => '排序',
            'status' => '状态',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
