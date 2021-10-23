<?php

class m140811_060556_client_contract_list extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140811_060556_client_contract_list does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("

        CREATE TABLE `client_contract_list` (
              `id`  int(11) NOT NULL AUTO_INCREMENT ,
                 `client_id`  int(10) NULL ,
                `contract_name`  varchar(255) NULL ,
                `type` varchar(255) NULL,
                `create_date`  datetime NULL ,
                 `update_date`  datetime NULL ,
                 `created_by`  int(11) NULL ,
               `update_by`  int(11) NULL ,

                PRIMARY KEY (`id`)
                )ENGINE=InnoDB
               DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
                ;

         ");
	}

	public function safeDown()
	{
        $this->dropTable('client_contract_list');
	}

}