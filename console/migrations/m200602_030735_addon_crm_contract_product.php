<?php

use yii\db\Migration;

class m200602_030735_addon_crm_contract_product extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%addon_crm_contract_product}}', [
            'id' => "bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键'",
            'merchant_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '商户'",
            'store_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '门店'",
            'customer_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '客户'",
            'order_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '订单'",
            'product_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID'",
            'product_name' => "varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称'",
            'product_picture' => "varchar(200) NOT NULL DEFAULT '' COMMENT '商品图片'",
            'num' => "int(10) NOT NULL DEFAULT '0' COMMENT '数量'",
            'remark' => "varchar(2000) NOT NULL DEFAULT '' COMMENT '备注'",
            'sku_id' => "bigint(20) NOT NULL DEFAULT '0'",
            'sku_name' => "varchar(200) NOT NULL DEFAULT ''",
            'price' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格'",
            'cost_price' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '成本价格'",
            'adjust_money' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '调整价格'",
            'product_money' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '商品小计'",
            'staff_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '销售人员ID'",
            'buyer_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '购买人ID'",
            'gift_flag' => "tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '赠送标识，0：未赠送，1：赠送'",
            'delivery_status' => "tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '派工状态[0:未派工，1:已派工]'",
            'jobs_id' => "int(20) unsigned NOT NULL DEFAULT '0' COMMENT '工单ID'",
            'supplier_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '供应商ID'",
            'status' => "tinyint(2) NOT NULL DEFAULT '0'",
            'created_at' => "int(11) unsigned NULL",
            'updated_at' => "int(11) unsigned NULL",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='客户管理 - 订单产品'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%addon_crm_contract_product}}',['id'=>'1','merchant_id'=>'1','store_id'=>'0','customer_id'=>'1','order_id'=>'1','product_id'=>'12','product_name'=>'金桔小麦','product_picture'=>'','num'=>'13','remark'=>'','sku_id'=>'4','sku_name'=>'','price'=>'100.00','cost_price'=>'80.00','adjust_money'=>'0.00','product_money'=>'1300.00','staff_id'=>'1','buyer_id'=>'1','gift_flag'=>'0','delivery_status'=>'0','jobs_id'=>'0','supplier_id'=>'0','status'=>'0','created_at'=>'1590827596','updated_at'=>'1590827596']);
        $this->insert('{{%addon_crm_contract_product}}',['id'=>'2','merchant_id'=>'1','store_id'=>'0','customer_id'=>'1','order_id'=>'1','product_id'=>'23','product_name'=>'王萍面皮','product_picture'=>'','num'=>'1','remark'=>'','sku_id'=>'5','sku_name'=>'不辣','price'=>'0.00','cost_price'=>'0.00','adjust_money'=>'0.00','product_money'=>'0.00','staff_id'=>'1','buyer_id'=>'1','gift_flag'=>'0','delivery_status'=>'0','jobs_id'=>'0','supplier_id'=>'0','status'=>'0','created_at'=>'1590827596','updated_at'=>'1590827596']);
        $this->insert('{{%addon_crm_contract_product}}',['id'=>'3','merchant_id'=>'1','store_id'=>'0','customer_id'=>'1','order_id'=>'1','product_id'=>'23','product_name'=>'王萍面皮','product_picture'=>'','num'=>'1','remark'=>'','sku_id'=>'6','sku_name'=>'微辣','price'=>'0.00','cost_price'=>'0.00','adjust_money'=>'0.00','product_money'=>'0.00','staff_id'=>'1','buyer_id'=>'1','gift_flag'=>'0','delivery_status'=>'0','jobs_id'=>'0','supplier_id'=>'0','status'=>'0','created_at'=>'1590827596','updated_at'=>'1590827596']);
        $this->insert('{{%addon_crm_contract_product}}',['id'=>'4','merchant_id'=>'1','store_id'=>'0','customer_id'=>'1','order_id'=>'1','product_id'=>'23','product_name'=>'王萍面皮','product_picture'=>'','num'=>'1','remark'=>'','sku_id'=>'7','sku_name'=>'中辣','price'=>'0.00','cost_price'=>'0.00','adjust_money'=>'0.00','product_money'=>'0.00','staff_id'=>'1','buyer_id'=>'1','gift_flag'=>'0','delivery_status'=>'0','jobs_id'=>'0','supplier_id'=>'0','status'=>'0','created_at'=>'1590827596','updated_at'=>'1590827596']);
        $this->insert('{{%addon_crm_contract_product}}',['id'=>'5','merchant_id'=>'1','store_id'=>'0','customer_id'=>'1','order_id'=>'1','product_id'=>'23','product_name'=>'王萍面皮','product_picture'=>'','num'=>'1','remark'=>'','sku_id'=>'8','sku_name'=>'特辣','price'=>'0.00','cost_price'=>'0.00','adjust_money'=>'0.00','product_money'=>'0.00','staff_id'=>'1','buyer_id'=>'1','gift_flag'=>'0','delivery_status'=>'0','jobs_id'=>'0','supplier_id'=>'0','status'=>'0','created_at'=>'1590827596','updated_at'=>'1590827596']);
        $this->insert('{{%addon_crm_contract_product}}',['id'=>'6','merchant_id'=>'1','store_id'=>'0','customer_id'=>'2','order_id'=>'2','product_id'=>'12','product_name'=>'金桔小麦','product_picture'=>'','num'=>'18','remark'=>'','sku_id'=>'4','sku_name'=>'','price'=>'100.00','cost_price'=>'80.00','adjust_money'=>'0.00','product_money'=>'1800.00','staff_id'=>'1','buyer_id'=>'1','gift_flag'=>'0','delivery_status'=>'0','jobs_id'=>'0','supplier_id'=>'0','status'=>'0','created_at'=>'1590828110','updated_at'=>'1590828110']);
        $this->insert('{{%addon_crm_contract_product}}',['id'=>'7','merchant_id'=>'1','store_id'=>'0','customer_id'=>'2','order_id'=>'2','product_id'=>'23','product_name'=>'王萍面皮','product_picture'=>'','num'=>'1','remark'=>'','sku_id'=>'5','sku_name'=>'不辣','price'=>'0.00','cost_price'=>'0.00','adjust_money'=>'0.00','product_money'=>'0.00','staff_id'=>'1','buyer_id'=>'1','gift_flag'=>'0','delivery_status'=>'0','jobs_id'=>'0','supplier_id'=>'0','status'=>'0','created_at'=>'1590828110','updated_at'=>'1590828110']);
        $this->insert('{{%addon_crm_contract_product}}',['id'=>'8','merchant_id'=>'1','store_id'=>'0','customer_id'=>'3','order_id'=>'3','product_id'=>'12','product_name'=>'金桔小麦','product_picture'=>'','num'=>'1','remark'=>'','sku_id'=>'4','sku_name'=>'','price'=>'100.00','cost_price'=>'80.00','adjust_money'=>'0.00','product_money'=>'100.00','staff_id'=>'1','buyer_id'=>'1','gift_flag'=>'0','delivery_status'=>'0','jobs_id'=>'0','supplier_id'=>'0','status'=>'0','created_at'=>'1590890625','updated_at'=>'1590890625']);
        $this->insert('{{%addon_crm_contract_product}}',['id'=>'9','merchant_id'=>'1','store_id'=>'0','customer_id'=>'3','order_id'=>'3','product_id'=>'23','product_name'=>'王萍面皮','product_picture'=>'','num'=>'1','remark'=>'','sku_id'=>'5','sku_name'=>'不辣','price'=>'0.00','cost_price'=>'0.00','adjust_money'=>'0.00','product_money'=>'0.00','staff_id'=>'1','buyer_id'=>'1','gift_flag'=>'0','delivery_status'=>'0','jobs_id'=>'0','supplier_id'=>'0','status'=>'0','created_at'=>'1590890625','updated_at'=>'1590890625']);
        $this->insert('{{%addon_crm_contract_product}}',['id'=>'10','merchant_id'=>'1','store_id'=>'0','customer_id'=>'3','order_id'=>'3','product_id'=>'23','product_name'=>'王萍面皮','product_picture'=>'','num'=>'1','remark'=>'','sku_id'=>'6','sku_name'=>'微辣','price'=>'0.00','cost_price'=>'0.00','adjust_money'=>'0.00','product_money'=>'0.00','staff_id'=>'1','buyer_id'=>'1','gift_flag'=>'0','delivery_status'=>'0','jobs_id'=>'0','supplier_id'=>'0','status'=>'0','created_at'=>'1590890625','updated_at'=>'1590890625']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%addon_crm_contract_product}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

