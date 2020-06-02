<?php

use yii\db\Migration;

class m200602_030735_addon_crm_stat extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%addon_crm_stat}}', [
            'id' => "bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键'",
            'merchant_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '所属商家'",
            'store_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '所属门店'",
            'date' => "date NOT NULL COMMENT '日期'",
            'create_leads' => "int(11) unsigned NOT NULL DEFAULT '0' COMMENT '新增线索数量'",
            'del_leads' => "int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除线索数量'",
            'create_customer' => "int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建客户数量'",
            'del_customer' => "int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除客户数量'",
            'create_contact' => "int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建联系人数量'",
            'del_contact' => "int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除联系人数量'",
            'create_contract' => "int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建合同数量'",
            'del_contract' => "int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除合同数量'",
            'create_business' => "int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建商机数量'",
            'del_business' => "int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除商机数量'",
            'create_follow' => "int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加跟进数量'",
            'del_follow' => "int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除跟进数量'",
            'create_works' => "int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加工单数量'",
            'del_works' => "int(11) unsigned NOT NULL DEFAULT '0' COMMENT '删除工单数量'",
            'status' => "tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态'",
            'created_at' => "int(11) unsigned NULL COMMENT '创建时间'",
            'updated_at' => "int(11) unsigned NULL COMMENT '最后更新时间'",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='客户管理-数据统计'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%addon_crm_stat}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

