<?php

class m140721_080900_alter_tbl_access extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140721_080900_alter_tbl_access does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `tbl_access`
ADD COLUMN `created_by`  int(11) NULL AFTER `update_date`,
ADD COLUMN `update_by`  int(11) NULL AFTER `created_by`;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `tbl_access`
DROP COLUMN `created_by`  int(11) NULL AFTER `update_date`,
DROP COLUMN `update_by`  int(11) NULL AFTER `created_by`;");
	}

}