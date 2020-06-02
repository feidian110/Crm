<?php

use yii\db\Migration;

class m200602_030735_addon_crm_field extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%addon_crm_field}}', [
            'field_id' => "bigint(20) unsigned NOT NULL AUTO_INCREMENT",
            'merchant_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '所属商户'",
            'types' => "varchar(30) NOT NULL DEFAULT '' COMMENT '分类'",
            'types_id' => "int(11) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID（审批等）'",
            'field' => "varchar(50) NOT NULL COMMENT '字段名'",
            'name' => "varchar(50) NOT NULL COMMENT '标识名'",
            'form_type' => "varchar(20) NOT NULL COMMENT '字段类型'",
            'default_value' => "varchar(255) NOT NULL DEFAULT '' COMMENT '默认值'",
            'max_length' => "int(4) unsigned NOT NULL DEFAULT '0' COMMENT ' 字数上限'",
            'is_unique' => "tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否唯一（1是，0否）'",
            'is_null' => "tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否必填（1是，0否）'",
            'input_tips' => "varchar(100) NOT NULL DEFAULT '' COMMENT '输入提示'",
            'setting' => "text NULL COMMENT '设置'",
            'sort' => "int(4) unsigned NOT NULL DEFAULT '0' COMMENT '排序ID'",
            'operating' => "tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0改删，1改，2删，3无'",
            'created_at' => "int(11) unsigned NULL COMMENT '创建时间'",
            'updated_at' => "int(11) unsigned NULL COMMENT '更新时间'",
            'type' => "int(2) unsigned NOT NULL DEFAULT '0' COMMENT '薪资管理 1固定 2增加 3减少'",
            'relevant' => "varchar(50) NULL COMMENT '相关字段名'",
            'PRIMARY KEY (`field_id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='自定义字段表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%addon_crm_field}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

