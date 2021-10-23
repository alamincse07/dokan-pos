<?php

class m141016_060914_alter_subscription_add_bank_and_account_name extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m141016_060914_alter_subscription_add_bank_and_account_name does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute('Alter TABLE  client_contracts
                        ADD COLUMN `bank`  int(10) NULL AFTER `incasso`,
                        ADD COLUMN `account_name`  varchar(255) NULL AFTER `bank`;" ');
	}

	public function safeDown()
	{
	}

}