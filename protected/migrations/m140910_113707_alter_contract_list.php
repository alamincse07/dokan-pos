<?php

class m140910_113707_alter_contract_list extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140910_113707_alter_contract_list does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_contract_list`
ADD COLUMN `licence`  varchar(255) NULL AFTER `active`;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_contract_list`
DROP COLUMN `licence`;

");
	}

}