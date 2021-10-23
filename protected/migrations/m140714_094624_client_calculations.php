<?php

class m140714_094624_client_calculations extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_094624_client_calculations does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("



                CREATE TABLE `client_calculations` (
                `id`  int(11) NOT NULL AUTO_INCREMENT ,
                 `client_id`  int(10) NULL ,
                `max_mortgage`  numeric(20,2) NULL ,
                `max_mortgage_monthly_amount`  numeric(20,2) NULL ,
                `house_price`  numeric(20,2) NULL ,
                `mortgage_amount`  numeric(20,2) NULL ,
                `mortgage_monthly_amount`  numeric(20,2) NULL ,
                `total_pension`  numeric(20,2) NULL ,
                `AOW`  numeric(20,2) NULL ,
                `wanted`  numeric(20,2) NULL ,
                `pension_gap`  numeric(15,2) NULL ,
                `solutions`  numeric(15,2) NULL ,
                `my_kees`  numeric(20,0) NULL ,
                `max_credit`  numeric(15,2) NULL ,
                `max_credit_monthly_amount`  numeric(15,2) NULL ,
                `credit_amount`  numeric(15,2) NULL ,
                `credit_monthly_amount`  numeric(15,2) NULL ,
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
        $this->dropTable("client_calculations");
	}

}