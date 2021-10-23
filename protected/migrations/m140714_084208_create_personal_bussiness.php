<?php

class m140714_084208_create_personal_bussiness extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_084208_create_personal_bussiness does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("CREATE TABLE `client_personal_business` (
                `id`  int(11) NOT NULL AUTO_INCREMENT ,
                `gender`  enum('Male','Female') ,
                `client_id`  int(11) NULL ,
               /* `first_name`  varchar(100) NULL ,*/
                /*`first_letter`  varchar(100) NULL ,*/
                `insertion`  varchar(255) NULL ,
                /*`last_name`  varchar(100) NULL ,*/
                `nationality`  varchar(100) NULL ,
                `date_of_birth`  date NULL ,
                `citizen_service_number`  varchar(100) NULL ,
                `marital_status`  int(11) NULL ,
                `smoker`  enum('Yes','No'),
                `entrepreneur`  varchar(100) NULL ,
                `house_type`  int(11) NULL ,
                `street_name`  varchar(255) NULL ,
                `house_number`  varchar(255) NULL ,
                `addition`  varchar(255) NULL ,
                `postal_code`  varchar(100) NULL ,
                `place`  varchar(255) NULL ,
                `province`  int(11) NULL ,
                /*`telephone_number`  varchar(255) NULL ,*/
                `fax_number`  varchar(255) NULL ,
                `mobile_number`  varchar(255) NULL ,
                /*`email`  varchar(255) NULL ,*/
                `group`  int(11) NULL ,
                `subscription`  int(11) NULL ,
                `ref_customer`  int(11) NULL ,
                `education`  int(11) NULL ,
                `divorced`  enum('Yes','No'),
                `bkr_registration`  enum('Yes','No'),
                `bkr_code`  int(11)  NULL ,
                `company_type` int(11) NULL ,
                `company_name`  varchar(255) NULL ,
                `chamber_of_commerce`  varchar(255) NULL ,
                `type`  varchar(255) NULL ,
                `automatic_incasso`  enum('Yes','No'),
                `account_number`  varchar(255) NULL ,
                `bank`  varchar(255) NULL ,
                `name`  varchar(255) NULL ,
                `date`  date NULL ,
                /*`password`  varchar(255) NULL ,*/
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
        $this->dropTable("client_personal_business");
	}

}