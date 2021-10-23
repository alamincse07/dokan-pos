<?php

class m140716_054610_client_credit_general extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140716_054610_client_credit_general does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->execute("CREATE TABLE `client_credit_general` (
                `id`  int(11) NOT NULL AUTO_INCREMENT ,
                `client_id`  int(11) NULL ,
                `advisor_id`  int(11) NULL ,
                `portal`  varchar(255) NULL ,
                `is_active`  enum('Yes','No') ,
                `provision`  varchar(255) NULL ,
                `status`  int(11) NULL ,
                `insurer_id`  int(11) NULL ,
                `gender`  enum('Male','Female'),
                `date_of_birth`  date NULL ,
                `family_composition`  int(11) NULL ,
                `general_conditions`  varchar(255) NULL ,
                `policy`  varchar(255) NULL ,
                `document`  varchar(255) NULL ,
                `automatic_incasso`  enum('Yes','No'),
                `incasso`  varchar(255) NULL ,
                 `contract_id`  int(10) NULL ,
                `type`  varchar(50) NULL ,
                `credit_type`  int(10) NULL ,
                `bank`  int(10) NULL ,
                `credit_name`  varchar(255) NULL ,
                `box`  int(10) NULL ,
                `amount`  numeric(15,2) NULL ,
                `duration`  varchar(50) NULL ,
                `start_date`  date NULL ,
                `end_date`  date NULL ,
                `interest`  numeric(10,2) NULL ,
                `fixed_interest`  numeric(15,2) NULL ,
                `total_amount`  numeric(15,2) NULL ,
                `interest_amount`  numeric(15,2) NULL ,
                `redemption`  numeric(15,2) NULL ,
                `my_kees`  numeric(20,0) NULL ,
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
        $this->dropTable("client_credit_general");
    }

}