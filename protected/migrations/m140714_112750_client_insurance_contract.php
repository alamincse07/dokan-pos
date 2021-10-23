<?php

class m140714_112750_client_insurance_contract extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_112750_insurance_contract does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("


                CREATE TABLE `client_insurance_contract` (
                `id`  int(11) not NULL AUTO_INCREMENT ,
                 `client_id`  int(10) NULL ,
                 `insurance_id`  int(10) NULL ,
                `policy_number`  int(10) NULL ,
                `type`  int(2) NULL ,
                `insurance_company`  int(10) NULL ,
                `product_name`  varchar(255) NULL ,
                `start_date`  datetime NULL ,
                `expiration_date`  datetime NULL ,
                `end_date`  datetime NULL ,
                `Period`  int(2) NULL ,
                `insured_amount`  numeric NULL ,
                `praised_value`  numeric NULL ,
                `term`  numeric NULL ,
                `price`  varchar(255) NULL ,
                `incasso_change`  enum('Yes','No'),
                `my_kees`  numeric NULL ,
                `package` varchar(255) NULL ,
                `related`  int(11) NULL ,
                `automatic_incasso`  enum('Yes','No'),
                `Incasso`  varchar(255) NULL ,
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

        $this->dropTable("client_insurance_contract");
	}

}