<?php

namespace addons\Crm\common\models\works;

use common\behaviors\MerchantBehavior;
use Yii;

/**
 * This is the model class for table "{{%addon_crm_works_product}}".
 *
 * @property string $id 主键
 * @property string $merchant_id 商家
 * @property string $store_id 门店
 * @property string $customer_id 客户
 * @property string $order_id 订单
 * @property string $supplier_id 供应商
 * @property string $product_id 商品ID
 * @property string $product_name 商品名称
 * @property int $num 数量
 * @property string $sku_id SKU
 * @property string $sku_name SKU名称
 * @property string $price 商品价格
 * @property string $cost_price 成本价格
 * @property string $product_price 商品价格
 * @property string $remark 备注
 * @property string $creator_id 制单人
 * @property string $owner_id 负责人
 * @property string $aduitor_id 审核人
 * @property string $confirm_id 确认人
 * @property int $aduit_status 审核状态[0:待审核,1:已审核]
 * @property int $confirm_status 确认状态[0:待确认,1:已确认]
 * @property int $aduit_time 审核时间
 * @property int $confirm_time 确认时间
 * @property int $status 状态
 * @property int $created_at 创建时间
 * @property int $updated_at 最后更新时间
 */
class WorksProduct extends \common\models\base\BaseModel
{
    use MerchantBehavior;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_crm_works_product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'merchant_id', 'store_id', 'customer_id', 'order_id', 'supplier_id', 'product_id', 'num', 'sku_id', 'creator_id', 'owner_id', 'aduitor_id', 'confirm_id', 'aduit_status', 'confirm_status', 'aduit_time', 'confirm_time', 'status', 'created_at', 'updated_at'], 'integer'],
            [['price', 'cost_price', 'product_price'], 'number'],
            [['product_name', 'sku_name'], 'string', 'max' => 100],
            [['remark'], 'string', 'max' => 2000],
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->creator_id = Yii::$app->user->getId();
            $this->owner_id = $this->order_id ? $this->order_id : Yii::$app->user->getId();
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
            'product_id' => 'Product ID',
            'product_name' => 'Product Name',
            'num' => 'Num',
            'sku_id' => 'Sku ID',
            'sku_name' => 'Sku Name',
            'price' => 'Price',
            'cost_price' => 'Cost Price',
            'product_price' => 'Product Price',
            'remark' => 'Remark',
            'creator_id' => 'Creator ID',
            'owner_id' => 'Owner ID',
            'aduitor_id' => 'Aduitor ID',
            'confirm_id' => 'Confirm ID',
            'aduit_status' => 'Aduit Status',
            'confirm_status' => 'Confirm Status',
            'aduit_time' => 'Aduit Time',
            'confirm_time' => 'Confirm Time',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
