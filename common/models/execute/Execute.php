<?php

namespace addons\Crm\common\models\execute;

use addons\Crm\common\enums\CrmTypeEnum;
use addons\Crm\common\models\contract\Contract;
use addons\Finance\common\models\base\Supplier;
use addons\Store\common\models\product\Sku;
use common\behaviors\MerchantBehavior;
use common\models\merchant\Member;
use Composer\Package\Loader\ValidatingArrayLoader;
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
 * @property string $sn 执行单编号
 * @property string $execute_date 单据时间
 * @property int $audit_status 审核状态
 * @property int $status 状态：[0:待审，1：正常，2，反审核，-1：删除]
 * @property string $act_time 活动时间
 * @property string $title 执行单标题
 * @property string $product_total 商品合计
 * @property string $price 工单金额
 * @property string $referential_amount 优惠金额
 * @property string $contact 联系人
 * @property string $contact_mobile 联系人电话
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
    use MerchantBehavior;
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
            [['customer_id', 'order_id', 'supplier_id', 'merchant_id', 'store_id', 'audit_status', 'status', 'ratio', 'creator_id', 'owner_id', 'auditor_id', 'audit_time', 'created_at', 'updated_at'], 'integer'],
            [['customer_id', 'order_id', 'supplier_id', 'price'], 'required'],
            [['execute_date', 'act_time'], 'safe'],
            [['product_total', 'price', 'referential_amount'], 'number'],
            [['sn'], 'string', 'max' => 64],
            [['title'], 'string', 'max' => 200],
            [['contact'], 'string', 'max' => 30],
            [['contact_mobile'], 'string', 'max' => 20],
            [['remark'], 'string', 'max' => 2000],
        ];
    }

    public function create($data)
    {
        $tran = Yii::$app->db->beginTransaction();
        try {
            $data['Execute']['execute_date'] = strtotime($data['Execute']['execute_date']);
            $data['Execute']['sn'] = Yii::$app->crmService->base->createSn(Execute::class,CrmTypeEnum::EXECUTE);
            $this->store_id = $data['Execute']['store_id'] ? $data['Execute']['store_id'] : Yii::$app->user->identity->store_id;
            $order = Contract::findOne($data['Execute']['order_id']);
            $this->owner_id = $order['owner_id'];
            if( !$this->load($data) || !$this->save() ){
                throw new \Exception($this->getErrors());
            }
            foreach ( $data['goods_id'] as $p =>$v ){
                $sku = Sku::findOne($p);
                $tmp = [
                    'customer_id' => $data['Execute']['customer_id'],
                    'execute_id' => $this->id,
                    'store_id' => $this->store_id,
                    'product_id' =>$sku['product_id'],
                    'product_name' => $sku['product']['name'],
                    'product_picture' => $sku['picture'],
                    'num' => $v['goods_num'],
                    'sku_id' => $sku['id'],
                    'sku_name' =>$sku['name'],
                    'price' =>$sku['price'],
                    'cost_price' =>$sku['cost_price'],
                    'product_money' => $v['goods_num'] * $sku['price'],
                    'owner_id' => $order['owner_id'],
                    'remark' => $v['note'],
                ];
                $product = new ExecuteProduct();
                $product->attributes = $tmp;
                $product->save();
            }
            if( !Yii::$app->financeService->invoice->createPayable($this) ){
                throw new \Exception('合同添加失败！');
            }
            $tran->commit();            //只有执行了commit(),对于上面数据库的操作才会真正执行
        }catch ( \Exception $e) {
            $tran->rollBack();
            return false;
        }
        return true;


    }


    public function getContract()
    {
        return $this->hasOne( Contract::class,['id' =>'order_id'] );
    }

    public function getSupplier()
    {
        return $this->hasOne( Supplier::class,['id' => 'supplier_id'] );
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
            'customer_id' => '客户信息',
            'order_id' => '订单信息',
            'supplier_id' => '供应商',
            'merchant_id' => '所属商家',
            'store_id' => '所属门店',
            'sn' => '编号',
            'execute_date' => '工单日期',
            'audit_status' => '审核状态',
            'status' => '状态',
            'act_time' => '活动时间',
            'title' => '工单标题',
            'product_total' => '项目合计',
            'price' => '金额',
            'referential_amount' => 'Referential Amount',
            'contact' => '联系人',
            'contact_mobile' => '联系电话',
            'ratio' => 'Ratio',
            'creator_id' => '创建人',
            'owner_id' => '负责人',
            'remark' => '工单备注',
            'auditor_id' => 'Auditor ID',
            'audit_time' => '审核时间',
            'created_at' => '创建时间',
            'updated_at' => 'Updated At',
        ];
    }
}
