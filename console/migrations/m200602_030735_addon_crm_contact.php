<?php

use yii\db\Migration;

class m200602_030735_addon_crm_contact extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%addon_crm_contact}}', [
            'id' => "bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键'",
            'leads_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '线索ID'",
            'customer_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '客户ID'",
            'merchant_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '商户ID'",
            'store_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '门店ID'",
            'is_main' => "tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '主决策人：[0:否，1:是]'",
            'creator_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '创建人'",
            'owner_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '负责人'",
            'name' => "varchar(30) NOT NULL DEFAULT '' COMMENT '联系人姓名'",
            'telephone' => "varchar(20) NOT NULL DEFAULT '' COMMENT '电话'",
            'mobile' => "varchar(20) NOT NULL DEFAULT '' COMMENT '手机号码'",
            'email' => "varchar(200) NOT NULL DEFAULT '' COMMENT '邮箱'",
            'gender' => "tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别'",
            'remark' => "varchar(2000) NOT NULL DEFAULT '' COMMENT '备注'",
            'extend' => "text NULL COMMENT '扩展'",
            'sort' => "tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '排序'",
            'status' => "tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态'",
            'created_at' => "int(11) unsigned NULL COMMENT '创建时间'",
            'updated_at' => "int(11) unsigned NULL COMMENT '最后更新时间'",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='CRM-联系人列表'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%addon_crm_contact}}',['id'=>'3','leads_id'=>'0','customer_id'=>'4','merchant_id'=>'1','store_id'=>'1','is_main'=>'0','creator_id'=>'1','owner_id'=>'1','name'=>'帐','telephone'=>'','mobile'=>'13633425522','email'=>'','gender'=>'0','remark'=>'','extend'=>NULL,'sort'=>'0','status'=>'1','created_at'=>'1590565882','updated_at'=>'1590565882']);
        $this->insert('{{%addon_crm_contact}}',['id'=>'4','leads_id'=>'0','customer_id'=>'4','merchant_id'=>'1','store_id'=>'1','is_main'=>'0','creator_id'=>'1','owner_id'=>'1','name'=>'帐','telephone'=>'','mobile'=>'13633425522','email'=>'','gender'=>'0','remark'=>'','extend'=>NULL,'sort'=>'0','status'=>'1','created_at'=>'1590565882','updated_at'=>'1590565882']);
        $this->insert('{{%addon_crm_contact}}',['id'=>'5','leads_id'=>'0','customer_id'=>'5','merchant_id'=>'1','store_id'=>'1','is_main'=>'0','creator_id'=>'1','owner_id'=>'1','name'=>'帐','telephone'=>'','mobile'=>'13633425522','email'=>'','gender'=>'0','remark'=>'','extend'=>NULL,'sort'=>'0','status'=>'1','created_at'=>'1590565924','updated_at'=>'1590565924']);
        $this->insert('{{%addon_crm_contact}}',['id'=>'6','leads_id'=>'0','customer_id'=>'6','merchant_id'=>'1','store_id'=>'1','is_main'=>'0','creator_id'=>'1','owner_id'=>'1','name'=>'帐','telephone'=>'','mobile'=>'13994247782','email'=>'','gender'=>'0','remark'=>'','extend'=>NULL,'sort'=>'0','status'=>'1','created_at'=>'1590565976','updated_at'=>'1590565976']);
        $this->insert('{{%addon_crm_contact}}',['id'=>'7','leads_id'=>'0','customer_id'=>'7','merchant_id'=>'1','store_id'=>'1','is_main'=>'0','creator_id'=>'1','owner_id'=>'1','name'=>'帐','telephone'=>'','mobile'=>'13994247782','email'=>'','gender'=>'0','remark'=>'','extend'=>NULL,'sort'=>'0','status'=>'1','created_at'=>'1590566092','updated_at'=>'1590566092']);
        $this->insert('{{%addon_crm_contact}}',['id'=>'8','leads_id'=>'0','customer_id'=>'8','merchant_id'=>'1','store_id'=>'1','is_main'=>'1','creator_id'=>'1','owner_id'=>'1','name'=>'帐','telephone'=>'','mobile'=>'13633425522','email'=>'','gender'=>'0','remark'=>'','extend'=>NULL,'sort'=>'0','status'=>'1','created_at'=>'1590566217','updated_at'=>'1590566217']);
        $this->insert('{{%addon_crm_contact}}',['id'=>'9','leads_id'=>'0','customer_id'=>'9','merchant_id'=>'1','store_id'=>'1','is_main'=>'1','creator_id'=>'1','owner_id'=>'1','name'=>'帐','telephone'=>'','mobile'=>'13994247782','email'=>'','gender'=>'0','remark'=>'','extend'=>NULL,'sort'=>'0','status'=>'1','created_at'=>'1590566580','updated_at'=>'1590566580']);
        $this->insert('{{%addon_crm_contact}}',['id'=>'10','leads_id'=>'0','customer_id'=>'10','merchant_id'=>'1','store_id'=>'1','is_main'=>'1','creator_id'=>'1','owner_id'=>'1','name'=>'吴先生','telephone'=>'','mobile'=>'1813510617','email'=>'','gender'=>'0','remark'=>'','extend'=>NULL,'sort'=>'0','status'=>'1','created_at'=>'1590566722','updated_at'=>'1590566722']);
        $this->insert('{{%addon_crm_contact}}',['id'=>'11','leads_id'=>'0','customer_id'=>'11','merchant_id'=>'1','store_id'=>'1','is_main'=>'1','creator_id'=>'1','owner_id'=>'1','name'=>'吴先生','telephone'=>'','mobile'=>'13633425522','email'=>'','gender'=>'0','remark'=>'','extend'=>NULL,'sort'=>'0','status'=>'1','created_at'=>'1590566889','updated_at'=>'1590566889']);
        $this->insert('{{%addon_crm_contact}}',['id'=>'12','leads_id'=>'0','customer_id'=>'12','merchant_id'=>'1','store_id'=>'1','is_main'=>'1','creator_id'=>'1','owner_id'=>'1','name'=>'吴先生','telephone'=>'','mobile'=>'13994247755','email'=>'','gender'=>'0','remark'=>'','extend'=>NULL,'sort'=>'0','status'=>'1','created_at'=>'1590571437','updated_at'=>'1590571437']);
        $this->insert('{{%addon_crm_contact}}',['id'=>'13','leads_id'=>'0','customer_id'=>'1','merchant_id'=>'1','store_id'=>'1','is_main'=>'1','creator_id'=>'1','owner_id'=>'1','name'=>'吴先生','telephone'=>'','mobile'=>'13633425522','email'=>'','gender'=>'0','remark'=>'','extend'=>NULL,'sort'=>'0','status'=>'1','created_at'=>'1590827523','updated_at'=>'1590827523']);
        $this->insert('{{%addon_crm_contact}}',['id'=>'14','leads_id'=>'0','customer_id'=>'2','merchant_id'=>'1','store_id'=>'1','is_main'=>'1','creator_id'=>'1','owner_id'=>'1','name'=>'王艳','telephone'=>'','mobile'=>'13994247792','email'=>'','gender'=>'0','remark'=>'','extend'=>NULL,'sort'=>'0','status'=>'1','created_at'=>'1590828008','updated_at'=>'1590828008']);
        $this->insert('{{%addon_crm_contact}}',['id'=>'15','leads_id'=>'0','customer_id'=>'3','merchant_id'=>'1','store_id'=>'1','is_main'=>'1','creator_id'=>'1','owner_id'=>'1','name'=>'吴先生','telephone'=>'','mobile'=>'13633425566','email'=>'','gender'=>'0','remark'=>'','extend'=>NULL,'sort'=>'0','status'=>'1','created_at'=>'1590890235','updated_at'=>'1590890235']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%addon_crm_contact}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

