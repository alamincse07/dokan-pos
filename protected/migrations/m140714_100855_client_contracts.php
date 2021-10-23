<?php

class m140714_100855_client_contracts extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_100855_client_contracts does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("


                CREATE TABLE `client_contracts` (
                `id`  int(11) NOT NULL AUTO_INCREMENT ,
                 `client_id`  int(10) NULL ,
                `name`  varchar(255) NULL ,
                `code`  varchar(255) NULL ,
                `price`  numeric(15,2) NULL ,
                `period`  int(10) NULL ,
                `condition`  varchar(255) NULL ,
                `automatic_incasso`  enum('Yes','No'),
                `incasso`  varchar(255) NULL ,
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
        $this->dropTable("client_contracts");
	}

}