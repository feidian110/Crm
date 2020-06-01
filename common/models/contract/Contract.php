<?php

namespace addons\Crm\common\models\contract;

use addons\Crm\common\enums\CustomerStatusEnum;
use addons\Crm\common\enums\NatureEnum;
use addons\Crm\common\enums\SlotEnum;
use addons\Crm\common\models\customer\Customer;
use addons\Store\common\models\product\Sku;
use common\behaviors\MerchantBehavior;
use common\enums\StatusEnum;
use common\models\merchant\Member;
use Yii;

/**
 * This is the model class for table "{{%addon_crm_contract}}".
 *
 * @property string $id 主键
 * @property string $merchant_id 商户
 * @property string $store_id 门店
 * @property string $customer_id 客户
 * @property string $sign_time 签订时间
 * @property string $sn 合同编码
 * @property string $title 合同标题
 * @property string $act_time 活动时间
 * @property int $slot 时段
 * @property string $act_place 活动地点
 * @property int $nature_id 活动性质
 * @property string $colour 颜色
 * @property string $theme 主题风格
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
            [['sn','sign_time','act_time','act_place', 'nature_id', 'customer_id', 'slot','groom_name', 'buyer_id', 'contract_price'], 'required'],
            [['act_time'], 'safe'],
            [['contract_price', 'product_total', 'receive_amount', 'uncollected_amount', 'self_amount', 'collect_amount'], 'number'],
            [['sn'], 'string', 'max' => 64],
            [['title'], 'string', 'max' => 200],
            [['act_place', 'colour', 'theme', 'groom_address', 'bride_address', 'company_name'], 'string', 'max' => 100],
            [['groom_name', 'bride_name', 'birthday_name'], 'string', 'max' => 30],
            [['groom_mobile', 'bride_mobile'], 'string', 'max' => 20],
            [['remark'], 'string', 'max' => 2000],
        ];
    }

    public function create($data)
    {
        $tran = Yii::$app->db->beginTransaction();
        try {
            $data['Contract']['sign_time'] = strtotime($data['Contract']['sign_time']);
            $data['Contract']['title'] = $data['Contract']['act_time'].'-'.SlotEnum::getValue($data['Contract']['slot']).'-'.$data['Contract']['act_place'].'-'.NatureEnum::getValue($data['Contract']['nature_id']);
            if( !$this->load($data) || !$this->save() ){
                throw new \Exception($this->getErrors());
            }
            foreach ( $data['goods_id'] as $p =>$v ){
                $sku = Sku::findOne($p);
                $tmp = [
                    'customer_id' => $data['Contract']['customer_id'],
                    'order_id' => $this->id,
                    'product_id' =>$sku['product_id'],
                    'product_name' => $sku['product']['name'],
                    'product_pictue' => $sku['picture'],
                    'num' => $v['goods_num'],
                    'sku_id' => $sku['id'],
                    'sku_name' =>$sku['name'],
                    'price' =>$sku['price'],
                    'cost_price' =>$sku['cost_price'],
                    'product_money' => $v['goods_num'] * $sku['price'],
                    'gift_flag' =>$v['give'],
                    'buyer_id' => $data['Contract']['buyer_id'],
                    'remark' => $v['note'],
                ];
                $product = new ContractProduct();
                $product->attributes = $tmp;
                $product->save();
            }

            if( !Yii::$app->crmService->contract->updateOrderProductPrice($this->id) ){
                throw new \Exception('商品合计金额计算失败！');
            }
            if( !Yii::$app->crmService->customer->updateStatus($data['Contract']['customer_id'],CustomerStatusEnum::SIGN)){
                throw new \Exception('客户状态更新失败！');
            }
            $tran->commit();            //只有执行了commit(),对于上面数据库的操作才会真正执行
        }catch ( \Exception $e) {
            $tran->rollBack();
            return $e->getMessage();
        }
        return true;
    }

    /**
     * 合同创建人的关联方法
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne( Member::class,['id' => 'creator_id'] );
    }
    /**
     * 负责人关联方法
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne( Member::class,['id' => 'owner_id'] );
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->creator_id = Yii::$app->user->getId();
            $this->owner_id = Yii::$app->user->getId();
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
            'customer_id' => '客户信息',
            'sign_time' => '签订时间',
            'sn' => '合同编号',
            'title' => '合同标题',
            'act_time' => '活动时间',
            'slot' => '时段',
            'act_place' => '活动地点',
            'nature_id' => '性质',
            'colour' => '色系',
            'theme' => '主题风格',
            'groom_name' => '新郎',
            'bride_name' => '新娘',
            'groom_mobile' => '新郎电话',
            'bride_mobile' => '新娘电话',
            'groom_address' => '新郎地址',
            'bride_address' => '新娘地址',
            'company_name' => '公司名称',
            'birthday_name' => 'Birthday Name',
            'contract_price' => '合同金额',
            'product_total' => '商品合计',
            'discount_ratio' => 'Discount Ratio',
            'receive_amount' => '已收金额',
            'uncollected_amount' => '未收金额',
            'self_amount' => '自收金额',
            'collect_amount' => '代收金额',
            'remark' => '合同备注',
            'creator_id' => '创建人',
            'owner_id' => '负责人',
            'buyer_id' => '用户信息',
            'sort' => '排序',
            'status' => '状态',
            'audit_status' => '审核状态',
            'audit_person' => '审核人',
            'audit_time' => '审核时间',
            'created_at' => '创建时间',
            'updated_at' => 'Updated At',
        ];
    }
}
