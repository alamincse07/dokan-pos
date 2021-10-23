<?php

class m141110_115312_insert_into_clientcal_mortretpen extends CDbMigration
{

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
          INSERT INTO `calculate_value_of_mortgage_credit_retirement` (`id`,`calculate_maximum_mortgage_multiply_value`, `calculate_maximum_monthly_mortgage_multiply_value`, `height_mortgage_multiply_value`,`height_mortgage_multiply_value2`,`monthly_mortgage_multiply_value`,`mortgage_amount_multiply_value`,`mortgage_amount_multiply_value2`,`maximum_credit_multiply_value`,`maximum_monthly_credit_multiply_value`,`credit_monthly_payment_multiply_value`,`total_pension_multiply_value`,`pension_wanted_multiply_value`,`pension_total_aow`,`create_date`,`update_date`,`created_by`,`update_by`) VALUES (1, '4.50', '0.06', '0.88', '1.25', '0.06', '0.88', '1.25', '4.5', '0.08', '0.08', '12.00', '4.50', '23.00', '2014-07-11 10:28:36', '2014-07-11 10:28:36', '1','1');
        ");
	}

	public function safeDown()
	{
        //$this->truncateTable("tbl_user_group");
        $this->execute("
        DELETE FROM calculate_value_of_mortgage_credit_retirement WHERE id <2
        ");
    }

}