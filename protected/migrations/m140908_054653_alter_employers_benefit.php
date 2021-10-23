<?php

class m140908_054653_alter_employers_benefit extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140908_054653_alter_employers_benefit does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
                    ALTER TABLE `client_employers_general`
                    ADD COLUMN `arrangement_2`  varchar(255) NULL AFTER `advantage`,
                    ADD COLUMN `contract_2`  varchar(255) NULL AFTER `arrangement_2`,
                    ADD COLUMN `advantage_2`  varchar(255) NULL AFTER `contract_2`,
                    ADD COLUMN `arrangement_3`  varchar(255) NULL AFTER `advantage_2`,
                    ADD COLUMN `contract_3`  varchar(255) NULL AFTER `arrangement_3`,
                    ADD COLUMN `advantage_3`  varchar(255) NULL AFTER `contract_3`;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_employers_general`
                    DROP COLUMN `arrangement_2`,
                    DROP COLUMN `contract_2`,
                    DROP COLUMN `advantage_2`,
                    DROP COLUMN `arrangement_3`,
                    DROP COLUMN `contract_3`,
                    DROP COLUMN `advantage_3`;

");
	}

}