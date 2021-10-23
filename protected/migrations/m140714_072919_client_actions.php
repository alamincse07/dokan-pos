<?php

class m140714_072919_client_actions extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_072919_client_actions does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
            CREATE TABLE `client_actions` (
            `id`  int(11) NOT NULL AUTO_INCREMENT ,
            `client_id`  int(10) NULL ,
            `customer_group`  int(10) NULL ,
            `name`  varchar(255) NULL ,
            `summary`  varchar(255) NULL ,
            `type`  int(10) NULL ,
            `page`  int(11) NULL,
            `affiliate`  varchar(255) NULL ,
            `url`  varchar(255) NULL ,
            `website`  varchar(255) NULL ,
            `start_date`  date NULL ,
            `end_date`  date NULL ,
            `banner_picture`  varchar(255) NULL ,
            `banner_url`  varchar(255) NULL ,
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
        $this->dropTable("client_actions");
	}

}