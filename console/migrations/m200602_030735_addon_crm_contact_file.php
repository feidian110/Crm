<?php

use yii\db\Migration;

class m200602_030735_addon_crm_contact_file extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%addon_crm_contact_file}}', [
            'id' => "bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键'",
            'customer_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '客户ID'",
            'file' => "text NOT NULL COMMENT '文件'",
            'created_at' => "int(11) unsigned NULL COMMENT '创建时间'",
            'updated_at' => "int(11) unsigned NULL COMMENT '最后更新时间'",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='CRM-联系人附件'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%addon_crm_contact_file}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

