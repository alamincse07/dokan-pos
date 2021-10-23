<?php

class m140908_095353_alter_debt_collection_data extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140908_095353_alter_debt_collection_data does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        //client_credit_general,client_mortgage_general,client_pension_general
        $this->execute("ALTER TABLE `client_insurance_contract`
                        ADD COLUMN `account_number`  varchar(255) NULL AFTER `assurance_tasks`,
                        ADD COLUMN `bank`  int(10) NULL AFTER `account_number`,
                        ADD COLUMN `account_name`  varchar(255) NULL AFTER `bank`;");

        $this->execute("ALTER TABLE `client_pension_general`
                        ADD COLUMN `account_number`  varchar(255) NULL AFTER `update_by`,
                        ADD COLUMN `bank`  int(10) NULL AFTER `account_number`,
                        ADD COLUMN `account_name`  varchar(255) NULL AFTER `bank`;");

        $this->execute("ALTER TABLE `client_credit_general`
                        ADD COLUMN `account_number`  varchar(255) NULL AFTER `update_by`,
                        ADD COLUMN `account_name`  varchar(255) NULL AFTER `account_number`;");

        $this->execute("ALTER TABLE `client_mortgage_general`
                        ADD COLUMN `account_number`  varchar(255) NULL AFTER `update_by`,
                        ADD COLUMN `account_name`  varchar(255) NULL AFTER `account_number`;");


	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_insurance_contract`
                        DROP COLUMN `account_number`,
                        DROP COLUMN `bank`,
                        DROP COLUMN `account_name`;");


        $this->execute("ALTER TABLE `client_pension_general`
                        DROP COLUMN `account_number`,
                        DROP COLUMN `bank`,
                        DROP COLUMN `account_name`;");

        $this->execute("ALTER TABLE `client_credit_general`
                        DROP COLUMN `account_number`,
                        DROP COLUMN `account_name`;");

        $this->execute("ALTER TABLE `client_mortgage_general`
                        DROP COLUMN `account_number`,
                        DROP COLUMN `account_name`;");

	}

}