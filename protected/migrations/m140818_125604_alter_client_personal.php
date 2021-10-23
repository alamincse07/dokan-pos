<?php

class m140818_125604_alter_client_personal extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140818_125604_alter_client_personal does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	/*public function safeUp()
	{
        $this->execute("ALTER TABLE `client_personal`
MODIFY COLUMN `default_advisor`  int(11) NULL DEFAULT 1 AFTER `family_of_client`;

");
	}

	public function safeDown()
	{
	}*/

}