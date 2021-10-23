<?php

class m141029_064240_changed_mortgage_general_table extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m141029_064240_changed_mortgage_general_table does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
DROP TABLE IF EXISTS `client_mortgage_general`;
CREATE TABLE `client_mortgage_general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `advisor_id` int(11) DEFAULT NULL,
  `portal` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `provision` varchar(255) DEFAULT NULL,
  `is_active` enum('Yes','No') DEFAULT NULL,
  `house_type` int(11) DEFAULT NULL,
  `market_value` decimal(20,2) DEFAULT NULL,
  `execution_value` decimal(20,2) DEFAULT NULL,
  `free_by_name` decimal(20,2) DEFAULT NULL,
  `woz_value` decimal(20,2) DEFAULT NULL,
  `notary` varchar(255) DEFAULT NULL,
  `notary_address` varchar(255) DEFAULT NULL,
  `notary_email` varchar(255) DEFAULT NULL,
  `notary_telephone_number` varchar(255) DEFAULT NULL,
  `appraiser` varchar(255) DEFAULT NULL,
  `appraiser_address` varchar(255) DEFAULT NULL,
  `appraiser_email` varchar(255) DEFAULT NULL,
  `appraiser_telephone_number` varchar(255) DEFAULT NULL,
  `general_conditions` varchar(255) DEFAULT NULL,
  `policy` varchar(255) DEFAULT NULL,
  `automatic_incasso` enum('Yes','No') DEFAULT NULL,
  `incasso` int(11) DEFAULT NULL,
  `bank` int(11) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `bank_security_date` date DEFAULT NULL,
  `resolutive_condition` date DEFAULT NULL,
  `overtake_date` date DEFAULT NULL,
  `stocktaking_date` date DEFAULT NULL,
  `stocktaking_agreement` varchar(255) DEFAULT NULL,
  `stocktaking_file` varchar(255) DEFAULT NULL,
  `stocktaking_description` varchar(255) DEFAULT NULL,
  `mortgage_calculation_date` date DEFAULT NULL,
  `mortgage_calculation_agreement` varchar(255) DEFAULT NULL,
  `mortgage_calculation_file` varchar(255) DEFAULT NULL,
  `mortgage_calculation_description` varchar(255) DEFAULT NULL,
  `mortgage_quotation_date` date DEFAULT NULL,
  `mortgage_quotation_agreement` varchar(255) DEFAULT NULL,
  `mortgage_quotation_file` varchar(255) DEFAULT NULL,
  `mortgage_quotation_description` varchar(255) DEFAULT NULL,
  `sign_mortgage_quotation` date DEFAULT NULL,
  `sign_mortgage_quotation_file` varchar(255) DEFAULT NULL,
  `sign_mortgage_life_insurance` date DEFAULT NULL,
  `sign_mortgage_life_insurance_file` varchar(255) DEFAULT NULL,
  `sign_mortgage_investment_insurance` date DEFAULT NULL,
  `sign_mortgage_investment_insurance_file` varchar(255) DEFAULT NULL,
  `sign_mortgage_risk_analyse` date DEFAULT NULL,
  `sign_mortgage_risk_analyse_file` varchar(255) DEFAULT NULL,
  `sign_estimation_assignment` date DEFAULT NULL,
  `sign_estimation_assignment_file` varchar(255) DEFAULT NULL,
  `sign_employment_invoice` date DEFAULT NULL,
  `sign_employment_invoice_file` varchar(255) DEFAULT NULL,
  `sign_advice_report` date DEFAULT NULL,
  `sign_advice_report_file` varchar(255) DEFAULT NULL,
  `documents_employers_statement_applicant` date DEFAULT NULL,
  `documents_employers_statement_applicant_file` varchar(255) DEFAULT NULL,
  `documents_employers_statement_partner` date DEFAULT NULL,
  `documents_employers_statement_partner_file` varchar(255) DEFAULT NULL,
  `documents_health_statement_applicant` date DEFAULT NULL,
  `documents_health_statement_applicant_file` varchar(255) DEFAULT NULL,
  `documents_health_statement_partner` date DEFAULT NULL,
  `documents_health_statement_partner_file` varchar(255) DEFAULT NULL,
  `documents_payslip_applicant` date DEFAULT NULL,
  `documents_payslip_applicant_file` varchar(255) DEFAULT NULL,
  `documents_payslip_partner` date DEFAULT NULL,
  `documents_payslip_partner_file` varchar(255) DEFAULT NULL,
  `documents_estimation_report` date DEFAULT NULL,
  `documents_estimation_report_file` varchar(255) DEFAULT NULL,
  `documents_rebuildings_specification` date DEFAULT NULL,
  `documents_rebuildings_specification_file` varchar(255) DEFAULT NULL,
  `acception_mortgage_quotation` date DEFAULT NULL,
  `acception_mortgage_quotation_file` varchar(255) DEFAULT NULL,
  `acception_term_life_insurance` date DEFAULT NULL,
  `acception_term_life_insurance_file` varchar(255) DEFAULT NULL,
  `acception_bank_security` date DEFAULT NULL,
  `acception_bank_security_file` varchar(255) DEFAULT NULL,
  `acception_agreement_notary` date DEFAULT NULL,
  `acception_agreement_notary_file` varchar(255) DEFAULT NULL,
  `acception_mortgage_certificate` date DEFAULT NULL,
  `acception_mortgage_certificate_file` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `debt_bank` int(10) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `advisor_id` (`advisor_id`),
  KEY `house_type` (`house_type`),
  CONSTRAINT `client_mortgage_general_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `client_mortgage_general_ibfk_2` FOREIGN KEY (`advisor_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `client_mortgage_general_ibfk_3` FOREIGN KEY (`house_type`) REFERENCES `dropdown_property_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;




        ");
	}

	public function safeDown()
	{
	}

}