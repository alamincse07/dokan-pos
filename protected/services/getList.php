<?php
/**
 * Created by PhpStorm.
 * User: Sabbir
 * Date: 8/15/14
 * Time: 3:04 PM
 */

require_once 'src/Mailchimp.php';

$mailChimpObj = new Mailchimp();

$mailChimpListObj = new Mailchimp_Lists($mailChimpObj);





//$MailChimp = new \Drewm\MailChimp('abc123abc123abc123abc123abc123-us1');
$result = $mailChimpObj->call('lists/subscribe', array(
    'id'                => 'e3a7799b2d',
    'email'             => array('email'=>'sany@yahoo.com'),
    'merge_vars'        => array('FNAME'=>'sany', 'LNAME'=>'Jones'),
    'double_optin'      => false,
    'update_existing'   => true,
    'replace_interests' => false,
    'send_welcome'      => false,
));
print_r($result);
print "<pre>";

print_r($mailChimpObj->call('lists/list',array()));
//print_r($mailChimpListObj->getList());