<?php

class m140917_111901_alter_client_message extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140917_111901_alter_client_message does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_messages`
ADD COLUMN `automatic`  enum('Yes','No') NULL DEFAULT 'Yes' AFTER `advisor_view`;
");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_messages`
            DROP COLUMN `automatic`;");
	}

}