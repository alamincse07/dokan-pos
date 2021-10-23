<?php
/**
 * Created by PhpStorm.
 * User: w3engineers
 * Date: 9/18/2014
 * Time: 1:49 PM
 */

require_once 'src/Mandrill.php';
class InsuranceMandrill {


    public function SendEmail($data){

        $Mandrill = new Mandrill();

        $params = array(
            "html" => @$data['html'],
            "text" => 'Your message',
            "from_email" => @$data['from_email'],
            "from_name" => @$data['from_name'],
            "subject" => @$data['subject'],
            "to" => array(
                array("email" => @$data['email'])
            ),
            "track_opens" => true,
            "track_clicks" => true,
            "auto_text" => true,
        );

        # for sending attachment
        if(isset($data['attachments']) && is_array($data['attachments']) ){
            $params['attachments']=array(
                $data['attachments']
            );
        }

        $res=$Mandrill->messages->send($params, true);
    }
} 