<?php

class m140819_130153_client_relations extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140725_090153_client_relations does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        /*client_actions*/

        $this->execute(" ALTER TABLE `client_actions` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_actions` ADD FOREIGN KEY (`customer_group`) REFERENCES `dropdown_type_of_customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_actions` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );




        /* client_advices */
        $this->execute(" ALTER TABLE `client_advices` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_advices` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        //$this->execute(" ALTER TABLE `client_advices` ADD FOREIGN KEY (`contract_id`) REFERENCES `client_contract_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_advices` ADD FOREIGN KEY (`advisor_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );


        /* client_advisors*/

        $this->execute(" ALTER TABLE `client_advisors` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_advisors` ADD FOREIGN KEY (`function`) REFERENCES `dropdown_functions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_advisors` ADD FOREIGN KEY (`department`) REFERENCES `dropdown_department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_advisors` ADD FOREIGN KEY (`house_type`) REFERENCES `dropdown_property_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_advisors` ADD FOREIGN KEY (`province`) REFERENCES `dropdown_county` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        //$this->execute(" ALTER TABLE `client_advisors` ADD FOREIGN KEY (`contract_id`) REFERENCES `client_contract_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_advisors` ADD FOREIGN KEY (`role`) REFERENCES `dropdown_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );


        /* client_calculations*/
        $this->execute(" ALTER TABLE `client_calculations` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );


        /* client_changes*/
        $this->execute(" ALTER TABLE `client_changes` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_changes` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_changes` ADD FOREIGN KEY (`advisor_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        //$this->execute(" ALTER TABLE `client_changes` ADD FOREIGN KEY (`contract_id`) REFERENCES `client_contract_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );



        /* client_contract_list*/
       // $this->execute(" ALTER TABLE `client_contract_list` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

       // $this->execute(" ALTER TABLE `client_contract_list` ADD FOREIGN KEY (`period`) REFERENCES `dropdown_payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );



        /* client_boss_general*/
        $this->execute(" ALTER TABLE `client_employers_general` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_employers_general` ADD FOREIGN KEY (`advisor_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        /* client_business_income*/
        $this->execute(" ALTER TABLE `client_business_income` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_business_income` ADD FOREIGN KEY (`period`) REFERENCES `dropdown_payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );


        /* client_credit_general*/
        $this->execute(" ALTER TABLE `client_credit_general` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );
        $this->execute(" ALTER TABLE `client_credit_general` ADD FOREIGN KEY (`status`) REFERENCES `dropdown_insurance_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        /* client_credit_contract*/
       /* $this->execute(" ALTER TABLE `client_credit_contract` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_credit_contract` ADD FOREIGN KEY (`credit_type`) REFERENCES `dropdown_type_of_loan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_credit_contract` ADD FOREIGN KEY (`bank`) REFERENCES `dropdown_credit_banks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_credit_contract` ADD FOREIGN KEY (`box`) REFERENCES `dropdown_load_box` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );
        $this->execute(" ALTER TABLE `client_credit_contract` ADD FOREIGN KEY (`credit_id`) REFERENCES `client_credit_general` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );*/




        /* client_damage*/
        $this->execute(" ALTER TABLE `client_damage` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_damage` ADD FOREIGN KEY (`status`) REFERENCES `dropdown_status_damages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_damage` ADD FOREIGN KEY (`insurance_type`) REFERENCES `insurance_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        //$this->execute(" ALTER TABLE `client_damage` ADD FOREIGN KEY (`contract_id`) REFERENCES `client_contract_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );


        /* client_document*/
        $this->execute(" ALTER TABLE `client_document` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_document` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_document_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_document` ADD FOREIGN KEY (`advisor_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        //$this->execute(" ALTER TABLE `client_document` ADD FOREIGN KEY (`contract_id`) REFERENCES `client_contract_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );


        /* client_employers_employee_benefit*/
        /*$this->execute(" ALTER TABLE `client_employers_employee_benefit` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );*/

        /* client_income*/
        $this->execute(" ALTER TABLE `client_income` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_income` ADD FOREIGN KEY (`period`) REFERENCES `dropdown_payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );



        /* insurance_contract*/
        /*$this->execute(" ALTER TABLE `client_insurance_contract` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_insurance_contract` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_type_of_coverage_by_insurance` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_insurance_contract` ADD FOREIGN KEY (`insurance_company`) REFERENCES `dropdown_insurers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_insurance_contract` ADD FOREIGN KEY (`Period`) REFERENCES `dropdown_payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_insurance_contract` ADD FOREIGN KEY (`related`) REFERENCES `client_contract_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );
        $this->execute(" ALTER TABLE `client_insurance_contract` ADD FOREIGN KEY (`insurance_id`) REFERENCES `client_insurance_general` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );*/




        /* client_insurance_general*/
        $this->execute(" ALTER TABLE `client_insurance_general` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_insurance_general` ADD FOREIGN KEY (`advisor_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_insurance_general` ADD FOREIGN KEY (`status`) REFERENCES `dropdown_insurance_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_insurance_general` ADD FOREIGN KEY (`family_composition`) REFERENCES `dropdown_family_composition` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );
        $this->execute(" ALTER TABLE `client_insurance_general` ADD FOREIGN KEY (`insurance_type`) REFERENCES `insurance_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );




        /* client_employers_salary_check*/
        $this->execute(" ALTER TABLE `client_employers_salary_check` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        /* client_employers_schedule*/
        $this->execute(" ALTER TABLE `client_employers_schedule` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );




        /*from sany*/


        /*client_savings*/



        $this->execute(" ALTER TABLE `client_savings` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_savings` ADD FOREIGN KEY (`customer_group`) REFERENCES `dropdown_type_of_customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_savings` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        //$this->execute(" ALTER TABLE `client_savings` ADD FOREIGN KEY (`contract_id`) REFERENCES `client_contract_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_savings` ADD FOREIGN KEY (`advisor_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );



        /*client_requests*/



        $this->execute(" ALTER TABLE `client_requests` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_requests` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_requests` ADD FOREIGN KEY (`advisor_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        //$this->execute(" ALTER TABLE `client_requests` ADD FOREIGN KEY (`contract_id`) REFERENCES `client_contract_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );


        /*client_personal*/



        $this->execute(" ALTER TABLE `client_personal` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_personal` ADD FOREIGN KEY (`marital_status`) REFERENCES `dropdown_marital_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_personal` ADD FOREIGN KEY (`province`) REFERENCES `dropdown_county` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_personal` ADD FOREIGN KEY (`house_type`) REFERENCES `dropdown_property_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_personal` ADD FOREIGN KEY (`group`) REFERENCES `dropdown_type_of_customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_personal` ADD FOREIGN KEY (`subscription`) REFERENCES `dropdown_type_of_service_contract` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_personal` ADD FOREIGN KEY (`education`) REFERENCES `dropdown_education` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_personal` ADD FOREIGN KEY (`bkr_code`) REFERENCES `dropdown_bkr_code` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );
        $this->execute(" ALTER TABLE `client_personal` ADD FOREIGN KEY (`family_of_client`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );
        $this->execute(" ALTER TABLE `client_personal` ADD FOREIGN KEY (`default_advisor`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;");

        $this->execute(" ALTER TABLE `client_personal` ADD FOREIGN KEY (`bank`) REFERENCES `dropdown_banks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );


        /*client_personal_business*/



        $this->execute(" ALTER TABLE `client_personal_business` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_personal_business` ADD FOREIGN KEY (`marital_status`) REFERENCES `dropdown_marital_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_personal_business` ADD FOREIGN KEY (`house_type`) REFERENCES `dropdown_property_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_personal_business` ADD FOREIGN KEY (`province`) REFERENCES `dropdown_county` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_personal_business` ADD FOREIGN KEY (`group`) REFERENCES `dropdown_type_of_customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_personal_business` ADD FOREIGN KEY (`subscription`) REFERENCES `dropdown_type_of_service_contract` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_personal_business` ADD FOREIGN KEY (`education`) REFERENCES `dropdown_education` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_personal_business` ADD FOREIGN KEY (`bkr_code`) REFERENCES `dropdown_bkr_code` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );


        /*client_pension_general*/



        $this->execute(" ALTER TABLE `client_pension_general` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_pension_general` ADD FOREIGN KEY (`advisor_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_pension_general` ADD FOREIGN KEY (`status`) REFERENCES `dropdown_insurance_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_pension_general` ADD FOREIGN KEY (`family_composition`) REFERENCES `dropdown_family_composition` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_pension_general` ADD FOREIGN KEY (`executer`) REFERENCES `dropdown_pension_funds_and_pension_insurers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );


        /*client_pension_contract*/



        /*$this->execute(" ALTER TABLE `client_pension_contract` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_pension_contract` ADD FOREIGN KEY (`pension_id`) REFERENCES `client_pension_general` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_pension_contract` ADD FOREIGN KEY (`insurer_id`) REFERENCES `dropdown_pension_funds_and_pension_insurers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_pension_contract` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_type_of_retirement` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_pension_contract` ADD FOREIGN KEY (`period`) REFERENCES `dropdown_property_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );*/


        /*client_offers*/


        $this->execute(" ALTER TABLE `client_offers` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_offers` ADD FOREIGN KEY (`customer_group`) REFERENCES `dropdown_type_of_customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_offers` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );
        $this->execute(" ALTER TABLE `client_offers` ADD FOREIGN KEY (`contract_id`) REFERENCES `client_contract_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );


        /*client_notes*/


        $this->execute(" ALTER TABLE `client_notes` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        //$this->execute(" ALTER TABLE `client_notes` ADD FOREIGN KEY (`contract_id`) REFERENCES `client_contract_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_notes` ADD FOREIGN KEY (`advisor_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );


        /*client_loyalty*/


        $this->execute(" ALTER TABLE `client_loyalty` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_loyalty` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );


        /*client_mortgage_general*/
        $this->execute(" ALTER TABLE `client_mortgage_general` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_mortgage_general` ADD FOREIGN KEY (`advisor_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_mortgage_general` ADD FOREIGN KEY (`house_type`) REFERENCES `dropdown_property_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );


        /*client_mortgage_contract*/


        /*$this->execute(" ALTER TABLE `client_mortgage_contract` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_mortgage_contract` ADD FOREIGN KEY (`mortgage_id`) REFERENCES `client_mortgage_general` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_mortgage_contract` ADD FOREIGN KEY (`bank`) REFERENCES `dropdown_banks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_mortgage_contract` ADD FOREIGN KEY (`mortgage_type`) REFERENCES `insurance_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_mortgage_contract` ADD FOREIGN KEY (`box`) REFERENCES `dropdown_load_box` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_mortgage_contract` ADD FOREIGN KEY (`insurer_id`) REFERENCES `dropdown_insurer_for_redemption_of_mortgage` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_mortgage_contract` ADD FOREIGN KEY (`redeem_type`) REFERENCES `dropdown_repayment_rortgage_rorm` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_mortgage_contract` ADD FOREIGN KEY (`period`) REFERENCES `dropdown_payment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );*/


        /*client_mortgage_application*/


        /*$this->execute(" ALTER TABLE `client_mortgage_application` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_mortgage_application` ADD FOREIGN KEY (`mortgage_id`) REFERENCES `client_mortgage_general` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );*/


        /*client_insurance_contract_extra_vehicle*/


       // $this->execute(" ALTER TABLE `client_insurance_contract_extra_vehicle` ADD FOREIGN KEY (`insurance_contract_id`) REFERENCES `client_insurance_general` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );


        /*client_insurance_contract_extra_property*/


        //$this->execute(" ALTER TABLE `client_insurance_contract_extra_property` ADD FOREIGN KEY (`insurance_contract_id`) REFERENCES `client_insurance_general` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );



        /*client_insurance_contract_extra_risk*/


       // $this->execute(" ALTER TABLE `client_insurance_contract_extra_risk` ADD FOREIGN KEY (`insurance_contract_id`) REFERENCES `client_insurance_general` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        /*client_employers_general*/
        $this->execute("ALTER TABLE `client_employers_general` ADD FOREIGN KEY (`employment`) REFERENCES `dropdown_type_of_working_contract` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;");

        /*client_business_income*/
        $this->execute("ALTER TABLE `client_business_income` ADD FOREIGN KEY (`social_security_type`) REFERENCES `dropdown_type_of_social_security` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;");

        /*client_personal_business*/
        $this->execute("ALTER TABLE `client_personal_business` ADD FOREIGN KEY (`company_type`) REFERENCES `dropdown_type_of_company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;");

        /*client_families*/
        $this->execute("ALTER TABLE `client_families` ADD FOREIGN KEY (`id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;");
        $this->execute("ALTER TABLE `client_families` ADD FOREIGN KEY (`marital_status`) REFERENCES `dropdown_marital_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;");
        $this->execute(" ALTER TABLE `client_families` ADD FOREIGN KEY (`province`) REFERENCES `dropdown_county` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_families` ADD FOREIGN KEY (`house_type`) REFERENCES `dropdown_property_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_families` ADD FOREIGN KEY (`group`) REFERENCES `dropdown_type_of_customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_families` ADD FOREIGN KEY (`subscription`) REFERENCES `dropdown_type_of_service_contract` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_families` ADD FOREIGN KEY (`education`) REFERENCES `dropdown_education` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_families` ADD FOREIGN KEY (`bkr_code`) REFERENCES `dropdown_bkr_code` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

        $this->execute(" ALTER TABLE `client_families` ADD FOREIGN KEY (`family_user_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;"    );

    }

	public function safeDown()
	{

        /*client_actions*/
        $this->execute(" ALTER TABLE `client_actions` DROP FOREIGN KEY `client_actions_ibfk_3`;  ");

        $this->execute(" ALTER TABLE `client_actions` DROP FOREIGN KEY `client_actions_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_actions` DROP FOREIGN KEY `client_actions_ibfk_2`;  ");

        /*client_advices*/

        $this->execute(" ALTER TABLE `client_advices` DROP FOREIGN KEY `client_advices_ibfk_4`;  ");

        $this->execute(" ALTER TABLE `client_advices` DROP FOREIGN KEY `client_advices_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_advices` DROP FOREIGN KEY `client_advices_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_advices` DROP FOREIGN KEY `client_advices_ibfk_3`;  ");


        /*client_advisors*/
        $this->execute(" ALTER TABLE `client_advisors` DROP FOREIGN KEY `client_advisors_ibfk_7`;  ");

        $this->execute(" ALTER TABLE `client_advisors` DROP FOREIGN KEY `client_advisors_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_advisors` DROP FOREIGN KEY `client_advisors_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_advisors` DROP FOREIGN KEY `client_advisors_ibfk_3`;  ");

        $this->execute(" ALTER TABLE `client_advisors` DROP FOREIGN KEY `client_advisors_ibfk_4`;  ");

        $this->execute(" ALTER TABLE `client_advisors` DROP FOREIGN KEY `client_advisors_ibfk_5`;  ");

        $this->execute(" ALTER TABLE `client_advisors` DROP FOREIGN KEY `client_advisors_ibfk_6`;  ");

        /*client_business_income*/
        $this->execute(" ALTER TABLE `client_business_income` DROP FOREIGN KEY `client_business_income_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_business_income` DROP FOREIGN KEY `client_business_income_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_calculations` DROP FOREIGN KEY `client_calculations_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_changes` DROP FOREIGN KEY `client_changes_ibfk_4`;  ");

        $this->execute(" ALTER TABLE `client_changes` DROP FOREIGN KEY `client_changes_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_changes` DROP FOREIGN KEY `client_changes_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_changes` DROP FOREIGN KEY `client_changes_ibfk_3`;  ");

        $this->execute(" ALTER TABLE `client_contract_list` DROP FOREIGN KEY `client_contract_list_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_contract_list` DROP FOREIGN KEY `client_contract_list_ibfk_1`;  ");

        /*$this->execute(" ALTER TABLE `client_credit_contract` DROP FOREIGN KEY `client_credit_contract_ibfk_5`;  ");

        $this->execute(" ALTER TABLE `client_credit_contract` DROP FOREIGN KEY `client_credit_contract_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_credit_contract` DROP FOREIGN KEY `client_credit_contract_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_credit_contract` DROP FOREIGN KEY `client_credit_contract_ibfk_3`;  ");

        $this->execute(" ALTER TABLE `client_credit_contract` DROP FOREIGN KEY `client_credit_contract_ibfk_4`;  ");*/

        $this->execute(" ALTER TABLE `client_credit_general` DROP FOREIGN KEY `client_credit_general_ibfk_2`;  ");
        $this->execute(" ALTER TABLE `client_credit_general` DROP FOREIGN KEY `client_credit_general_ibfk_1`;  ");


        $this->execute(" ALTER TABLE `client_damage` DROP FOREIGN KEY `client_damage_ibfk_4`;  ");

        $this->execute(" ALTER TABLE `client_damage` DROP FOREIGN KEY `client_damage_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_damage` DROP FOREIGN KEY `client_damage_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_damage` DROP FOREIGN KEY `client_damage_ibfk_3`;  ");

        $this->execute(" ALTER TABLE `client_document` DROP FOREIGN KEY `client_document_ibfk_4`;  ");

        $this->execute(" ALTER TABLE `client_document` DROP FOREIGN KEY `client_document_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_document` DROP FOREIGN KEY `client_document_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_document` DROP FOREIGN KEY `client_document_ibfk_3`;  ");

       /* $this->execute(" ALTER TABLE `client_employers_employee_benefit` DROP FOREIGN KEY `client_employers_employee_benefit_ibfk_1`;  ");*/

        $this->execute(" ALTER TABLE `client_employers_general` DROP FOREIGN KEY `client_employers_general_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_employers_general` DROP FOREIGN KEY `client_employers_general_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_employers_salary_check` DROP FOREIGN KEY `client_employers_salary_check_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_employers_schedule` DROP FOREIGN KEY `client_employers_schedule_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_income` DROP FOREIGN KEY `client_income_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_income` DROP FOREIGN KEY `client_income_ibfk_1`;  ");

      /*  $this->execute(" ALTER TABLE `client_insurance_contract` DROP FOREIGN KEY `client_insurance_contract_ibfk_6`;  ");

        $this->execute(" ALTER TABLE `client_insurance_contract` DROP FOREIGN KEY `client_insurance_contract_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_insurance_contract` DROP FOREIGN KEY `client_insurance_contract_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_insurance_contract` DROP FOREIGN KEY `client_insurance_contract_ibfk_3`;  ");

        $this->execute(" ALTER TABLE `client_insurance_contract` DROP FOREIGN KEY `client_insurance_contract_ibfk_4`;  ");

        $this->execute(" ALTER TABLE `client_insurance_contract` DROP FOREIGN KEY `client_insurance_contract_ibfk_5`;  ");*/



        /*client_savings*/

        $this->execute(" ALTER TABLE `client_savings` DROP FOREIGN KEY `client_savings_ibfk_5`;  ");

        $this->execute(" ALTER TABLE `client_savings` DROP FOREIGN KEY `client_savings_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_savings` DROP FOREIGN KEY `client_savings_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_savings` DROP FOREIGN KEY `client_savings_ibfk_3`;  ");

        $this->execute(" ALTER TABLE `client_savings` DROP FOREIGN KEY `client_savings_ibfk_4`;  ");

        /*client_requests*/

        $this->execute(" ALTER TABLE `client_requests` DROP FOREIGN KEY `client_requests_ibfk_4`;  ");

        $this->execute(" ALTER TABLE `client_requests` DROP FOREIGN KEY `client_requests_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_requests` DROP FOREIGN KEY `client_requests_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_requests` DROP FOREIGN KEY `client_requests_ibfk_3`;  ");

        /*client_personal_business*/
        $this->execute(" ALTER TABLE `client_personal_business` DROP FOREIGN KEY `client_personal_business_ibfk_8`;  ");

        $this->execute(" ALTER TABLE `client_personal_business` DROP FOREIGN KEY `client_personal_business_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_personal_business` DROP FOREIGN KEY `client_personal_business_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_personal_business` DROP FOREIGN KEY `client_personal_business_ibfk_3`;  ");

        $this->execute(" ALTER TABLE `client_personal_business` DROP FOREIGN KEY `client_personal_business_ibfk_4`;  ");

        $this->execute(" ALTER TABLE `client_personal_business` DROP FOREIGN KEY `client_personal_business_ibfk_5`;  ");

        $this->execute(" ALTER TABLE `client_personal_business` DROP FOREIGN KEY `client_personal_business_ibfk_6`;  ");

        $this->execute(" ALTER TABLE `client_personal_business` DROP FOREIGN KEY `client_personal_business_ibfk_7`;  ");


        /*client_personal*/
        $this->execute(" ALTER TABLE `client_personal` DROP FOREIGN KEY `client_personal_ibfk_11`;  ");

        $this->execute(" ALTER TABLE `client_personal` DROP FOREIGN KEY `client_personal_ibfk_10`;  ");

        $this->execute(" ALTER TABLE `client_personal` DROP FOREIGN KEY `client_personal_ibfk_9`;  ");

        $this->execute(" ALTER TABLE `client_personal` DROP FOREIGN KEY `client_personal_ibfk_8`;  ");

        $this->execute(" ALTER TABLE `client_personal` DROP FOREIGN KEY `client_personal_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_personal` DROP FOREIGN KEY `client_personal_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_personal` DROP FOREIGN KEY `client_personal_ibfk_3`;  ");

        $this->execute(" ALTER TABLE `client_personal` DROP FOREIGN KEY `client_personal_ibfk_4`;  ");

        $this->execute(" ALTER TABLE `client_personal` DROP FOREIGN KEY `client_personal_ibfk_5`;  ");

        $this->execute(" ALTER TABLE `client_personal` DROP FOREIGN KEY `client_personal_ibfk_6`;  ");

        $this->execute(" ALTER TABLE `client_personal` DROP FOREIGN KEY `client_personal_ibfk_7`;  ");


        /*client_pension_general*/
        $this->execute(" ALTER TABLE `client_pension_general` DROP FOREIGN KEY `client_pension_general_ibfk_5`;  ");

        $this->execute(" ALTER TABLE `client_pension_general` DROP FOREIGN KEY `client_pension_general_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_pension_general` DROP FOREIGN KEY `client_pension_general_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_pension_general` DROP FOREIGN KEY `client_pension_general_ibfk_3`;  ");

        $this->execute(" ALTER TABLE `client_pension_general` DROP FOREIGN KEY `client_pension_general_ibfk_4`;  ");


        /*client_pension_contract*/
        /*$this->execute(" ALTER TABLE `client_pension_contract` DROP FOREIGN KEY `client_pension_contract_ibfk_5`;  ");

        $this->execute(" ALTER TABLE `client_pension_contract` DROP FOREIGN KEY `client_pension_contract_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_pension_contract` DROP FOREIGN KEY `client_pension_contract_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_pension_contract` DROP FOREIGN KEY `client_pension_contract_ibfk_3`;  ");

        $this->execute(" ALTER TABLE `client_pension_contract` DROP FOREIGN KEY `client_pension_contract_ibfk_4`;  ");*/


        /*client_offers*/
        $this->execute(" ALTER TABLE `client_offers` DROP FOREIGN KEY `client_offers_ibfk_3`;  ");

        $this->execute(" ALTER TABLE `client_offers` DROP FOREIGN KEY `client_offers_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_offers` DROP FOREIGN KEY `client_offers_ibfk_2`;  ");


        /*client_notes*/
        $this->execute(" ALTER TABLE `client_notes` DROP FOREIGN KEY `client_notes_ibfk_3`;  ");

        $this->execute(" ALTER TABLE `client_notes` DROP FOREIGN KEY `client_notes_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_notes` DROP FOREIGN KEY `client_notes_ibfk_2`;  ");


        /*client_mortgage_general*/
        $this->execute(" ALTER TABLE `client_mortgage_general` DROP FOREIGN KEY `client_mortgage_general_ibfk_3`;  ");

        $this->execute(" ALTER TABLE `client_mortgage_general` DROP FOREIGN KEY `client_mortgage_general_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_mortgage_general` DROP FOREIGN KEY `client_mortgage_general_ibfk_2`;  ");


        /*client_mortgage_contract*/
        /*$this->execute(" ALTER TABLE `client_mortgage_contract` DROP FOREIGN KEY `client_mortgage_contract_ibfk_8`;  ");

        $this->execute(" ALTER TABLE `client_mortgage_contract` DROP FOREIGN KEY `client_mortgage_contract_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_mortgage_contract` DROP FOREIGN KEY `client_mortgage_contract_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_mortgage_contract` DROP FOREIGN KEY `client_mortgage_contract_ibfk_3`;  ");

        $this->execute(" ALTER TABLE `client_mortgage_contract` DROP FOREIGN KEY `client_mortgage_contract_ibfk_4`;  ");

        $this->execute(" ALTER TABLE `client_mortgage_contract` DROP FOREIGN KEY `client_mortgage_contract_ibfk_5`;  ");

        $this->execute(" ALTER TABLE `client_mortgage_contract` DROP FOREIGN KEY `client_mortgage_contract_ibfk_6`;  ");

        $this->execute(" ALTER TABLE `client_mortgage_contract` DROP FOREIGN KEY `client_mortgage_contract_ibfk_7`;  ");*/


        /*client_mortgage_application*/
       /* $this->execute(" ALTER TABLE `client_mortgage_application` DROP FOREIGN KEY `client_mortgage_application_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_mortgage_application` DROP FOREIGN KEY `client_mortgage_application_ibfk_1`;  ");*/


        /*client_loyalty*/
        $this->execute(" ALTER TABLE `client_loyalty` DROP FOREIGN KEY `client_loyalty_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_loyalty` DROP FOREIGN KEY `client_loyalty_ibfk_1`;  ");


        /*client_insurance_general*/
        $this->execute(" ALTER TABLE `client_insurance_general` DROP FOREIGN KEY `client_insurance_general_ibfk_5`;  ");
        $this->execute(" ALTER TABLE `client_insurance_general` DROP FOREIGN KEY `client_insurance_general_ibfk_4`;  ");

        $this->execute(" ALTER TABLE `client_insurance_general` DROP FOREIGN KEY `client_insurance_general_ibfk_1`;  ");

        $this->execute(" ALTER TABLE `client_insurance_general` DROP FOREIGN KEY `client_insurance_general_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_insurance_general` DROP FOREIGN KEY `client_insurance_general_ibfk_3`;  ");


        /*client_insurance_contract_extra_vehicle*/
        $this->execute(" ALTER TABLE `client_insurance_contract_extra_vehicle` DROP FOREIGN KEY `client_insurance_contract_extra_vehicle_ibfk_1`;  ");


        /*client_insurance_contract_extra_risk*/
        $this->execute(" ALTER TABLE `client_insurance_contract_extra_risk` DROP FOREIGN KEY `client_insurance_contract_extra_risk_ibfk_1`;  ");


        /*client_insurance_contract_extra_property*/
        $this->execute(" ALTER TABLE `client_insurance_contract_extra_property` DROP FOREIGN KEY `client_insurance_contract_extra_property_ibfk_1`;  ");

        /*client_employers_general*/
        $this->execute("ALTER TABLE `client_employers_general` DROP FOREIGN KEY `client_employers_general_ibfk_3`;");

        /*client_business_income*/
        $this->execute("ALTER TABLE `client_business_income` DROP FOREIGN KEY `client_business_income_ibfk_3`;");

        /*client_personal_business*/
        $this->execute("ALTER TABLE `client_personal_business` DROP FOREIGN KEY `client_personal_business_ibfk_9`;");

        /*client_families*/
        $this->execute("ALTER TABLE `client_families` DROP FOREIGN KEY `client_families_ibfk_1`");

        $this->execute(" ALTER TABLE `client_families` DROP FOREIGN KEY `client_families_ibfk_2`;  ");

        $this->execute(" ALTER TABLE `client_families` DROP FOREIGN KEY `client_families_ibfk_3`;  ");

        $this->execute(" ALTER TABLE `client_families` DROP FOREIGN KEY `client_families_ibfk_4`;  ");

        $this->execute(" ALTER TABLE `client_families` DROP FOREIGN KEY `client_families_ibfk_5`;  ");

        $this->execute(" ALTER TABLE `client_families` DROP FOREIGN KEY `client_families_ibfk_6`;  ");

        $this->execute(" ALTER TABLE `client_families` DROP FOREIGN KEY `client_families_ibfk_7`;  ");

        $this->execute(" ALTER TABLE `client_families` DROP FOREIGN KEY `client_families_ibfk_8`;  ");

        $this->execute(" ALTER TABLE `client_families` DROP FOREIGN KEY `client_families_ibfk_9`;  ");


    }

}