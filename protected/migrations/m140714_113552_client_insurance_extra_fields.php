<?php

class m140714_113552_client_insurance_extra_fields extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_113552_client_insurance_extra_fields does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("


CREATE TABLE `client_insurance_extra_fields` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`insurance_extra_info_field`  varchar(255) NULL ,
`insurance_type_id`  int(5) NULL ,
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
        $this->dropTable("client_insurance_extra_fields");
	}

}