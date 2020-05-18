<?php
namespace addons\Crm\common\services\field;

use addons\Crm\common\models\config\Field;
use common\components\Service;

class FieldService extends Service
{
    private $types_arr = ['leads','customer','contacts','product','business','contract','oa_examine','hrm_parroll','admin_user','receivables','receivables_plan'];

    public function getDataList($param)
    {
        $type = trim($param['types']);
        if (!in_array($type, $this->types_arr)) {
            $this->error = '参数错误';
            return false;
        }
        $map = $param;
        if ($type == 'oa_examine') {
            $map['types_id'] = $param['type_id'];
        }
        if ($param['types'] == 'customer') {
            $map['field'] = array('not in',['deal_status']);
        }

        $list = Field::find()->where($map)->orderBy(['sort'=>SORT_ASC])->asArray()->all();

        foreach ($list as $k=>$v) {
            $list[$k]['setting'] = $v['setting'] ? explode(chr(10),$v['setting']) : [];
            if ($v['form_type'] == 'checkbox') {
                $list[$k]['default_value'] = $v['default_value'] ? explode(',',$v['default_value']) : array();
            }
        }
        return $list ? : [];
    }
}