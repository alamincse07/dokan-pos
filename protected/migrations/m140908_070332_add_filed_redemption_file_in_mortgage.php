<?php

class m140908_070332_add_filed_redemption_file_in_mortgage extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140908_070332_add_filed_redemption_file_in_mortgage does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
            ALTER TABLE `client_mortgage_general`
            ADD COLUMN `redemption_schedule_file`  varchar(255) NULL AFTER `insurance_pawning_file`;");

	}

	public function safeDown()
	{
	}

}