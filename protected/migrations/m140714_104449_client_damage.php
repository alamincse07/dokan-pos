<?php

class m140714_104449_client_damage extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_104449_client_damage does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("

                CREATE TABLE `client_damage` (
                `id`  int(11) NOT NULL AUTO_INCREMENT ,
                 `client_id`  int(10) NULL ,
                `status`  int(10) NULL ,
                `file_no`  varchar(100) NULL ,
                `damage_date`  date NULL ,
                `insurance_type`  int(10) NULL ,
                `contract_id`  int(10) NULL ,
                `damage_amount`  numeric(20,2) NULL ,
                `damage_paid`  numeric(20,2) NULL ,
                `declaration_date`  date NULL ,
                `declaration_at`  varchar(255) NULL ,
                `contract_no_extern`  varchar(255) NULL ,
                `extern_insurance_company`  varchar(255) NULL ,
                `damage_scene`  varchar(255) NULL ,
                `damage_control`  varchar(255) NULL ,
                `causer`  varchar(255) NULL ,
                `relation_to`  varchar(255) NULL ,
                `damage_type`  varchar(255) NULL ,
                `injury`  varchar(255) NULL ,
                `name_disadvantaged`  varchar(255) NULL ,
                `telephone_disadvantaged`  varchar(255) NULL ,
                `address_disadvantaged`  varchar(255) NULL ,
                `zipcode_disadvantaged`  varchar(255) NULL ,
                `place_disadvantaged`  varchar(255) NULL ,
                `email_disadvantaged`  varchar(255) NULL ,
                `damage_description`  text NULL ,
                `cause_of_damage`  text NULL ,
                `note`  text NULL ,
                `create_date`  datetime NULL ,
                 `update_date`  datetime NULL ,
                 `created_by`  int(11) NULL ,
              `update_by`  int(11) NULL ,
                PRIMARY KEY (`id`)
                )ENGINE=InnoDB
                DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
                ;

         ");

    }

	public function safeDown()
	{
        $this->dropTable("client_damage");
	}

}