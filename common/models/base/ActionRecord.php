<?php

namespace addons\Crm\common\models\base;

use common\behaviors\MerchantBehavior;
use common\models\merchant\Member;
use Yii;

/**
 * This is the model class for table "{{%addon_crm_action_record}}".
 *
 * @property string $id 主键
 * @property string $merchant_id 商户
 * @property string $store_id 门店ID
 * @property string $staff_id 操作人员
 * @property string $action_id 操作ID
 * @property int $types 类型
 * @property string $content 内容
 * @property int $created_at 创建时间
 * @property int $updated_at 最后跟新时间
 */
class ActionRecord extends \common\models\base\BaseModel
{
    use MerchantBehavior;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_crm_action_record}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'store_id', 'staff_id', 'action_id', 'types', 'created_at', 'updated_at'], 'integer'],
            [['types'], 'required'],
            [['content'], 'string'],
        ];
    }

    public function getStaff()
    {
        return $this->hasOne( Member::class,['id'=>'staff_id'] );
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
            'staff_id' => 'Staff ID',
            'action_id' => 'Action ID',
            'types' => 'Types',
            'content' => 'Content',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
