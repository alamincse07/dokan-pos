<?php

class m140911_124859_alter_client_personal extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140911_124859_alter_client_personal does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_personal`
                MODIFY COLUMN `smoker`  enum('Yes','No','Not Defined') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `marital_status`,
                ADD COLUMN `extra_information`  varchar(255) NULL AFTER `damage_advisor`;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_personal`
            DROP COLUMN `extra_information`,
            MODIFY COLUMN `smoker`  enum('Yes','No','') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `marital_status`;");
	}

}