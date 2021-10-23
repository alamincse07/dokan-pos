<?php

class m140902_055926_alter_insurance_general extends CDbMigration
{
/*	public function up()
	{
	}

	public function down()
	{
		echo "m140902_055926_alter_insurance_general does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_insurance_general`
ADD COLUMN `price`  varchar(255) NULL AFTER `update_by`;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_insurance_general`
DROP COLUMN `price`;

");
	}

}