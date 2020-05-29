<?php

namespace addons\Crm\common\models\contract;

use addons\Crm\common\models\customer\Customer;
use common\behaviors\MerchantBehavior;
use common\enums\StatusEnum;
use Yii;

/**
 * This is the model class for table "{{%addon_crm_contract}}".
 *
 * @property string $id 主键
 * @property string $merchant_id 商户
 * @property string $store_id 门店
 * @property string $customer_id 客户
 * @property string $contract_sn 合同编码
 * @property string $title 合同标题
 * @property string $act_time 活动时间
 * @property int $slot 时段
 * @property string $act_place 活动地点
 * @property int $nature_id 活动性质
 * @property string $groom_name 新郎姓名
 * @property string $bride_name 新娘姓名
 * @property string $groom_mobile 新郎电话
 * @property string $bride_mobile 新娘电话
 * @property string $groom_address 新郎地址
 * @property string $bride_address 新娘地址
 * @property string $company_name 公司名称
 * @property string $birthday_name 寿星名称
 * @property string $contract_price 合同金额
 * @property string $product_total 商品合计
 * @property int $discount_ratio 优惠比例率
 * @property string $receive_amount 已收金额
 * @property string $uncollected_amount 未收金额
 * @property string $self_amount 自收金额
 * @property string $collect_amount 代收金额
 * @property string $remark 合同备注
 * @property string $creator_id 创建人
 * @property string $owner_id 负责人
 * @property string $buyer_id 购买人
 * @property int $sort 排序
 * @property int $status 状态[0:待执行，1:已完成，2：延期中，3:]
 * @property int $audit_status 审核状态[0:待审核，1:已审核]
 * @property string $audit_person 审核人
 * @property int $audit_time 审核时间
 * @property int $created_at 创建时间
 * @property int $updated_at 最后更新时间
 */
class Contract extends \common\models\base\BaseModel
{
    use MerchantBehavior;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_crm_contract}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'store_id', 'customer_id', 'slot', 'nature_id', 'discount_ratio', 'creator_id', 'owner_id', 'buyer_id', 'sort', 'status', 'audit_status', 'audit_person', 'audit_time', 'created_at', 'updated_at'], 'integer'],
            [['act_time'], 'required'],
            [['act_time'], 'safe'],
            [['contract_price', 'product_total', 'receive_amount', 'uncollected_amount', 'self_amount', 'collect_amount'], 'number'],
            [['contract_sn'], 'string', 'max' => 64],
            [['title'], 'string', 'max' => 200],
            [['act_place', 'groom_address', 'bride_address', 'company_name'], 'string', 'max' => 100],
            [['groom_name', 'bride_name', 'birthday_name'], 'string', 'max' => 30],
            [['groom_mobile', 'bride_mobile'], 'string', 'max' => 20],
            [['remark'], 'string', 'max' => 2000],
        ];
    }

    public function create($data)
    {

        $tran = Yii::$app->db->beginTransaction();
        try {
            $customer = Yii::$app->crmService->customer->getCustomerByCustomerID($data['Contract']['customer_id']);
            $this->act_time = $customer['act_time'];
            $this->slot = $customer['slot'];
            $this->act_place = $customer['act_place'];
            $this->nature_id = $customer['nature_id'];
            $this->title = $customer['title'];
            // $order->clause = $data['Contract']['clause'];
            if( !$this->save() ) {
                throw new \Exception($this->getErrors());
            }

            foreach ( $data['goods_id'] as $p =>$v ){
                $product = Product::findOne($p);
                $tmp = [
                    'product_id' => $p,
                    'customer_id' => $data['Contract']['customer_id'],
                    'order_id' => $this->attributes['id'],
                    'clerk_id' => $data['Contract']['clerk_id'],
                    'number' => $v['goods_num'],
                    'product_name' => $product['name'],
                    'spec' => $product['spec'],
                    'colour' => $product['colour'],
                    'unit_id' => $product['unit_id'],
                    'image' => $product['image'],
                    'price' => $product['is_sale'] == 1 ? $product['cur_price'] : $product['ori_price'],
                    'cost_price' => $product['cost_price'],
                    'give' => $v['give'],
                    'note' => $v['note'],
                ];
                $detail = new ContractProduct();
                $detail->attributes = $tmp;
                if (!$detail->save()) {
                    p($tmp);
                    throw new \Exception($detail->getErrors());
                }

            }


            $total = ContractDetail::find()->where(['order_id'=>$this->attributes['id'],'merchant_id'=>Yii::$app->user->identity->merchant_id])
                ->andWhere(['>=','status',StatusEnum::DISABLED])
                ->andWhere(['=','give',StatusEnum::DISABLED])->sum('total_price');


            $result_3 = Customer::updateAll(['status'=>CustomerStatusEnum::SIGN],['id'=>$data['Contract']['customer_id']]);
            if( !$result_3 ){
                throw new \Exception('客户信息有误，订单添加失败！');
            }
            $tran->commit();            //只有执行了commit(),对于上面数据库的操作才会真正执行
            return true;
        }catch ( \Exception $e) {

            $error = $e->getMessage();  //获取抛出的错误
            var_dump($error);die;
            $tran->rollBack();
            return false;
        }

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
            'contract_sn' => 'Contract Sn',
            'title' => 'Title',
            'act_time' => 'Act Time',
            'slot' => 'Slot',
            'act_place' => 'Act Place',
            'nature_id' => 'Nature ID',
            'groom_name' => 'Groom Name',
            'bride_name' => 'Bride Name',
            'groom_mobile' => 'Groom Mobile',
            'bride_mobile' => 'Bride Mobile',
            'groom_address' => 'Groom Address',
            'bride_address' => 'Bride Address',
            'company_name' => 'Company Name',
            'birthday_name' => 'Birthday Name',
            'contract_price' => 'Contract Price',
            'product_total' => 'Product Total',
            'discount_ratio' => 'Discount Ratio',
            'receive_amount' => 'Receive Amount',
            'uncollected_amount' => 'Uncollected Amount',
            'self_amount' => 'Self Amount',
            'collect_amount' => 'Collect Amount',
            'remark' => 'Remark',
            'creator_id' => 'Creator ID',
            'owner_id' => 'Owner ID',
            'buyer_id' => 'Buyer ID',
            'sort' => 'Sort',
            'status' => 'Status',
            'audit_status' => 'Audit Status',
            'audit_person' => 'Audit Person',
            'audit_time' => 'Audit Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
