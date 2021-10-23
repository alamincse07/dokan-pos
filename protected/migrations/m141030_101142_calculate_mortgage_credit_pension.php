<?php

class m141030_101142_calculate_mortgage_credit_pension extends CDbMigration
{
    /*public function up()
    {
    }

    public function down()
    {
        echo "m140714_102537_create_client_mortgage_contract does not support migration down.\n";
        return false;
    }*/


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->execute("CREATE TABLE `calculate_value_of_mortgage_credit_retirement` (
        `id`  int(11) NOT NULL AUTO_INCREMENT ,
	`calculate_maximum_mortgage_multiply_value` decimal(20,2)  NULL,
        `calculate_maximum_monthly_mortgage_multiply_value` decimal(20,2) NULL,
        `height_mortgage_multiply_value`  decimal(20,2) NULL ,
        `height_mortgage_multiply_value2`  decimal(20,2) NULL ,
	`monthly_mortgage_multiply_value` decimal(20,2) NULL,
	`mortgage_amount_multiply_value` decimal(20,2) NULL,
	`mortgage_amount_multiply_value2` decimal(20,2) NULL,
	`maximum_credit_multiply_value`  decimal(20,2) NULL,
	    `maximum_monthly_credit_multiply_value`  decimal(20,2) NULL,
	    `credit_monthly_payment_multiply_value`  decimal(20,2) NULL,
        `total_pension_multiply_value`  decimal(20,2) NULL,
        `pension_wanted_multiply_value`  decimal(20,2) NULL,
        `pension_total_aow` decimal(20,2) NULL,
        `create_date`  datetime NULL ,
        `update_date`  datetime NULL ,
        `created_by`  int(11) NULL ,
        `update_by`  int(11) NULL ,
        PRIMARY KEY (`id`)
        )ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;


");
    }

    public function safeDown()
    {
        $this->dropTable("calculate_value_of_mortgage_credit_retirement");
    }

}