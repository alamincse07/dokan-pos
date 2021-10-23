<?php

class m140908_065725_boss_house_no_addition extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140908_065725_boss_house_no_addition does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute('ALTER TABLE `client_employers_general`
        ADD COLUMN `house_number_addition`  varchar(255) NULL AFTER `house_number`;
        ');
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_employers_general`
        DROP COLUMN `house_number_addition`  ;
        ");
	}

}