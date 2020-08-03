<?php

namespace addons\Crm\common\models\customer;

use addons\Crm\common\enums\CrmTypeEnum;
use addons\Crm\common\models\contact\Contact;
use common\behaviors\MerchantBehavior;
use common\models\merchant\Member;
use Yii;

/**
 * This is the model class for table "{{%addon_crm_record}}".
 *
 * @property string $id 主键
 * @property string $customer_id 客户ID
 * @property string $merchant_id 所属商家
 * @property string $store_id 所属门店
 * @property string $contact_id 联系人ID
 * @property int $record_date 沟通时间
 * @property int $record_method 沟通方式
 * @property string $content 沟通内容
 * @property string $next_time 下次沟通时间
 * @property string $creator_id 创建人ID
 * @property string $owner_id 负责人Id
 * @property int $created_at 创建时间
 * @property int $updated_at 最后更新时间
 */
class Record extends \common\models\base\BaseModel
{
    use MerchantBehavior;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_crm_record}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contact_id', 'record_method', 'record_date'], 'required'],
            [['customer_id', 'merchant_id', 'store_id', 'contact_id',  'record_method', 'creator_id', 'owner_id', 'created_at', 'updated_at'], 'integer'],
            [['content', 'next_time'], 'string'],
        ];
    }

    public function create($data)
    {
        $data['Record']['record_date'] = strtotime($data['Record']['record_date']);
        if( $this->load($data) && $this->save(0) ){
            Yii::$app->crmService->base->updateActionLog($this->store_id,Yii::$app->user->id,CrmTypeEnum::FOLLOW,$this->id,'','','添加了跟进记录');
            return true;
        }
        return false;
    }

    public function getContact()
    {
        return $this->hasOne( Contact::class,['id' => 'contact_id'] );
    }

    public function getCreator()
    {
        return $this->hasOne( Member::class, ['id' => 'creator_id'] );
    }

    public function getOwner()
    {
        return $this->hasOne( Member::class, ['id' => 'owner_id'] );
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
            'customer_id' => 'Customer ID',
            'merchant_id' => 'Merchant ID',
            'store_id' => 'Store ID',
            'contact_id' => '联系人',
            'record_date' => '沟通时间',
            'record_method' => '沟通方式',
            'content' => '沟通内容',
            'next_time' => '下次沟通时间',
            'creator_id' => 'Creator ID',
            'owner_id' => 'Owner ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
