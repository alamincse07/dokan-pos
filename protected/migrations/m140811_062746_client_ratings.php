<?php

class m140811_062746_client_ratings extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140811_062746_client_ratings does not support migration down.\n";
		return false;
	}*/

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->execute("

        CREATE TABLE `client_rating` (
              `id`  int(11) NOT NULL AUTO_INCREMENT ,
                 `client_id`  int(10) NULL ,
                `rating_name`  varchar(255) NULL ,
                 `point`  numeric(20,2) NULL ,
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