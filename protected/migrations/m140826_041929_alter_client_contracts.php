<?php

class m140826_041929_alter_client_contracts extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140826_041929_alter_client_contracts does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_contracts`
           ADD COLUMN `customer_group`  int(11) NULL AFTER `update_by`;");

        $this->execute("ALTER TABLE `client_contracts` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;");

        $this->execute("ALTER TABLE `client_contracts` ADD FOREIGN KEY (`period`) REFERENCES `dropdown_payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;");

        $this->execute("ALTER TABLE `client_contracts` ADD FOREIGN KEY (`customer_group`) REFERENCES `dropdown_type_of_customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_contracts`
                  DROP COLUMN `customer_group`;");

        $this->execute("ALTER TABLE `client_contracts` DROP FOREIGN KEY `client_contracts_ibfk_3`;");

        $this->execute("ALTER TABLE `client_contracts` DROP FOREIGN KEY `client_contracts_ibfk_1`;");

        $this->execute("ALTER TABLE `client_contracts` DROP FOREIGN KEY `client_contracts_ibfk_2`;");
	}

}