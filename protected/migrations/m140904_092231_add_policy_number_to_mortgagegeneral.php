<?php

class m140904_092231_add_policy_number_to_mortgagegeneral extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140904_092231_add_policy_number_to_mortgagegeneral does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute('ALTER TABLE `client_mortgage_general`
        ADD COLUMN `policy_number` varchar(255) NULL  AFTER `mortgage_amount`;
        ');
	}

	public function safeDown()
	{
        $this->execute('ALTER TABLE `client_mortgage_general`
        DROP COLUMN `policy_number`  ;
        ');
	}

}