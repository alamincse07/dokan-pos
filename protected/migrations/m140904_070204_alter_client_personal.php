<?php

class m140904_070204_alter_client_personal extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140904_070204_alter_client_personal does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_personal`
            ADD COLUMN `anva_number`  int(11) NULL AFTER `relationship`,
            ADD COLUMN `my_kees_number`  int(11) NULL AFTER `anva_number`,
            ADD COLUMN `facebook`  varchar(255) NULL AFTER `my_kees_number`,
            ADD COLUMN `twitter`  varchar(255) NULL AFTER `facebook`,
            ADD COLUMN `linkedin`  varchar(255) NULL AFTER `twitter`,
            ADD COLUMN `extra_group`  enum('Family with Children','Family without children','Single') NULL AFTER `linkedin`;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_personal`
            DROP COLUMN `anva_number`,
            DROP COLUMN `my_kees_number`,
            DROP COLUMN `facebook`,
            DROP COLUMN `twitter`,
            DROP COLUMN `linkedin`,
            DROP COLUMN `extra_group`;");
	}

}