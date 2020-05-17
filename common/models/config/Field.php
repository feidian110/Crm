<?php

namespace addons\Crm\common\models\config;

use common\behaviors\MerchantBehavior;
use Yii;

/**
 * This is the model class for table "{{%addon_crm_field}}".
 *
 * @property string $field_id
 * @property string $merchant_id 所属商户
 * @property string $types 分类
 * @property int $types_id 分类ID（审批等）
 * @property string $field 字段名
 * @property string $name 标识名
 * @property string $form_type 字段类型
 * @property string $default_value 默认值
 * @property int $max_length  字数上限
 * @property int $is_unique 是否唯一（1是，0否）
 * @property int $is_null 是否必填（1是，0否）
 * @property string $input_tips 输入提示
 * @property string $setting 设置
 * @property int $sort 排序ID
 * @property int $operating 0改删，1改，2删，3无
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $type 薪资管理 1固定 2增加 3减少
 * @property string $relevant 相关字段名
 */
class Field extends \common\models\base\BaseModel
{
    use MerchantBehavior;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_crm_field}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'types_id', 'max_length', 'is_unique', 'is_null', 'sort', 'operating', 'created_at', 'updated_at', 'type'], 'integer'],
            [['field', 'name', 'form_type'], 'required'],
            [['setting'], 'string'],
            [['types'], 'string', 'max' => 30],
            [['field', 'name', 'relevant'], 'string', 'max' => 50],
            [['form_type'], 'string', 'max' => 20],
            [['default_value'], 'string', 'max' => 255],
            [['input_tips'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'field_id' => 'Field ID',
            'merchant_id' => 'Merchant ID',
            'types' => 'Types',
            'types_id' => 'Types ID',
            'field' => 'Field',
            'name' => 'Name',
            'form_type' => 'Form Type',
            'default_value' => 'Default Value',
            'max_length' => 'Max Length',
            'is_unique' => 'Is Unique',
            'is_null' => 'Is Null',
            'input_tips' => 'Input Tips',
            'setting' => 'Setting',
            'sort' => 'Sort',
            'operating' => 'Operating',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'type' => 'Type',
            'relevant' => 'Relevant',
        ];
    }
}
