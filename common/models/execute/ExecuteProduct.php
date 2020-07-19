<?php

namespace addons\Crm\common\models\execute;

use common\behaviors\MerchantBehavior;
use Yii;

/**
 * This is the model class for table "{{%addon_crm_execute_product}}".
 *
 * @property string $id 主键
 * @property string $merchant_id 商户
 * @property string $store_id 门店
 * @property string $customer_id 客户
 * @property string $order_id 订单
 * @property string $supplier_id 供应商ID
 * @property string $execute_id 工单ID
 * @property string $product_id 商品ID
 * @property string $product_name 商品名称
 * @property int $sku_id
 * @property string $sku_name
 * @property string $product_picture 商品图片
 * @property int $num 数量
 * @property string $price 商品价格
 * @property string $product_money 商品小计
 * @property string $remark 备注
 * @property string $creator_id 制单人
 * @property string $owner_id 销售人员ID
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class ExecuteProduct extends \common\models\base\BaseModel
{
    use MerchantBehavior;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_crm_execute_product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'store_id', 'customer_id', 'order_id', 'supplier_id', 'execute_id', 'product_id', 'sku_id', 'num', 'creator_id', 'owner_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['price', 'product_money'], 'number'],
            [['product_name'], 'string', 'max' => 100],
            [['sku_name', 'product_picture'], 'string', 'max' => 200],
            [['remark'], 'string', 'max' => 2000],
        ];
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
            'merchant_id' => 'Merchant ID',
            'store_id' => 'Store ID',
            'customer_id' => 'Customer ID',
            'order_id' => 'Order ID',
            'supplier_id' => 'Supplier ID',
            'execute_id' => 'Execute ID',
            'product_id' => 'Product ID',
            'product_name' => 'Product Name',
            'sku_id' => 'Sku ID',
            'sku_name' => 'Sku Name',
            'product_picture' => 'Product Picture',
            'num' => 'Num',
            'price' => 'Price',
            'product_money' => 'Product Money',
            'remark' => 'Remark',
            'creator_id' => 'Creator ID',
            'owner_id' => 'Owner ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
