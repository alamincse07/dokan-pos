<?php

class m140904_125050_alter_client_personal extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140904_125050_alter_client_personal does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_personal`
ADD COLUMN `contract_count`  int(11) NULL AFTER `extra_group`,
ADD COLUMN `contract_amount`  decimal(20,2) NULL AFTER `contract_count`;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_personal`
        DROP COLUMN `contract_count`  ;
        ");

        $this->execute("ALTER TABLE `client_personal`
        DROP COLUMN `contract_amount`  ;
        ");

	}

}