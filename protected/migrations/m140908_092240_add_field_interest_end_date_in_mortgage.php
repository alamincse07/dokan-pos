<?php

class m140908_092240_add_field_interest_end_date_in_mortgage extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140908_092240_add_field_interest_end_date_in_mortgage does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_mortgage_general`
        ADD COLUMN `interest_end_date`  datetime NULL AFTER `redemption_schedule_file`;");
	}

	public function safeDown()
	{
	}

}