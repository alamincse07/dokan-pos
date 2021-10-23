<?php

class m140721_080450_alter_tbl_user extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140721_080450_alter_tbl_user does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `tbl_user`
ADD COLUMN `created_by`  int(11) NULL AFTER `type`,
ADD COLUMN `update_by`  int(11) NULL AFTER `created_by`;");

	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `tbl_user`
DROP COLUMN `created_by`  int(11) NULL AFTER `type`,
DROP COLUMN `update_by`  int(11) NULL AFTER `created_by`;");
	}

}