<?php

class m140714_074357_client_advices extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_074357_client_advices does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("

            CREATE TABLE `client_advices` (
            `id`  int(11) NOT NULL AUTO_INCREMENT ,
             `client_id`  int(10) NULL ,
            `type`  int(10) NULL ,
            `title`  varchar(255) NULL ,
            `contract_id`  int(10) NULL ,
            `date`  date NULL ,
            `file`  varchar(255) NULL ,
            `advisor_id` int(10) NULL ,
            `text`  varchar(255) NULL ,
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
        $this->dropTable("client_advices");
	}

}