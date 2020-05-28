<?php

namespace addons\Crm\common\models\contract;

use Yii;

/**
 * This is the model class for table "{{%addon_crm_contract}}".
 *
 * @property string $id 主键
 * @property string $merchant_id 商户
 * @property string $store_id 门店
 * @property string $customer_id 客户
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
 * @property string $birthdat_name 寿星名称
 * @property string $contract_price 合同金额
 * @property string $product_total 商品合计
 * @property int $discount_ratio 优惠比例率
 * @property string $receive_amount 已收金额
 * @property string $uncollect_amount 未收金额
 * @property string $self_amount 自收金额
 * @property string $collect_amount 代收金额
 * @property string $remark 合同备注
 * @property string $creator_id 创建人
 * @property string $owner_id 负责人
 * @property int $sort 排序
 * @property int $status 状态[0:待执行，1:已完成，2：延期中，3:]
 * @property int $audit_status 审核状态[0:待审核，1:已审核]
 * @property string $autdit_person 审核人
 * @property int $audit_time 审核时间
 * @property int $created_at 创建时间
 * @property int $updated_at 最后更新时间
 */
class Contract extends \common\models\base\BaseModel
{
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
            [['merchant_id', 'store_id', 'customer_id', 'slot', 'nature_id', 'discount_ratio', 'creator_id', 'owner_id', 'sort', 'status', 'audit_status', 'autdit_person', 'audit_time', 'created_at', 'updated_at'], 'integer'],
            [['act_time','slot', 'act_place', 'buyer_id'], 'required'],
            [['act_time'], 'safe'],
            [['contract_price', 'product_total', 'receive_amount', 'uncollect_amount', 'self_amount', 'collect_amount'], 'number'],
            [['act_place', 'groom_address', 'bride_address', 'company_name'], 'string', 'max' => 100],
            [['groom_name', 'bride_name', 'birthdat_name'], 'string', 'max' => 30],
            [['groom_mobile', 'bride_mobile'], 'string', 'max' => 20],
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
            'act_time' => '活动时间',
            'slot' => '时段',
            'act_place' => '活动地点',
            'nature_id' => '性质',
            'groom_name' => '新郎姓名',
            'bride_name' => '新娘姓名',
            'groom_mobile' => '新郎电话',
            'bride_mobile' => '新娘电话',
            'groom_address' => '新郎地址',
            'bride_address' => '新娘地址',
            'company_name' => '公司名称',
            'birthday_name' => '寿星姓名',
            'contract_price' => '合同价格',
            'product_total' => '商品合计',
            'discount_ratio' => 'Discount Ratio',
            'receive_amount' => 'Receive Amount',
            'uncollect_amount' => 'Uncollect Amount',
            'self_amount' => '自收金额',
            'collect_amount' => 'Collect Amount',
            'remark' => '合同备注',
            'creator_id' => 'Creator ID',
            'owner_id' => 'Owner ID',
            'sort' => 'Sort',
            'status' => 'Status',
            'audit_status' => 'Audit Status',
            'autdit_person' => 'Autdit Person',
            'audit_time' => 'Audit Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
