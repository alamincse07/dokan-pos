<?php

class m140908_060834_dropdown_packages extends CDbMigration
{
    /*public function up()
	{
	}

	public function down()
	{
		echo "m140908_055909_dropdown_packages does not support migration down.\n";
		return false;
	}*/


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE `dropdown_packages` (
                `id`  int(11) NOT NULL AUTO_INCREMENT ,
                `name`  varchar(255) NULL ,
                `package_number`  int(100) NULL ,
                `start_date`  datetime NULL ,
                `price_verval_date`  datetime NULL ,
                `total_price`  decimal(16,2) NULL ,
                `incasso`  varchar(255) NULL ,
                `term`  int(11) NULL ,
                `package_contract_date`  datetime NULL ,
                `create_date`  datetime NULL ,
                `update_date`  datetime NULL ,
                `created_by`  int(11) NULL ,
                `update_by`  int(11) NULL ,
                PRIMARY KEY (`id`)
                )
                ENGINE=InnoDB
                DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
                ;
        ");
    }

    public function safeDown()
    {
        $this->dropTable("dropdown_packages");
    }
}