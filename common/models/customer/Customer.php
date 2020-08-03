<?php

namespace addons\Crm\common\models\customer;

use addons\Crm\common\enums\CrmTypeEnum;
use addons\Crm\common\enums\NatureEnum;
use addons\Crm\common\enums\SlotEnum;
use addons\Crm\common\models\base\WorkNotice;
use addons\Crm\common\models\contact\Contact;
use addons\Finance\common\models\capital\Receipt;
use addons\Store\common\models\store\Store;
use common\behaviors\MerchantBehavior;
use common\enums\StatusEnum;
use common\enums\WhetherEnum;
use common\models\merchant\Member;
use Yii;
use yii\db\Exception;

/**
 * This is the model class for table "{{%addon_crm_customer}}".
 *
 * @property string $id 主键
 * @property string $sn 客户编号
 * @property string $merchant_id 所属商户
 * @property string $store_id 所属门店
 * @property string $title 客户名称
 * @property string $act_time 活动时间
 * @property int $slot 活动时段
 * @property int $nature_id 性质
 * @property string $act_place 地点
 * @property string $address 地址
 * @property string $api_address 定位
 * @property int $level 客户级别
 * @property string $extend 扩展字段
 * @property string $remark 客户备注
 * @property string $creator_id 创建人
 * @property string $banquet_manager 宴会经理
 * @property string $owner_id 负责人
 * @property int $status 状态
 * @property int $created_at 创建时间
 * @property int $updated_at 最后更新时间
 */
class Customer extends \common\models\base\BaseModel
{
    use MerchantBehavior;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_crm_customer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'store_id', 'slot', 'nature_id', 'level', 'creator_id', 'owner_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['act_time'], 'required'],
            [['act_time'], 'safe'],
            [['extend'], 'string'],
            [['banquet_manager'], 'string','max'=>30],
            [['sn'], 'string', 'max' => 32],
            [['title'], 'string', 'max' => 255],
            [['act_place', 'api_address'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 200],
            [['remark'], 'string', 'max' => 2000],
        ];
    }

    /**
     * 客户决策人关联方法
     * @return \yii\db\ActiveQuery
     */
    public function getPolicy()
    {
        return $this->hasOne( Contact::class,['customer_id'=>'id'] )->where(['is_main'=>WhetherEnum::ENABLED]);
    }

    /**
     * 客户联系人关联方法
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasMany(Contact::class,['customer_id'=>'id']);
    }

    public function create($data)
    {
        $tran = Yii::$app->db->beginTransaction();
        try {
            $this->title = $data['Customer']['act_time'].'-'.SlotEnum::getValue($data['Customer']['slot']).'-'.$data['Customer']['act_place'].'-'.NatureEnum::getValue($data['Customer']['nature_id']);
            $this->store_id = $data['Customer']['store_id'] ? $data['Customer']['store_id'] : Yii::$app->user->identity->store_id;
            if( !$this->load($data) || !$this->save() ){
                throw new \Exception('客户信息有误，存储失败！');
            }
            $contact = new Contact();
            $contact->customer_id = $this->id;
            $contact->is_main = WhetherEnum::ENABLED;
            $contact->owner_id = $this->owner_id;
            $contact->store_id = $this->store_id;
            $contact->load($data);
            if( !$contact->save() ){
                throw new \Exception('客户信息有误，存储失败！');
            }
            Yii::$app->crmService->base->updateActionLog($this->store_id,Yii::$app->user->id,CrmTypeEnum::CUSTOMER,$this->id,'','','创建了客户');
            $notice = WorkNotice::findOne(['merchant_id'=>$this->merchant_id,'store_id'=>$this->store_id]);
            if ( $notice && $notice['open_notice']== 1 && !empty($notice['customer_key']) ){
                $arr = [
                    'key' => $notice['customer_key'],
                    'content' => ' **新增:客户信息 <font color="info">1 条</font>,详情如下：**
                                 > 时间：'.$this->act_time.'-'.SlotEnum::getValue($this->slot).'                 
                                 > 地点：'.$this->act_place.'
                                 > 性质：'.NatureEnum::getValue($this->nature_id).'
                                 > 负责人：'.$this->owner['realname'].'
                                 > 创建人：'.$this->create['realname'].'
                                 > 创建时间: '.date('Y-m-d H:i',$this->created_at).'
                                 '
                ];
                Yii::$app->workService->message->markdown($arr,'customer');
            }

            $tran->commit();
        }catch ( \Exception $e){
            //操作回滚
            $tran->rollBack();
            return $e->getMessage();
        }
        return true;
    }

    public function getCreate()
    {
        return $this->hasOne( Member::class,['id'=>'creator_id'] );
    }

    public function getOwner()
    {
        return $this->hasOne( Member::class,['id'=>'owner_id'] );
    }

    public function getStore()
    {
        return $this->hasOne( Store::class,  [ 'id' => 'store_id' ] );
    }

    public function getRecord()
    {
        return $this->hasMany( Record::class,['customer_id' => 'id'] )->orderBy(['record_date' =>SORT_DESC]);
    }

    public function getReceipt()
    {
        return $this->hasMany( Receipt::class,['customer_id' => 'id'] )->where(['>=','status',StatusEnum::DISABLED]);
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
            'sn' => '客户编号',
            'merchant_id' => 'Merchant ID',
            'store_id' => '所属门店',
            'title' => '客户名称',
            'act_time' => '活动时间',
            'slot' => '时段',
            'nature_id' => '性质',
            'act_place' => '活动地点',
            'address' => 'Address',
            'api_address' => 'Api Address',
            'level' => '级别',
            'extend' => '扩展',
            'remark' => '备注',
            'creator_id' => '创建人',
            'banquet_manager' => '宴会经理',
            'owner_id' => '负责人',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => 'Updated At',
        ];
    }
}
