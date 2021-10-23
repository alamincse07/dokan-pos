<?php

class m140826_050113_add_insurance_file_in_mortgage extends CDbMigration
{
/*	public function up()
	{
	}

	public function down()
	{
		echo "m140826_050113_add_insurance_file_in_mortgage does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
                      ALTER TABLE `client_mortgage_general`
                      ADD COLUMN `insurance_policy_file`  varchar(255) NULL AFTER `insurance_id`,
                      ADD COLUMN `insurance_general_conditions_file`  varchar(255) NULL AFTER `insurance_policy_file`,
                      ADD COLUMN `insurance_health_testimony_file`  varchar(255) NULL AFTER `insurance_general_conditions_file`,
                      ADD COLUMN `insurance_pawning_file`  varchar(255) NULL AFTER `insurance_health_testimony_file`;
                      ");
	}

	public function safeDown()
	{
        $this->dropTable('client_mortgage_general');
	}

}