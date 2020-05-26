<?php

namespace addons\Crm\common\models\contact;

use Yii;

/**
 * This is the model class for table "{{%addon_crm_contact_file}}".
 *
 * @property string $id 主键
 * @property string $customer_id 客户ID
 * @property string $file 文件
 * @property int $created_at 创建时间
 * @property int $updated_at 最后更新时间
 */
class ContactFile extends \common\models\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_crm_contact_file}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'created_at', 'updated_at'], 'integer'],
            [['file'], 'required'],
            [['file'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'file' => 'File',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
