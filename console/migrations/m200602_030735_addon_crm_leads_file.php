<?php

use yii\db\Migration;

class m200602_030735_addon_crm_leads_file extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%addon_crm_leads_file}}', [
            'r_id' => "int(11) NOT NULL AUTO_INCREMENT",
            'leads_id' => "int(11) NOT NULL COMMENT '线索ID'",
            'file_id' => "int(11) NOT NULL COMMENT '附件ID'",
            'PRIMARY KEY (`r_id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='线索附件关系表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%addon_crm_leads_file}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

