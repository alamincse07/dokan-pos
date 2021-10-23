<?php

class m140910_075033_add_advisor_list_in_client_personal extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140910_075033_add_advisor_list_in_client_personal does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
        ALTER TABLE `client_personal`
        ADD COLUMN `insurance_advisor`  int(11) NULL AFTER `initial`,
        ADD COLUMN `mortgage_advisor`  int(11) NULL AFTER `insurance_advisor`,
        ADD COLUMN `pension_advisor`  int(11) NULL AFTER `mortgage_advisor`,
        ADD COLUMN `credit_advisor`  int(11) NULL AFTER `pension_advisor`,
        ADD COLUMN `damage_advisor`  int(11) NULL AFTER `credit_advisor`;
        ");
	}

	public function safeDown()
	{
        $this->execute("
        ALTER TABLE `client_personal`
        DROP COLUMN `insurance_advisor`  int(11) NULL AFTER `initial`,
        DROP COLUMN `mortgage_advisor`  int(11) NULL AFTER `insurance_advisor`,
        DROP COLUMN `pension_advisor`  int(11) NULL AFTER `mortgage_advisor`,
        DROP COLUMN `credit_advisor`  int(11) NULL AFTER `pension_advisor`,
        DROP COLUMN `damage_advisor`  int(11) NULL AFTER `credit_advisor`;
        ");
	}

}