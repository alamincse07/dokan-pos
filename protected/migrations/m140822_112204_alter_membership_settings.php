<?php

class m140822_112204_alter_membership_settings extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140822_112204_alter_membership_settings does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `membership_settings` ADD FOREIGN KEY (`period`) REFERENCES `dropdown_payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `membership_settings` DROP FOREIGN KEY `membership_settings_ibfk_1`;");

	}

}