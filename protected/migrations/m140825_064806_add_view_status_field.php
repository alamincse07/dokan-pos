<?php

class m140825_064806_add_view_status_field extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140825_064806_add_view_status_field does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_messages`
ADD COLUMN `view_status`  enum('1','0') NULL DEFAULT '0' AFTER `update_by`;");

        $this->execute("ALTER TABLE `client_advices`
ADD COLUMN `view_status`  enum('1','0') NULL DEFAULT '0' AFTER `update_by`;");

        $this->execute("ALTER TABLE `client_damage`
ADD COLUMN `view_status`  enum('1','0') NULL DEFAULT '0' AFTER `update_by`;");

        $this->execute("ALTER TABLE `client_requests`
ADD COLUMN `view_status`  enum('1','0') NULL DEFAULT '0' AFTER `update_by`;");

        $this->execute("ALTER TABLE `client_tasks`
ADD COLUMN `view_status`  enum('1','0') NULL DEFAULT '0' AFTER `update_by`;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_messages`
                    DROP COLUMN `view_status`;");

        $this->execute("ALTER TABLE `client_advices`
                    DROP COLUMN `view_status`;");

        $this->execute("ALTER TABLE `client_damage`
                    DROP COLUMN `view_status`;");

        $this->execute("ALTER TABLE `client_requests`
                    DROP COLUMN `view_status`;");

        $this->execute("ALTER TABLE `client_tasks`
                    DROP COLUMN `view_status`;");
	}

}