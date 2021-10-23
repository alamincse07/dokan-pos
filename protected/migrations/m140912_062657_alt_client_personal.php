<?php

class m140912_062657_alt_client_personal extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140912_062657_alt_client_personal does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
        ALTER TABLE `client_personal`
            ADD COLUMN `financial_advisor`  int(11) NULL AFTER `extra_information`,
            ADD COLUMN `admin_advisor`  int(11) NULL AFTER `financial_advisor`,
            ADD COLUMN `inside_advisor`  int(11) NULL AFTER `admin_advisor`;
            ");
	}

	public function safeDown()
	{
        $this->execute("
        ALTER TABLE `client_personal`
            DROP COLUMN `financial_advisor`  ,
            DROP COLUMN `admin_advisor`  ,
            DROP COLUMN `inside_advisor`  ;
            ");
	}

}