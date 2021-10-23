<?php
/**
 * Created by PhpStorm.
 * User: w3engineers
 * Date: 8/27/14
 * Time: 11:03 AM
 */


require_once 'src/Mailchimp.php';
class InsuranceMailchimp {

    public function AddSubscriber($email,$first_name,$last_name){


        $list_id='e3a7799b2d';
        $mailChimpObj = new Mailchimp();

        $mailChimpListObj = new Mailchimp_Lists($mailChimpObj);

//$MailChimp = new \Drewm\MailChimp('abc123abc123abc123abc123abc123-us1');
        $result = $mailChimpObj->call('lists/subscribe', array(
            'id'                => $list_id,
            'email'             => array('email'=>$email),
            'merge_vars'        => array('FNAME'=>$first_name, 'LNAME'=>$last_name),
            'double_optin'      => false,
            'update_existing'   => true,
            'replace_interests' => false,
            'send_welcome'      => false,
        ));
       // print_r($result);





    }

    public function ViewList(){

        $mailChimpObj = new Mailchimp();
        print_r($mailChimpObj->call('lists/list',array()));
    }



} 