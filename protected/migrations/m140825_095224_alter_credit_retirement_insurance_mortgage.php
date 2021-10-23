<?php

class m140825_095224_alter_credit_retirement_insurance_mortgage extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140825_095224_alter_credit_retirement_insurance_mortgage does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_credit_general`
ADD COLUMN `description`  varchar(255) NULL AFTER `update_by`;");

        $this->execute("ALTER TABLE `client_insurance_contract`
ADD COLUMN `description`  varchar(255) NULL AFTER `update_by`;");

        $this->execute("ALTER TABLE `client_mortgage_general`
ADD COLUMN `description`  varchar(255) NULL AFTER `update_by`;");

        $this->execute("ALTER TABLE `client_pension_general`
ADD COLUMN `description`  varchar(255) NULL AFTER `update_by`;");

	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_credit_general`
DROP COLUMN `description`;");

        $this->execute("ALTER TABLE `client_insurance_contract`
DROP COLUMN `description`;");

        $this->execute("ALTER TABLE `client_mortgage_general`
DROP COLUMN `description`;");

        $this->execute("ALTER TABLE `client_pension_general`
DROP COLUMN `description`;");
	}

}