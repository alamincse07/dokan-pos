<?php

class m140725_102140_alter_employer_download extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140725_102140_alter_employer_download does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        /*employers download*/

        /*$this->execute("ALTER TABLE `employers_download` ADD FOREIGN KEY (`employer_general_id`) REFERENCES `client_employers_general` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;");

        $this->execute("ALTER TABLE `employers_download` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;");*/
	}

	public function safeDown()
	{
        /*employers download*/

        /*$this->execute(" ALTER TABLE `employers_download` DROP FOREIGN KEY `employers_download_ibfk_2`;");

        $this->execute("ALTER TABLE `employers_download` DROP FOREIGN KEY `employers_download_ibfk_1`;");*/
	}

}