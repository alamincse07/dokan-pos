<?php

class m140714_113601_create_client_mortgage_appliction extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_113601_create_client_mortgage_appliction does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	/*public function safeUp()
	{
        $this->execute("CREATE TABLE `client_mortgage_application` (
        `id`  int(11) NOT NULL AUTO_INCREMENT ,
        `client_id`  int(11) NULL ,
        `mortgage_id` int(11)  NULL,
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
        $this->dropTable("client_mortgage_application");
	}*/

}