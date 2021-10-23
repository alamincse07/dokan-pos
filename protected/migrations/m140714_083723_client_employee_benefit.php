<?php

class m140714_083723_client_employee_benefit extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_083723_client_employee_benefit does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	/*public function safeUp()
	{
        $this->execute("

            CREATE TABLE `client_employers_employee_benefit` (
            `id`  int(11) NOT NULL AUTO_INCREMENT ,
             `client_id`  int(10) NULL ,
             `employer_general_id`  int(10) NULL ,
            `arrangement`  varchar(255) NULL ,
            `contract`  varchar(255) NULL ,
            `advantage`  varchar(255) NULL ,
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


        $this->dropTable("client_employers_employee_benefit");
	}*/

}