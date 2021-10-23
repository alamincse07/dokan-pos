<?php

class m140908_042128_alter_employers_general extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140908_042128_alter_employers_general does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_employers_general` DROP FOREIGN KEY `client_employers_general_ibfk_3`;

ALTER TABLE `client_employers_general` ADD CONSTRAINT `client_employers_general_ibfk_3` FOREIGN KEY (`employment`) REFERENCES `dropdown_type_of_employment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_employers_general` DROP FOREIGN KEY `client_employers_general_ibfk_3`;

");
	}

}