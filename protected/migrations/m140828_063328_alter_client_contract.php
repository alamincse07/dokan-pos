<?php

class m140828_063328_alter_client_contract extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140828_063328_alter_client_contract does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_contract_list`
          ADD COLUMN `active`  enum('Yes','No') NULL AFTER `commission`;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_contract_list`
               DROP COLUMN `active`;
");
	}

}