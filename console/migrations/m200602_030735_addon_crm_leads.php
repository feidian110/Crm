<?php

use yii\db\Migration;

class m200602_030735_addon_crm_leads extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%addon_crm_leads}}', [
            'id' => "bigint(20) unsigned NOT NULL AUTO_INCREMENT",
            'merchant_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '所属商户'",
            'store_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '所属门店'",
            'customer_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '线索转化为客户ID'",
            'act_time' => "date NOT NULL COMMENT '活动时间'",
            'slot' => "varchar(10) NOT NULL DEFAULT '' COMMENT '时段'",
            'act_place' => "varchar(100) NOT NULL DEFAULT '' COMMENT '活动地点'",
            'nature_id' => "tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '活动性质'",
            'is_transform' => "tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1已转化'",
            'name' => "varchar(255) NOT NULL DEFAULT '' COMMENT '线索名称'",
            'source' => "varchar(500) NOT NULL DEFAULT '' COMMENT '线索来源'",
            'telephone' => "varchar(255) NOT NULL DEFAULT '' COMMENT '电话'",
            'mobile' => "varchar(255) NOT NULL DEFAULT '' COMMENT '手机'",
            'industry' => "varchar(500) NOT NULL DEFAULT '' COMMENT '客户行业'",
            'level' => "varchar(500) NOT NULL DEFAULT '' COMMENT '客户级别'",
            'detail_address' => "varchar(255) NOT NULL DEFAULT '' COMMENT '地址'",
            'remark' => "text NULL COMMENT '备注'",
            'create_id' => "int(10) unsigned NULL COMMENT '创建人ID'",
            'owner_id' => "int(10) unsigned NULL COMMENT '负责人ID'",
            'next_time' => "datetime NULL COMMENT '下次联系时间'",
            'follow' => "varchar(20) NULL COMMENT '跟进'",
            'created_at' => "int(11) unsigned NULL COMMENT '创建时间'",
            'updated_at' => "int(11) unsigned NULL COMMENT '更新时间'",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='线索表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%addon_crm_leads}}',['id'=>'1','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'0000-00-00','slot'=>'','act_place'=>'','nature_id'=>'0','is_transform'=>'0','name'=>'线索名称','source'=>'0','telephone'=>'','mobile'=>'13633425522','industry'=>'0','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>'2020-05-06 10:50:00','follow'=>NULL,'created_at'=>'1590302999','updated_at'=>'1590302999']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'2','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-05-24','slot'=>'1','act_place'=>'南厅','nature_id'=>'0','is_transform'=>'0','name'=>'2020-05-24-1-结婚-南厅','source'=>'','telephone'=>'','mobile'=>'13633425522','industry'=>'','level'=>'','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590312658','updated_at'=>'1590312658']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'3','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-06-01','slot'=>'1','act_place'=>'鸥汀','nature_id'=>'0','is_transform'=>'0','name'=>'2020-06-01-中午-结婚-鸥汀','source'=>'0','telephone'=>'','mobile'=>'13994247792','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590312779','updated_at'=>'1590312779']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'4','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-05-24','slot'=>'1','act_place'=>'南厅','nature_id'=>'0','is_transform'=>'0','name'=>'2020-05-24-中午-结婚-南厅','source'=>'','telephone'=>'','mobile'=>'13633425522','industry'=>'','level'=>'','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590548386','updated_at'=>'1590548386']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'5','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-06-01','slot'=>'1','act_place'=>'鸥汀','nature_id'=>'0','is_transform'=>'0','name'=>'2020-06-01-中午-结婚-鸥汀','source'=>'0','telephone'=>'','mobile'=>'13994247792','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590548740','updated_at'=>'1590548740']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'6','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-06-01','slot'=>'1','act_place'=>'鸥汀','nature_id'=>'0','is_transform'=>'0','name'=>'2020-06-01-中午-结婚-鸥汀','source'=>'0','telephone'=>'','mobile'=>'13994247792','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590548809','updated_at'=>'1590548809']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'7','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-06-01','slot'=>'1','act_place'=>'鸥汀','nature_id'=>'0','is_transform'=>'0','name'=>'2020-06-01-中午-结婚-鸥汀','source'=>'0','telephone'=>'','mobile'=>'13994247792','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590548837','updated_at'=>'1590548837']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'8','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-06-01','slot'=>'1','act_place'=>'鸥汀','nature_id'=>'0','is_transform'=>'0','name'=>'2020-06-01-中午-结婚-鸥汀','source'=>'0','telephone'=>'','mobile'=>'13994247792','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590548891','updated_at'=>'1590548891']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'9','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-06-01','slot'=>'1','act_place'=>'鸥汀','nature_id'=>'0','is_transform'=>'0','name'=>'2020-06-01-中午-结婚-鸥汀','source'=>'0','telephone'=>'','mobile'=>'13994247792','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590549055','updated_at'=>'1590549055']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'10','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-06-01','slot'=>'1','act_place'=>'鸥汀','nature_id'=>'0','is_transform'=>'0','name'=>'2020-06-01-中午-结婚-鸥汀','source'=>'0','telephone'=>'','mobile'=>'13994247792','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590549146','updated_at'=>'1590549146']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'11','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-06-01','slot'=>'1','act_place'=>'鸥汀','nature_id'=>'0','is_transform'=>'0','name'=>'2020-06-01-中午-结婚-鸥汀','source'=>'0','telephone'=>'','mobile'=>'13994247792','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590549191','updated_at'=>'1590549191']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'12','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-06-01','slot'=>'1','act_place'=>'鸥汀','nature_id'=>'0','is_transform'=>'0','name'=>'2020-06-01-中午-结婚-鸥汀','source'=>'0','telephone'=>'','mobile'=>'13994247792','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590549207','updated_at'=>'1590549207']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'13','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-06-01','slot'=>'2','act_place'=>'南厅','nature_id'=>'0','is_transform'=>'0','name'=>'2020-06-01-下午-结婚-南厅','source'=>'0','telephone'=>'','mobile'=>'13633425522','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590549342','updated_at'=>'1590549342']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'14','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-04-29','slot'=>'2','act_place'=>'南厅','nature_id'=>'0','is_transform'=>'0','name'=>'2020-04-29-下午-结婚-南厅','source'=>'0','telephone'=>'','mobile'=>'13633425522','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590549396','updated_at'=>'1590549396']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'15','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-06-04','slot'=>'1','act_place'=>'南厅','nature_id'=>'0','is_transform'=>'0','name'=>'2020-06-04-中午-结婚-南厅','source'=>'1','telephone'=>'','mobile'=>'13633425522','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590549448','updated_at'=>'1590549448']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'16','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-05-24','slot'=>'1','act_place'=>'南厅','nature_id'=>'0','is_transform'=>'0','name'=>'2020-05-24-中午-结婚-南厅','source'=>'1','telephone'=>'','mobile'=>'13633425522','industry'=>'','level'=>'1','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590549546','updated_at'=>'1590549546']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'17','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-05-24','slot'=>'1','act_place'=>'南厅','nature_id'=>'0','is_transform'=>'0','name'=>'2020-05-24-中午-结婚-南厅','source'=>'','telephone'=>'','mobile'=>'13633425522','industry'=>'','level'=>'','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590549995','updated_at'=>'1590549995']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'18','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-06-01','slot'=>'1','act_place'=>'南厅','nature_id'=>'0','is_transform'=>'0','name'=>'2020-06-01-中午-结婚-南厅','source'=>'1','telephone'=>'','mobile'=>'13633425522','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590550078','updated_at'=>'1590550078']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'19','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-05-24','slot'=>'1','act_place'=>'南厅','nature_id'=>'0','is_transform'=>'0','name'=>'2020-05-24-中午-结婚-南厅','source'=>'1','telephone'=>'','mobile'=>'13633425522','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590550464','updated_at'=>'1590550464']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'20','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-05-24','slot'=>'1','act_place'=>'南厅','nature_id'=>'0','is_transform'=>'0','name'=>'2020-05-24-中午-结婚-南厅','source'=>'1','telephone'=>'','mobile'=>'13633425522','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590550524','updated_at'=>'1590550524']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'21','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-05-24','slot'=>'1','act_place'=>'南厅','nature_id'=>'0','is_transform'=>'0','name'=>'2020-05-24-中午-结婚-南厅','source'=>'1','telephone'=>'','mobile'=>'13633425522','industry'=>'','level'=>'','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590550726','updated_at'=>'1590550726']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'22','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-05-24','slot'=>'1','act_place'=>'南厅','nature_id'=>'0','is_transform'=>'0','name'=>'2020-05-24-中午-结婚-南厅','source'=>'1','telephone'=>'','mobile'=>'13633425522','industry'=>'','level'=>'1','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590550903','updated_at'=>'1590550903']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'23','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-05-12','slot'=>'1','act_place'=>'鸥汀','nature_id'=>'0','is_transform'=>'0','name'=>'2020-05-12-中午-结婚-鸥汀','source'=>'1','telephone'=>'','mobile'=>'13633425522','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590551019','updated_at'=>'1590551019']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'24','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-05-28','slot'=>'1','act_place'=>'南厅','nature_id'=>'0','is_transform'=>'0','name'=>'2020-05-28-中午-结婚-南厅','source'=>'1','telephone'=>'','mobile'=>'13633425522','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590551473','updated_at'=>'1590551473']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'25','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-05-24','slot'=>'1','act_place'=>'南厅','nature_id'=>'0','is_transform'=>'0','name'=>'2020-05-24-中午-结婚-南厅','source'=>'1','telephone'=>'','mobile'=>'13633425522','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590551510','updated_at'=>'1590551510']);
        $this->insert('{{%addon_crm_leads}}',['id'=>'26','merchant_id'=>'1','store_id'=>'1','customer_id'=>'0','act_time'=>'2020-06-01','slot'=>'2','act_place'=>'南厅','nature_id'=>'0','is_transform'=>'0','name'=>'2020-06-01-下午-结婚-南厅','source'=>'0','telephone'=>'','mobile'=>'13633425522','industry'=>'','level'=>'0','detail_address'=>'','remark'=>'','create_id'=>'1','owner_id'=>'1','next_time'=>NULL,'follow'=>NULL,'created_at'=>'1590551547','updated_at'=>'1590551547']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%addon_crm_leads}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

