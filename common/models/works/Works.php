<?php

namespace addons\Crm\common\models\works;

use addons\Crm\common\models\contract\Contract;
use addons\Crm\common\models\contract\ContractProduct;
use addons\Crm\common\models\customer\Customer;
use addons\Finance\common\models\base\Supplier;
use common\behaviors\MerchantBehavior;
use Yii;

/**
 * This is the model class for table "{{%addon_crm_works}}".
 *
 * @property string $id 主键
 * @property string $merchant_id 商家
 * @property string $store_id 门店
 * @property string $customer_id 客户ID
 * @property string $order_id 订单ID
 * @property string $supplier_id 供应商
 * @property string $works_price 工单金额
 * @property string $product_price 商品合计
 * @property string $remark
 * @property string $creator_id 制单人
 * @property string $auditor_id 审核人
 * @property string $owner_id 负责人
 * @property int $audit_status 审核状态[0:待审核,1:已审核]
 * @property string $receive_id 接收人
 * @property int $confirm_status 确认状态
 * @property int $confirm_time 确认时间
 * @property int $audit_time 审核时间
 * @property int $sort 排序
 * @property int $status 状态
 * @property int $created_at 创建时间
 * @property int $updated_at 最后更新时间
 */
class Works extends \common\models\base\BaseModel
{
    use MerchantBehavior;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_crm_works}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['works_price'], 'required'],
            [['merchant_id', 'store_id', 'customer_id', 'order_id', 'supplier_id', 'creator_id', 'auditor_id', 'owner_id', 'audit_status', 'receive_id', 'confirm_status', 'confirm_time', 'audit_time', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['works_price', 'product_price'], 'number'],
            [['sn'], 'string','max'=>64],
            [['remark'], 'string'],
        ];
    }

    public function create($data)
    {
        if( !$this->load($data) || !$this->save() ){
        }

        foreach ( $data['product'] as $k =>$v ){
            $product = ContractProduct::findOne($v);

            $detail = new WorksProduct();
            $str = [
                'works_id' =>$this->id,
                'customer_id' =>$this->customer_id,
                'order_id' => $this->order_id,
                'product_id' => $product['product_id'],
                'store_id' =>$this->store_id,
                'supplier_id' =>$this->supplier_id,
                'product_name' => $product['product_name'],
                'num' => $product['num'],
                'sku_id' =>$product['sku_id'],
                'sku_name' => $product['sku_name'],
                'price' => $product['price'],
                'cost_price' =>$product['cost_price'],
                'product_price' => $product['product_money'],
                'remark' => $product['remark'],
            ];

            if(!$detail->load($str) || !$detail->save()){
                return $this->addErrors($detail->getErrors());
            }
        }

    }

    /**
     * 客户关联
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne( Customer::class,['id' =>'customer_id'] );
    }

    /**
     * 订单关联
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne( Contract::class,['id' => 'order_id'] );
    }

    /**
     * 供应商关联
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne( Supplier::class,['id' => 'supplier_id'] );
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
            'sn' => '工单编号',
            'merchant_id' => 'Merchant ID',
            'work_date' => '派单日期',
            'store_id' => '门店信息',
            'customer_id' => '客户信息',
            'order_id' => '订单信息',
            'supplier_id' => '供应商',
            'works_price' => '工单金额',
            'product_price' => '项目合计',
            'remark' => '工单备注',
            'creator_id' => 'Creator ID',
            'auditor_id' => 'Auditor ID',
            'owner_id' => '负责人',
            'audit_status' => 'Audit Status',
            'receive_id' => 'Receive ID',
            'confirm_status' => 'Confirm Status',
            'confirm_time' => 'Confirm Time',
            'audit_time' => 'Audit Time',
            'sort' => 'Sort',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
