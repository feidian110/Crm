<?php

namespace addons\Crm\common\models\contract;

use Yii;

/**
 * This is the model class for table "{{%addon_crm_contract_product}}".
 *
 * @property string $id 主键
 * @property string $merchant_id 商户
 * @property string $store_id 门店
 * @property string $customer_id 客户
 * @property string $order_id 订单
 * @property string $product_id 商品ID
 * @property string $product_name 商品名称
 * @property string $product_pictue 商品图片
 * @property int $num 数量
 * @property string $remark 备注
 * @property int $sku_id
 * @property string $sku_name
 * @property string $price 商品价格
 * @property string $cost_price 成本价格
 * @property string $adjust_money 调整价格
 * @property string $product_money 商品小计
 * @property string $staff_id 销售人员ID
 * @property string $buyer_id 购买人ID
 * @property int $gift_flag 赠送标识，0：未赠送，1：赠送
 * @property int $delivery_status 派工状态[0:未派工，1:已派工]
 * @property int $jobs_id 工单ID
 * @property string $supplier_id 供应商ID
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class ContractProduct extends \common\models\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_crm_contract_product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'store_id', 'customer_id', 'order_id', 'product_id', 'num', 'sku_id', 'staff_id', 'buyer_id', 'gift_flag', 'delivery_status', 'jobs_id', 'supplier_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['price', 'cost_price', 'adjust_money', 'product_money'], 'number'],
            [['product_name'], 'string', 'max' => 100],
            [['product_pictue', 'sku_name'], 'string', 'max' => 200],
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
            'merchant_id' => 'Merchant ID',
            'store_id' => 'Store ID',
            'customer_id' => 'Customer ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'product_name' => 'Product Name',
            'product_pictue' => 'Product Pictue',
            'num' => 'Num',
            'remark' => 'Remark',
            'sku_id' => 'Sku ID',
            'sku_name' => 'Sku Name',
            'price' => 'Price',
            'cost_price' => 'Cost Price',
            'adjust_money' => 'Adjust Money',
            'product_money' => 'Product Money',
            'staff_id' => 'Staff ID',
            'buyer_id' => 'Buyer ID',
            'gift_flag' => 'Gift Flag',
            'delivery_status' => 'Delivery Status',
            'jobs_id' => 'Jobs ID',
            'supplier_id' => 'Supplier ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
