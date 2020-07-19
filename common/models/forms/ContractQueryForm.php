<?php
namespace addons\Crm\common\models\forms;

use yii\base\Model;

class ContractQueryForm extends Model
{
    public $synthesize_status = '';
    public $order_type = '';
    public $start_time = '';
    public $end_time = '';
    public $order_sn;
    public $member_id;

    /**
     * @return array
     */
    public function rules()
{
    return [
        [['order_type', 'sn'], 'string'],
        [['member_id', 'start_time', 'end_time', 'synthesize_status'], 'integer'],
    ];
}
}