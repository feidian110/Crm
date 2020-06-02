<?php

use yii\db\Migration;

class m200602_030735_addon_crm_customer extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%addon_crm_customer}}', [
            'id' => "bigint(200) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键'",
            'sn' => "varchar(32) NOT NULL DEFAULT '' COMMENT '客户编号'",
            'merchant_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '所属商户'",
            'store_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '所属门店'",
            'title' => "varchar(255) NOT NULL DEFAULT '' COMMENT '客户名称'",
            'act_time' => "date NOT NULL COMMENT '活动时间'",
            'slot' => "tinyint(1) unsigned NULL DEFAULT '1' COMMENT '活动时段'",
            'nature_id' => "tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性质'",
            'act_place' => "varchar(100) NOT NULL DEFAULT '' COMMENT '地点'",
            'address' => "varchar(200) NOT NULL DEFAULT '' COMMENT '地址'",
            'api_address' => "varchar(100) NOT NULL DEFAULT '' COMMENT '定位'",
            'level' => "tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '客户级别'",
            'extend' => "text NOT NULL COMMENT '扩展字段'",
            'remark' => "varchar(2000) NOT NULL DEFAULT '' COMMENT '客户备注'",
            'creator_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '创建人'",
            'banquet_manager' => "varchar(30) NOT NULL DEFAULT '' COMMENT '宴会经理'",
            'owner_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '负责人'",
            'status' => "tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态'",
            'created_at' => "int(11) unsigned NULL COMMENT '创建时间'",
            'updated_at' => "int(11) unsigned NULL COMMENT '最后更新时间'",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='crm-客户列表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%addon_crm_customer}}',['id'=>'1','sn'=>'KH_20200530100001','merchant_id'=>'1','store_id'=>'1','title'=>'2020-06-12-晚上-锦云厅回门','act_time'=>'2020-06-12','slot'=>'3','nature_id'=>'1','act_place'=>'锦云厅','address'=>'','api_address'=>'','level'=>'0','extend'=>'','remark'=>'','creator_id'=>'1','banquet_manager'=>'','owner_id'=>'1','status'=>'2','created_at'=>'1590827523','updated_at'=>'1590827523']);
        $this->insert('{{%addon_crm_customer}}',['id'=>'2','sn'=>'KH_20200530100002','merchant_id'=>'1','store_id'=>'1','title'=>'2020-06-04-中午-中厅-合办','act_time'=>'2020-06-04','slot'=>'1','nature_id'=>'2','act_place'=>'中厅','address'=>'','api_address'=>'','level'=>'0','extend'=>'','remark'=>'','creator_id'=>'1','banquet_manager'=>'','owner_id'=>'1','status'=>'2','created_at'=>'1590828008','updated_at'=>'1590828008']);
        $this->insert('{{%addon_crm_customer}}',['id'=>'3','sn'=>'KH_20200531100001','merchant_id'=>'1','store_id'=>'1','title'=>'2020-06-01-中午-中厅-结婚','act_time'=>'2020-06-01','slot'=>'1','nature_id'=>'0','act_place'=>'中厅','address'=>'','api_address'=>'','level'=>'0','extend'=>'','remark'=>'','creator_id'=>'1','banquet_manager'=>'','owner_id'=>'1','status'=>'2','created_at'=>'1590890235','updated_at'=>'1590890235']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%addon_crm_customer}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

