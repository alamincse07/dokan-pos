<?php

class m140714_110120_client_insurance_general extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_110120_client_insurance_general does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("


CREATE TABLE `client_insurance_general` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
 `client_id`  int(10) NULL ,
 `advisor_id`  int(10) NULL ,
 `insurance_type`  int(10) NULL ,

`portal`  varchar(50) NULL ,
`is_active`  enum('Yes','No'),
`commission`  numeric(20,2) NULL ,
`status`  int(10) NULL ,
`insured`  varchar(255) NULL ,
`gender`  enum('Male','Female') ,
`date_of_birth`  date NULL ,
`family_composition`  int(10) NULL ,
`general_conditions`  varchar(255) NULL ,
`policy`  varchar(255) NULL ,
`document`  varchar(255) NULL ,
`create_date`  datetime NULL ,
 `update_date`  datetime NULL ,
 `created_by`  int(11) NULL ,
              `update_by`  int(11) NULL ,
PRIMARY KEY (`id`)
)ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
;         ");

    }

	public function safeDown()
	{
        $this->dropTable("client_insurance_general");
	}

}