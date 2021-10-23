<?php

class m140814_053811_alter_insurance_general extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140814_053811_alter_insurance_general does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_insurance_general`
CHANGE COLUMN `gender` `type`  enum('Comapany','Private') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `insured`;");
	}

	public function safeDown()
	{
	}

}