<?php

class m140716_051024_client_mortgage_general extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140716_051024_client_mortgage_general does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("CREATE TABLE `client_mortgage_general` (
                `id`  int(11) NOT NULL AUTO_INCREMENT ,
                `client_id`  int(11) NULL ,
                `advisor_id`  int(11) NULL ,
                `portal`  varchar(255) NULL ,
                `status`  int(11) NULL ,
                `provision`  varchar(255) NULL ,
                `is_active`  enum('Yes','No'),
                `house_type`  int(11) NULL ,
                `market_value`  decimal(20,2) NULL ,
                `execution_value`  decimal(20,2) NULL ,
                `free_by_name`  decimal(20,2) NULL ,
                `woz_value`  decimal(20,2) NULL ,
                `notary`  varchar(255) NULL ,
                `notary_address`  varchar(255) NULL ,
                `notary_email`  varchar(255) NULL ,
                `notary_telephone_number`  varchar(255) NULL ,
                `appraiser`  varchar(255) NULL ,
                `appraiser_address`  varchar(255) NULL ,
                `appraiser_email`  varchar(255) NULL ,
                `appraiser_telephone_number`  varchar(255) NULL ,
                `general_conditions`  varchar(255) NULL ,
                `policy`  varchar(255) NULL ,
                `automatic_incasso`  enum('Yes','No'),
                `incasso`  int(11) NULL ,
                 `bank`  int(11) NULL ,
                `mortgage_type`  int(11) NULL ,
                `mortgage_amount`  decimal(20,2) NULL ,
                `box`  int(11) NULL ,
                `interest`  varchar(255) NULL ,
                `fixed_interest`  varchar(255) NULL ,
                `mortgage_duration`  varchar(255) NULL ,
                `mortgage_end_date`  date NULL ,
                `interest_amount`  decimal(20,2) NULL ,
                `redemption`  varchar(255) NULL ,
                `total`  decimal(20,2) NULL ,
                `mortgage_my_kees`  decimal(20,2) NULL ,
                `insurer_id`  int(11) NULL ,
                `redeem_type`  int(11) NULL ,
                `redemption_amount`  decimal(20,2) NULL ,
                `period`  int(11) NULL ,
                `redemption_end_date`  date NULL ,
                `redemption_duration`  varchar(255) NULL ,
                `price`  decimal(20,2) NULL ,
                `redemption_my_kees`  decimal(20,2) NULL ,
                `purchase_date`  date NULL ,
                `bank_security_date`  date NULL ,
                `resolutive_condition`  date NULL ,
                `overtake_date`  date NULL ,
                `stocktaking_date`  date NULL ,
                `stocktaking_agreement`  varchar(255) NULL ,
                `stocktaking_file`  varchar(255) NULL ,
                `stocktaking_description`  varchar(255) NULL ,
                `mortgage_calculation_date`  date NULL ,
                `mortgage_calculation_agreement`  varchar(255) NULL ,
                `mortgage_calculation_file`  varchar(255) NULL ,
                `mortgage_calculation_description`  varchar(255) NULL ,
                `mortgage_quotation_date`  date NULL ,
                `mortgage_quotation_agreement`  varchar(255) NULL ,
                `mortgage_quotation_file`  varchar(255) NULL ,
                `mortgage_quotation_description`  varchar(255) NULL ,
                `sign_mortgage_quotation`  date NULL ,
                `sign_mortgage_quotation_file`  varchar(255) NULL ,
                `sign_mortgage_life_insurance`  date NULL ,
                `sign_mortgage_life_insurance_file` varchar(255) NULL ,
                `sign_mortgage_investment_insurance`  date NULL ,
                `sign_mortgage_investment_insurance_file`  varchar(255) NULL ,
                `sign_mortgage_risk_analyse`  date NULL ,
                `sign_mortgage_risk_analyse_file`  varchar(255) NULL ,
                `sign_estimation_assignment`  date NULL ,
                `sign_estimation_assignment_file`  varchar(255) NULL,
                `sign_employment_invoice`  date NULL ,
                `sign_employment_invoice_file` varchar(255) NULL ,
                `sign_advice_report`  date NULL ,
                `sign_advice_report_file`  varchar(255) NULL ,
                `documents_employers_statement_applicant`  date NULL ,
                `documents_employers_statement_applicant_file`  varchar(255) NULL ,
                `documents_employers_statement_partner`  date NULL ,
                `documents_employers_statement_partner_file`  varchar(255) NULL ,
                `documents_health_statement_applicant`  date NULL ,
                `documents_health_statement_applicant_file`  varchar(255) NULL ,
                `documents_health_statement_partner`  date NULL ,
                `documents_health_statement_partner_file`  varchar(255) NULL ,
                `documents_payslip_applicant`  date NULL ,
                `documents_payslip_applicant_file` varchar(255) NULL,
                `documents_payslip_partner`  date NULL ,
                `documents_payslip_partner_file`  varchar(255) NULL ,
                `documents_estimation_report`  date NULL ,
                `documents_estimation_report_file`   varchar(255) NULL ,
                `documents_rebuildings_specification`  date NULL ,
                `documents_rebuildings_specification_file`   varchar(255) NULL ,
                `acception_mortgage_quotation`  date NULL ,
                `acception_mortgage_quotation_file` varchar(255) NULL ,
                `acception_term_life_insurance`  date NULL ,
                `acception_term_life_insurance_file`  varchar(255) NULL ,
                `acception_bank_security`  date NULL ,
                `acception_bank_security_file`  varchar(255) NULL ,
                `acception_agreement_notary`  date NULL ,
                `acception_agreement_notary_file` varchar(255) NULL ,
                `acception_mortgage_certificate`  date NULL ,
                `acception_mortgage_certificate_file` varchar(255) NULL ,
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
        $this->dropTable("client_mortgage_general");
	}

}