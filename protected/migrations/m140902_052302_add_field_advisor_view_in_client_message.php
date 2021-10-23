<?php

class m140902_052302_add_field_advisor_view_in_client_message extends CDbMigration
{
    /*public function up()
    {
    }

    public function down()
    {
        echo "m140902_052302_add_field_advisor_view_in_client_message does not support migration down.\n";
        return false;
    }*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_messages`
        ADD COLUMN `advisor_view`  int(11) NULL DEFAULT 0 AFTER `view_status`;
        ");
	}

	public function safeDown()
	{
	}

}