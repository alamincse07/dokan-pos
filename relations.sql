/*client_actions*/

ALTER TABLE `client_actions` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_actions` ADD FOREIGN KEY (`customer_group`) REFERENCES `dropdown_type_of_customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_actions` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;




/* client_advices */
ALTER TABLE `client_advices` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_advices` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_advices` ADD FOREIGN KEY (`contract_id`) REFERENCES `client_contracts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_advices` ADD FOREIGN KEY (`advisor_id`) REFERENCES `client_advisors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


 /* client_advisors*/

ALTER TABLE `client_advisors` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_advisors` ADD FOREIGN KEY (`function`) REFERENCES `dropdown_functions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_advisors` ADD FOREIGN KEY (`department`) REFERENCES `dropdown_department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_advisors` ADD FOREIGN KEY (`house_type`) REFERENCES `dropdown_property_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_advisors` ADD FOREIGN KEY (`province`) REFERENCES `dropdown_county` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_advisors` ADD FOREIGN KEY (`contract_id`) REFERENCES `client_contracts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_advisors` ADD FOREIGN KEY (`role`) REFERENCES `dropdown_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


 /* client_calculations*/
ALTER TABLE `client_calculations` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


 /* client_changes*/
ALTER TABLE `client_changes` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_changes` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_changes` ADD FOREIGN KEY (`advisor_id`) REFERENCES `client_advisors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_changes` ADD FOREIGN KEY (`contract_id`) REFERENCES `client_contracts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;



 /* client_contracts*/
ALTER TABLE `client_contracts` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_contracts` ADD FOREIGN KEY (`period`) REFERENCES `dropdown_payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;



 /* client_boss_general*/
ALTER TABLE `client_employers_general` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_employers_general` ADD FOREIGN KEY (`advisor_id`) REFERENCES `client_advisors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

 /* client_business_income*/
ALTER TABLE `client_business_income` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_business_income` ADD FOREIGN KEY (`period`) REFERENCES `dropdown_payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


 /* client_credit_general*/
ALTER TABLE `client_credit_general` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

 /* client_credit_contract*/
ALTER TABLE `client_credit_contract` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_credit_contract` ADD FOREIGN KEY (`credit_type`) REFERENCES `dropdown_type_of_loan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_credit_contract` ADD FOREIGN KEY (`bank`) REFERENCES `dropdown_credit_banks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_credit_contract` ADD FOREIGN KEY (`box`) REFERENCES `dropdown_load_box` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE `client_credit_contract` ADD FOREIGN KEY (`credit_id`) REFERENCES `client_credit_general` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;




 /* client_damage*/
ALTER TABLE `client_damage` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_damage` ADD FOREIGN KEY (`status`) REFERENCES `dropdown_status_damages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_damage` ADD FOREIGN KEY (`insurance_type`) REFERENCES `dropdown_type_of_insurance` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_damage` ADD FOREIGN KEY (`contract_id`) REFERENCES `client_contracts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


 /* client_document*/
ALTER TABLE `client_document` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_document` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_document_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_document` ADD FOREIGN KEY (`advisor_id`) REFERENCES `client_advisors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_document` ADD FOREIGN KEY (`contract_id`) REFERENCES `client_contracts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


 /* client_employers_employee_benefit*/
ALTER TABLE `client_employers_employee_benefit` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

 /* client_income*/
ALTER TABLE `client_income` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_income` ADD FOREIGN KEY (`period`) REFERENCES `dropdown_payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;



 /* insurance_contract*/
ALTER TABLE `client_insurance_contract` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_insurance_contract` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_type_of_coverage_by_insurance` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_insurance_contract` ADD FOREIGN KEY (`insurance_company`) REFERENCES `dropdown_insurers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_insurance_contract` ADD FOREIGN KEY (`Period`) REFERENCES `dropdown_payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_insurance_contract` ADD FOREIGN KEY (`related`) REFERENCES `client_contracts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE `client_insurance_contract` ADD FOREIGN KEY (`insurance_id`) REFERENCES `client_insurance_general` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;




 /* client_insurance_general*/
ALTER TABLE `client_insurance_general` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_insurance_general` ADD FOREIGN KEY (`advisor_id`) REFERENCES `client_advisors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_insurance_general` ADD FOREIGN KEY (`status`) REFERENCES `dropdown_insurance_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_insurance_general` ADD FOREIGN KEY (`family_composition`) REFERENCES `dropdown_family_composition` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;




 /* client_employers_salary_check*/
ALTER TABLE `client_employers_salary_check` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

 /* client_employers_schedule*/
ALTER TABLE `client_employers_schedule` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;




/*from sany*/


/*client_savings*/



ALTER TABLE `client_savings` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_savings` ADD FOREIGN KEY (`customer_group`) REFERENCES `dropdown_type_of_customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_savings` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_savings` ADD FOREIGN KEY (`contract_id`) REFERENCES `client_contracts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_savings` ADD FOREIGN KEY (`advisor_id`) REFERENCES `client_advisors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;



/*client_requests*/



ALTER TABLE `client_requests` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_requests` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_requests` ADD FOREIGN KEY (`advisor_id`) REFERENCES `client_advisors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_requests` ADD FOREIGN KEY (`contract_id`) REFERENCES `client_contracts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


