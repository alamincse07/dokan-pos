<?php

class m140716_042824_insurance_contract_extra_vehicle extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140716_042824_insurance_contract_extra_vehicle does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("CREATE TABLE `client_insurance_contract_extra_vehicle` (
                `id`  int(11) NOT NULL AUTO_INCREMENT ,
                `insurance_contract_id`  int(11) NULL ,
                `driver`  int(11) NULL ,
                `date_of_birth`  date NULL ,
                `coverage`  int(11) NULL ,
                `license`  varchar(255) NULL ,
                `damage_years`  varchar(255) NULL ,
                `kilometer_per_year`  int(11) NULL ,
                `extra_info_type`  int(11) NULL ,
                `create_date`  datetime NULL ,
                `update_date`  datetime NULL ,
                `created_by`  int(11) NULL ,
              `update_by`  int(11) NULL ,
                PRIMARY KEY (`id`)
                )ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;



");
	}

	public function safeDown()
	{
        $this->dropTable("client_insurance_contract_extra_vehicle");
	}

}