<?php

class m140822_051957_alter_relation_company_settings extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140822_051957_alter_relation_company_settings does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `company_settings` ADD FOREIGN KEY (`company_country`) REFERENCES `dropdown_nations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;");

        $this->execute("ALTER TABLE `company_settings` ADD FOREIGN KEY (`company_province`) REFERENCES `dropdown_county` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;");

        $this->execute("ALTER TABLE `company_settings` ADD FOREIGN KEY (`visiting_country`) REFERENCES `dropdown_nations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;");

        $this->execute("ALTER TABLE `company_settings` ADD FOREIGN KEY (`visiting_province`) REFERENCES `dropdown_county` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;");


	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `company_settings` DROP FOREIGN KEY `company_settings_ibfk_4`;");

        $this->execute("ALTER TABLE `company_settings` DROP FOREIGN KEY `company_settings_ibfk_1`;");

        $this->execute("ALTER TABLE `company_settings` DROP FOREIGN KEY `company_settings_ibfk_2`;");

        $this->execute("ALTER TABLE `company_settings` DROP FOREIGN KEY `company_settings_ibfk_3`;");

	}

}