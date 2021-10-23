<?php

class m140825_074233_mortgage_insurance_field_add extends CDbMigration
{
/*	public function up()
	{
	}

	public function down()
	{
		echo "m140825_074233_mortgage_insurance_field_add does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
        ALTER TABLE `client_mortgage_general`
ADD COLUMN `insurer`  int(11) NULL AFTER `update_by`,
ADD COLUMN `insurance`  int(11) NULL AFTER `insurer`,
ADD COLUMN `insured_party`  varchar(255) NULL AFTER `insurance`,
ADD COLUMN `insured_amount`  decimal(20,2) NULL AFTER `insured_party`,
ADD COLUMN `insurance_period`  int(11) NULL AFTER `insured_amount`,
ADD COLUMN `insurance_end_date`  date NULL AFTER `insurance_period`,
ADD COLUMN `insurance_time_period`  varchar(255) NULL AFTER `insurance_end_date`,
ADD COLUMN `insurance_price`  decimal(20,2) NULL AFTER `insurance_time_period`,
ADD COLUMN `insurance_my_kees`  decimal(20,2) NULL AFTER `insurance_price`;
        ");
	}

	public function safeDown()
	{
        $this->dropTable('client_mortgage_general');
	}

}