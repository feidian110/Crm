<?php

use yii\db\Migration;

class m200602_030735_addon_crm_target extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%addon_crm_target}}', [
            'id' => "bigint(20) unsigned NOT NULL COMMENT '主键'",
            'name' => "varchar(100) NOT NULL DEFAULT '' COMMENT '名称'",
            'obj_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '对象ID'",
            'type' => "tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '类型[1,门店2,部门3,员工]'",
            'merchant_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '商户ID'",
            'year' => "int(4) NOT NULL COMMENT '年'",
            'jan' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '一月'",
            'feb' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '二月'",
            'mar' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '三月'",
            'apr' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '四月'",
            'may' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '五月'",
            'jun' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '六月'",
            'jul' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '七月'",
            'aug' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '八月'",
            'sep' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '九月'",
            'oct' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '十月'",
            'nov' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '十一月'",
            'december' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '十二月'",
            'status' => "tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '[1,销售目标，2,回款目标]'",
            'year_target' => "decimal(20,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '年目标'",
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='客户管理-任务目标'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%addon_crm_target}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

