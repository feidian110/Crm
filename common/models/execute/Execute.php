<?php

namespace addons\Crm\common\models\execute;

use Yii;

/**
 * This is the model class for table "{{%addon_crm_execute}}".
 *
 * @property string $id 主键
 * @property string $customer_id 客户
 * @property string $order_id 订单
 * @property string $supplier_id 供应商
 * @property string $merchant_id 商家
 * @property string $store_id 门店
 * @property string $execute_date 单据时间
 * @property int $audit_status 审核状态
 * @property int $status 状态：[0:待审，1：正常，2，反审核，-1：删除]
 * @property string $act_time 活动时间
 * @property string $title 执行单标题
 * @property string $product_total 商品合计
 * @property string $price 工单金额
 * @property string $referential_amount 优惠金额
 * @property int $ratio 优惠比例
 * @property string $creator_id 制单人
 * @property string $owner_id 负责人
 * @property string $remark 备注
 * @property string $auditor_id 审核人
 * @property int $audit_time 审核回见
 * @property int $created_at 创建时间
 * @property int $updated_at 最后更新时间
 */
class Execute extends \common\models\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_crm_execute}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['execute_date', 'supplier_id', 'customer_id', 'price'],'required'],
            [['customer_id', 'order_id', 'supplier_id', 'merchant_id', 'store_id', 'audit_status', 'status', 'ratio', 'creator_id', 'owner_id', 'auditor_id', 'audit_time', 'created_at', 'updated_at'], 'integer'],
            [['execute_date', 'act_time'], 'safe'],
            [['product_total', 'price', 'referential_amount'], 'number'],
            [['title'], 'string', 'max' => 200],
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
            'customer_id' => '客户信息',
            'order_id' => '关联订单',
            'supplier_id' => '供应商',
            'merchant_id' => 'Merchant ID',
            'store_id' => '所属门店',
            'sn' => '单据编码',
            'execute_date' => '单据日期',
            'audit_status' => 'Audit Status',
            'status' => 'Status',
            'act_time' => 'Act Time',
            'title' => 'Title',
            'product_total' => '商品合计',
            'price' => '工单金额',
            'referential_amount' => 'Referential Amount',
            'ratio' => 'Ratio',
            'creator_id' => 'Creator ID',
            'owner_id' => 'Owner ID',
            'remark' => 'Remark',
            'auditor_id' => 'Auditor ID',
            'audit_time' => 'Audit Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
