<?php

class m140714_072538_create_client_savings extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_072538_create_client_savings does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("CREATE TABLE `client_savings` (
        `id`  int(11) NOT NULL AUTO_INCREMENT ,
        `client_id`   int(11) NULL ,
        `customer_group`  int(11) NULL ,
        `type`  int(11) NULL ,
        `contract_id`   int(11) NULL ,
        `start_date`  date NULL ,
        `end_date`  date NULL ,
        `price`  decimal(20,2) NULL ,
        `calculation_url`  varchar(255) NULL ,
        `advisor_id`   int(11) NULL ,
        `document`  varchar(255) NULL ,
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
        $this->dropTable("client_savings");
	}

}