<?php
namespace addons\Crm\common\models\base;

use yii\base\Model;

class Field extends Model
{

    /**
     * [fieldSearch 获取自定义字段高级筛选信息]
     * @author Michael_xu
     * @param $types 分类
     * @param $map  查询条件
     * @param form_type  字段类型 （’text’,’textarea’,’mobile’,’email’等）
     * @param setting  设置 （单选、下拉、多选的选项值，使用回车分隔）
     */
    public function fieldSearch($param)
    {
        $types = $param['types'];
        if (!in_array($types, $this->types_arr)) {
            $this->error = '参数错误';
            return false;
        }
        var_dump($types);die;
        $userModel = new \app\admin\model\User();
        $user_id = $param['user_id'];
        $map['types'] = ['in',['',$types]];
        $map['form_type'] = ['not in',['file','form','checkbox','structure','business_status']];
        $field_list = db('admin_field')
            ->where($map)
            ->whereOr(['types' => ''])
            ->field('field,name,form_type,setting')
            ->order('order_id asc, field_id asc, update_time desc')
            ->select();
        if (in_array($types,['crm_contract','crm_receivables'])) {
            $field_arr = [
                '0' => [
                    'field' => 'check_status',
                    'name' => '审核状态',
                    'form_type' => 'select',
                    'setting' => '待审核'.chr(10).'审核中'.chr(10).'审核通过'.chr(10).'审核失败'.chr(10).'已撤回'.chr(10).'未提交'.chr(10).'已作废'
                ]
            ];
        }
        if (in_array($param['types'],['crm_customer'])) {
            $field_arr = [
                '0' => [
                    'field' => 'address',
                    'name' => '地区定位',
                    'form_type' => 'address',
                    'setting' => []
                ]
            ];
        }
        if ($field_arr) $field_list = array_merge($field_list, $field_arr);
        foreach ($field_list as $k=>$v) {
            //处理setting内容
            $setting = [];
            if (in_array($v['form_type'], ['radio','select','checkbox'])) {
                $setting = explode(chr(10), $v['setting']);
            }
            $field_list[$k]['setting'] = $setting;
            if ($v['field'] == 'customer_id') {
                $field_list[$k]['form_type'] = 'module'; $field_list[$k]['field'] = 'customer_name';
            }
            if ($v['field'] == 'business_id') {
                $field_list[$k]['form_type'] = 'module'; $field_list[$k]['field'] = 'business_name';
            }
            if ($v['field'] == 'contract_id') {
                $field_list[$k]['form_type'] = 'module'; $field_list[$k]['field'] = 'contract_name';
            }
            if ($v['field'] == 'contacts_id') {
                $field_list[$k]['form_type'] = 'module'; $field_list[$k]['field'] = 'contacts_name';
            }

            if ($v['form_type'] == 'category') {

            } elseif ($v['form_type'] == 'business_type') {
                //商机状态组
                $businessStatusModel = new \app\crm\model\BusinessStatus();
                $userInfo = $userModel->getUserById($user_id);
                $setting = db('crm_business_type')
                    ->where(['structure_id' => $userInfo['structure_id'],'status' => 1])
                    ->whereOr('structure_id','')
                    ->select();
                foreach ($setting as $key=>$val) {
                    $setting[$key]['statusList'] = $businessStatusModel->getDataList($val['type_id'], 1);
                }
                $setting = $setting ? : [];
            }
            $field_list[$k]['setting'] = $setting;
        }
        return $field_list ? : [];
    }

    /**
     * [getField 获取字段属性]
     * @author Michael_xu
     * @param types 分类
     */
    public function getField($param)
    {
        $types = $param['types'];
        $unFormType = $param['unFormType'];
        if (!in_array($types, $this->types_arr)) {
            return resultArray(['error' => '参数错误']);
        }
        $field_arr = [];

        //模拟自定义字段返回
        switch ($types) {
            case 'admin_user' : $field_arr = \app\hrm\model\Userdet::getField(); break;
            default :
                $data = [];
                $data['types'] = $types;
                $data['user_id'] = $param['user_id'];
                if ($unFormType) $data['form_type'] = array('not in',$unFormType);
                $field_arr = $this->fieldSearch($data);
                break;
        }
        var_dump($field_arr);die;
        return $field_arr;
    }

}