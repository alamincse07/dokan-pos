<?php

class m140714_073758_create_client_requests extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_073758_create_client_requests does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("CREATE TABLE `client_requests` (
            `id`  int(11) NOT NULL AUTO_INCREMENT ,
            `client_id` int(11) NULL,
            `type`  int(11) NULL ,
            `contract_id`  int(11) NULL ,
            `form`  varchar(255) NULL ,
            `date`  date NULL ,
            `advisor_id`   int(11) NULL ,
            `text`  text NULL ,
            `create_date`  datetime NULL ,
            `update_date`  datetime NULL ,
            `created_by`  int(11) NULL ,
              `update_by`  int(11) NULL ,
            PRIMARY KEY (`id`)
            )
            ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

");

	}

	public function safeDown()
	{
        $this->dropTable("client_requests");
	}

}