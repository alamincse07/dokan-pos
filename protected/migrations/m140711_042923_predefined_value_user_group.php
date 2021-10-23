<?php

class m140711_042923_predefined_value_user_group extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140711_042923_predefined_value_user_group does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
        INSERT INTO `tbl_user_group` (`id`,`group`, `create_date`, `access_level`) VALUES (1, 'SuperAdmin', '2014-07-11 10:28:36', '100');
        INSERT INTO `tbl_user_group` (`id`,`group`, `create_date`, `access_level`) VALUES (2, 'Admin', '2014-07-11 10:28:36', '99');
        INSERT INTO `tbl_user_group` (`id`,`group`, `create_date`, `access_level`) VALUES (3, 'Employee', '2014-07-11 10:28:36', '98');
        INSERT INTO `tbl_user_group` (`id`,`group`, `create_date`, `access_level`) VALUES (4, 'Client', '2014-07-11 10:28:36', '50');
        ");
	}

	public function safeDown()
	{
        //$this->truncateTable("tbl_user_group");
        $this->execute("
        DELETE FROM tbl_user_group WHERE id <5
        ");
	}

}