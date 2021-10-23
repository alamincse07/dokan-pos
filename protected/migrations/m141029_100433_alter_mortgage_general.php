<?php

class m141029_100433_alter_mortgage_general extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m141029_100433_alter_mortgage_general does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("



ALTER TABLE `client_mortgage_general`
ADD COLUMN `total_mortgage_amount`  decimal(20,2) NULL AFTER `provision`;

ALTER TABLE `client_mortgage_general`
ADD COLUMN `total_monthly_price`  decimal(20,2) NULL AFTER `total_mortgage_amount`;

ALTER TABLE `client_mortgage_general`
ADD COLUMN `total_monthly_interest`  decimal(20,2) NULL AFTER `total_monthly_price`;
        ");

	}

	public function safeDown()
	{
	}

}