/*client_personal*/



ALTER TABLE `client_personal` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_personal` ADD FOREIGN KEY (`marital_status`) REFERENCES `dropdown_marital_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_personal` ADD FOREIGN KEY (`province`) REFERENCES `dropdown_county` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_personal` ADD FOREIGN KEY (`house_type`) REFERENCES `dropdown_property_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_personal` ADD FOREIGN KEY (`group`) REFERENCES `dropdown_type_of_customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_personal` ADD FOREIGN KEY (`subscription`) REFERENCES `dropdown_type_of_service_contract` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_personal` ADD FOREIGN KEY (`education`) REFERENCES `dropdown_education` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_personal` ADD FOREIGN KEY (`bkr_code`) REFERENCES `dropdown_bkr_code` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


/*client_personal_business*/



ALTER TABLE `client_personal_business` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_personal_business` ADD FOREIGN KEY (`marital_status`) REFERENCES `dropdown_marital_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_personal_business` ADD FOREIGN KEY (`house_type`) REFERENCES `dropdown_property_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_personal_business` ADD FOREIGN KEY (`province`) REFERENCES `dropdown_county` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_personal_business` ADD FOREIGN KEY (`group`) REFERENCES `dropdown_type_of_customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_personal_business` ADD FOREIGN KEY (`subscription`) REFERENCES `dropdown_type_of_service_contract` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_personal_business` ADD FOREIGN KEY (`education`) REFERENCES `dropdown_education` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_personal_business` ADD FOREIGN KEY (`bkr_code`) REFERENCES `dropdown_bkr_code` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


/*client_pension_general*/



ALTER TABLE `client_pension_general` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_pension_general` ADD FOREIGN KEY (`advisor_id`) REFERENCES `client_advisors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_pension_general` ADD FOREIGN KEY (`status`) REFERENCES `dropdown_insurance_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_pension_general` ADD FOREIGN KEY (`family_composition`) REFERENCES `dropdown_family_composition` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_pension_general` ADD FOREIGN KEY (`executer`) REFERENCES `dropdown_pension_funds_and_pension_insurers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


/*client_pension_contract*/



ALTER TABLE `client_pension_contract` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_pension_contract` ADD FOREIGN KEY (`pension_id`) REFERENCES `client_pension_general` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_pension_contract` ADD FOREIGN KEY (`insurer_id`) REFERENCES `dropdown_pension_funds_and_pension_insurers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_pension_contract` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_type_of_retirement` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_pension_contract` ADD FOREIGN KEY (`period`) REFERENCES `dropdown_property_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


/*client_offers*/


ALTER TABLE `client_offers` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_offers` ADD FOREIGN KEY (`customer_group`) REFERENCES `dropdown_type_of_customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_offers` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


/*client_notes*/


ALTER TABLE `client_notes` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_notes` ADD FOREIGN KEY (`contract_id`) REFERENCES `client_contracts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_notes` ADD FOREIGN KEY (`advisor_id`) REFERENCES `client_advisors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


/*client_loyalty*/


ALTER TABLE `client_loyalty` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_loyalty` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


/*client_mortgage_contract*/


ALTER TABLE `client_mortgage_contract` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_mortgage_contract` ADD FOREIGN KEY (`mortgage_id`) REFERENCES `client_mortgage_general` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_mortgage_contract` ADD FOREIGN KEY (`bank`) REFERENCES `dropdown_banks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_mortgage_contract` ADD FOREIGN KEY (`mortgage_type`) REFERENCES `dropdown_type_of_insurance` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_mortgage_contract` ADD FOREIGN KEY (`box`) REFERENCES `dropdown_load_box` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_mortgage_contract` ADD FOREIGN KEY (`insurer_id`) REFERENCES `dropdown_insurer_for_redemption_of_mortgage` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_mortgage_contract` ADD FOREIGN KEY (`redeem_type`) REFERENCES `dropdown_repayment_rortgage_rorm` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_mortgage_contract` ADD FOREIGN KEY (`period`) REFERENCES `dropdown_payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


/*client_mortgage_application*/


ALTER TABLE `client_mortgage_application` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `client_mortgage_application` ADD FOREIGN KEY (`mortgage_id`) REFERENCES `client_mortgage_general` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


/*client_insurance_contract_extra_vehicle*/


ALTER TABLE `client_insurance_contract_extra_vehicle` ADD FOREIGN KEY (`insurance_contract_id`) REFERENCES `client_insurance_contract` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


/*client_insurance_contract_extra_property*/


ALTER TABLE `client_insurance_contract_extra_property` ADD FOREIGN KEY (`insurance_contract_id`) REFERENCES `client_insurance_contract` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;



/*client_insurance_contract_extra_risk*/


ALTER TABLE `client_insurance_contract_extra_risk` ADD FOREIGN KEY (`insurance_contract_id`) REFERENCES `client_insurance_contract` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;






















