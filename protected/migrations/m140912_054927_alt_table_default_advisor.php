<?php

class m140912_054927_alt_table_default_advisor extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140912_054927_alt_table_default_advisor does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
        ALTER TABLE `default_advisors`
            ADD COLUMN `financial_advisor`  int(11) NULL AFTER `language`,
            ADD COLUMN `admin_advisor`  int(11) NULL AFTER `financial_advisor`,
            ADD COLUMN `inside_advisor`  int(11) NULL AFTER `admin_advisor`;");
	}

	public function safeDown()
	{
        $this->execute("
        ALTER TABLE `default_advisors`
        DROP COLUMN `financial_advisor`  ,
        DROP COLUMN `admin_advisor`  ,
        DROp COLUMN `inside_advisor`  ;");
	}

}