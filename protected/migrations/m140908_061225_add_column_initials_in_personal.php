<?php

class m140908_061225_add_column_initials_in_personal extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140908_061225_add_column_initials_in_personal does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute('ALTER TABLE `client_personal`
        ADD COLUMN `initial`  varchar(255) NULL AFTER `contract_amount`;');
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_personal`
        DROP COLUMN `initial`  ;
        ");
	}

}