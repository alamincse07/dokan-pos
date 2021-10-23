<?php

class m140905_053940_create_damage_document extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140905_053940_create_damage_document does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_damage`
ADD COLUMN `documents`  varchar(255) NULL AFTER `note`;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_damage`
        DROP COLUMN `documents`  ;
        ");
	}

}