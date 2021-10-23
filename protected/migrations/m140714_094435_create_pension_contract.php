<?php

class m140714_094435_create_pension_contract extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_094435_create_pension_contract does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	/*public function safeUp()
	{
        $this->execute("CREATE TABLE `client_pension_contract` (
            `id`  int(11) NOT NULL AUTO_INCREMENT ,
            `client_id` int(11) NULL,
            `pension_id` int(11)  NULL,
            `contract_id`  varchar(255) NULL ,
            `contract_type`  varchar(255) NULL ,
            `insurer_id`  int(11) NULL ,
            `type`  int(11) NULL ,
            `policy_number`  varchar(255) NULL ,
            `product_name`  varchar(255) NULL ,
            `start_date`  date NULL ,
            `end_date`  date NULL ,
            `date_pension`  date NULL ,
            `years`  varchar(255) NULL ,
            `period`  int(11) NULL ,
            `values`  decimal(20,2) NULL ,
            `price`  decimal(20,2) NULL ,
            `my_kees_price`  decimal(20,2) NULL ,
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
        $this->dropTable("client_pension_contract");
	}*/

}