<?php

class m140903_121146_alter_incurance_contract extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140903_121146_alter_incurance_contract does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_insurance_contract`
ADD COLUMN `coverage`  int(11) NULL AFTER `description`;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_insurance_contract`
DROP COLUMN `coverage`;");
	}

}