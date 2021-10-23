<?php

class m140908_071605_alter_insurance_status extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140908_071605_alter_insurance_status does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("UPDATE `dropdown_insurance_status` SET `name`='Time penalty' WHERE `id`='4'");
        $this->execute("UPDATE `dropdown_insurance_status` SET `name`='Stopped' WHERE `id`='3'");
        $this->execute("UPDATE `dropdown_insurance_status` SET `name`='Ongoing' WHERE `id`='2'");
        $this->execute("UPDATE `dropdown_insurance_status` SET `name`='Request' WHERE `id`='1'");
        $this->execute("DELETE FROM `dropdown_insurance_status` WHERE `id`='5'");

	}

	public function safeDown()
	{
	}

}