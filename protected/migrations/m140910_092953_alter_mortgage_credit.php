<?php

class m140910_092953_alter_mortgage_credit extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140910_092953_alter_mortgage_credit does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_mortgage_general`
                        ADD COLUMN `debt_bank`  int(10) NULL AFTER `update_by`;
                     ");

        $this->execute("ALTER TABLE `client_credit_general`
                        ADD COLUMN `debt_bank`  int(10) NULL AFTER `update_by`;
                     ");

	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_mortgage_general`
                        DROP COLUMN `debt_bank`;
                     ");

        $this->execute("ALTER TABLE `client_credit_general`
                        DROP COLUMN `debt_bank`;
                     ");
	}

}