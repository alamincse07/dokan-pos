<?php
/**
 * Created by PhpStorm.
 * User: Sabbir
 * Date: 7/7/14
 * Time: 1:06 PM
 */

class Generic {

    /**
     * Set Trace
     * @param $data
     * @param bool $die
     */
    public static function _setTrace($data=null,$die=true){
        if(is_array($data) or is_object($data)){
            print "<pre>";
            print_r($data);
            print "</pre>";
        }else{
            print $data;
        }
        print "<hr />";
        if($die){
            exit();
        }
    }

    // make common transaction
    public static function JomaTransaction($cid,$name,$amount, $showtojoma=false){
        $manager= Yii::app()->session['user'];
       
        $today= date('Y-m-d');
        $inq="update  customer_due_information   set amount=(amount-$amount),manager='$manager',date='$today'  where  id=$cid" ;
        Yii::app()->db->createCommand($inq)->execute();

        $cq="insert into customer_transaction set customer_id=$cid, date='$today', amount=$amount,transaction_type='PAID'";
        $re2s=Yii::app()->db->createCommand($cq)->execute();

        if($showtojoma){
            $q="insert into  daily_add_amount set category='DUE',name='$name',amount=$amount,taken_by='$manager',date='$today' " ;
            $res=Yii::app()->db->createCommand($q)->execute();
        }
       // print($re2s);
    }

    /**
     * @param $model
     * @return mixed
     * to get the language code
     */
    public static function _getLan($model)
    {
       $modelName=get_class($model);
        $model=new $modelName;
        return $model->findAll();
    }

    /**
     * Send email
     * @param $content
     * @param $subject
     * @param $to
     * @param string $from
     * @return bool
     */
    //TODO : change site default email for from parameter as required
    public static function sendMailold($content, $subject, $to, $from="MijnKees.nl <noreply@mijnkees.nl>")
    {
       // die("fgsdgdfgd");
        $body='<!DOCTYPE html>
                <html>
                <head>
                    <title>$subject</title>
                </head>
                <body>
                    $content
            </body>
                </html>';

        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

        // Additional headers
        #$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
        //$headers .= 'To: '.$to. "\r\n";
        #$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
        $headers .= 'From: '.$from . "\r\n";
        #$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
        #$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

        // Mail it
        if(@mail($to, $subject, $body, $headers, '-f noreply@mijnkees.nl')){
            return true;
        }
    }
    public static function sendMail($data,$message_table_insert=false)
    {

        $attachment=false;

        //Generic::_setTrace($data);
        // for additional message table insert

        if($message_table_insert){

            $model = new ClientMessages();
            $model->client_id = $data['client_id'];
            $model->advisor_id = $data['advisor_id'];
            $model->title = $data['subject'];
            $model->date = date('Y-m-d');
            $model->message_type = 1;
            $model->text= strip_tags($data['html']);
            $model->save();
        }

        // for mail send
        if(isset($data['email'])  && $data['email']!='' && isset($data['from_email']) && $data['from_email']!=''){

            if(isset($data['attachment_file']) && $data['attachment_file'] && $data['attachment_file']!=''){
                $Config = new Config();
                $path=dirname(__FILE__).DIRECTORY_SEPARATOR.'../../';
               // die( $path);
                //$path=Yii::app()->request->baseUrl."/";
                $path=$path.$Config->file_uploaded_path.'ClientMessages'.'/';
                $attachment = file_get_contents($path.$data['attachment_file']);
                $attachment_encoded = base64_encode($attachment);
                //Generic::_setTrace($attachment_encoded,false);
                $path_parts = pathinfo($data['attachment_file']);
                $extension=$path_parts['extension'];
                //Generic::_setTrace($extension);
                $attachment=array(
                    'content' => $attachment_encoded,
                    'type' => "application/".$extension,
                    'name' => 'attachment.'.$extension,
                );

            }
            $data['attachments']=$attachment;
            require_once dirname(__FILE__)."/../services/InsuranceMandrill.php";
            $Mandrill= new InsuranceMandrill();

            $Mandrill->SendEmail($data);

        }



    }


    /**
     * @param $image
     * @param $uid
     * @param bool $force
     */
    public static function setUserImage($image,$uid, $force=false)
    {
        if(Yii::app()->user->getId()==$uid or $force===true)
        {
            Yii::app()->session['user_image'] = $image;
        }

    }

    /**
     * @return string
     */
    public static function getUserImage()
    {
        if(!empty(Yii::app()->session['user_image'])):
            return Yii::app()->request->baseUrl."/uploaded/profile-images/".Yii::app()->session['user_image'];
        else:
            return Yii::app()->request->baseUrl."/uploaded/no-image.jpg";
        endif;
    }


    public static function GetDropDownByModel($model,$name='name',$condition_string=false){
        /**
         * @var $model XModel
         */



        if($condition_string){
            //Generic::_setTrace($condition_string);
            $data=$model->findAll($condition_string);
        }else{
            $data=$model->findAll();
        }
         //Generic::_setTrace($data);

        $data=CHtml::listData($data,'id',$name);
        $data['']='Not Set';
        ksort($data);
        return $data;

    }

    public static function GetMaleFemaleRadio($model,$field_name){
        if(!$model->$field_name){
            $model->$field_name='Male';
        }
        return CHtml::activeRadioButtonList($model, $field_name,array('Male'=>'Male','Female'=>'Female') );
    }
    public static function GetYesNoRadio($model,$field_name){

       
        if(!$model->$field_name){
            $model->$field_name='No';
            if($field_name=='portal'){
                if(Yii::app()->session['is_client']==1){
                    $model->$field_name='Yes';
                    //Generic::_setTrace("Client");
                }
            }

        }

//        Generic::_setTrace($model->$field_name,false);

       return CHtml::activeRadioButtonList($model, $field_name, array('Yes'=>'Yes','No'=>'No'), array( 'separator' => "  "));

    }

    public static function GetYesNoRadioActive($model,$field_name){
        if(!$model->$field_name){
            $model->$field_name='Yes';
        }
        return CHtml::activeRadioButtonList($model, $field_name, array('Yes'=>'Yes','No'=>'No'), array( 'separator' => "  "));

    }
    public static function GetYesNoRadioForSmoker($model,$field_name){

        return CHtml::activeRadioButtonList($model, $field_name, array('Yes'=>'Yes','No'=>'No','Not Defined'=>'Not Defined'), array( 'separator' => "  "));

    }


    public static function GetPrivateBusinessRadio($model,$field_name){
        if(!$model->$field_name){
            $model->$field_name='Private';
        }
        return CHtml::activeRadioButtonList($model, $field_name,array('Private'=>'Private','Business'=>'Business'), array( 'separator' => "  "));
    }
    public static function GetCreditAndCreditCardRadio($model,$field_name){
        if(!$model->$field_name){
            $model->$field_name='Credit';
        }
        return CHtml::activeRadioButtonList($model, $field_name,array('Credit'=>'Credit','Credit Card'=>'Credit Card'), array( 'separator' => "  "));
    }



    public static function thumbGenerator($source, $destination,$size=35){
        $thumbnail_width = $size;
        $thumbnail_height = $size;
        $thumb_beforeword = "thumb";
        $arr_image_details = getimagesize($source); // pass id to thumb name
        $original_width = $arr_image_details[0];
        $original_height = $arr_image_details[1];
        if ($original_width > $original_height) {
            $new_width = $thumbnail_width;
            $new_height = intval($original_height * $new_width / $original_width);
        } else {
            $new_height = $thumbnail_height;
            $new_width = intval($original_width * $new_height / $original_height);
        }
        $dest_x = intval(($thumbnail_width - $new_width) / 2);
        $dest_y = intval(($thumbnail_height - $new_height) / 2);
        if ($arr_image_details[2] == 1) {
            $imgt = "ImageGIF";
            $imgcreatefrom = "ImageCreateFromGIF";
        }
        elseif ($arr_image_details[2] == 2) {
            $imgt = "ImageJPEG";
            $imgcreatefrom = "ImageCreateFromJPEG";
        }
        elseif ($arr_image_details[2] == 3) {
            $imgt = "ImagePNG";
            $imgcreatefrom = "ImageCreateFromPNG";
        }
        if (isset($imgt)) {
            $old_image = $imgcreatefrom($source);
            $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
            imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
            return $imgt($new_image, $destination);
        }
    }


    public static function  GetUploadedFilePath($model,$attribute_name,$directory_name,$client_id=true){

        $Config = new Config();

        if($client_id){
            $client_add=$model->client_id.'/';
        }else{
            $client_add='';
        }
        $path=Yii::app()->request->baseUrl."/";
        $path .=$Config->file_uploaded_path.$client_add.$directory_name.'/'.$model->$attribute_name;
        return $path;

    }


    public static function  GetUploadedFilePathActions($model,$attribute_name,$directory_name){

        $Config = new Config();
        $path=dirname(__FILE__).DIRECTORY_SEPARATOR.'../../';
        $path=Yii::app()->request->baseUrl."/";
        //$path=$path.$Config->file_uploaded_path.$model->client_id.'/'.$directory_name.'/'.$model->$attribute_name;
        $path=$path.$Config->file_uploaded_path.'clientActions'.'/'.$model->$attribute_name;
        //die($path);
        return $path;
        /* $Config = new Config();
         $directory_name="/".$folder_path;
         $path=Yii::app()->basePath."/../".$Config->file_uploaded_path.$model->client_id.$directory_name;*/

    }


    public static function  GetUploadedFilePathWithoutModel($client_id,$attribute_name,$directory_name){

        $Config = new Config();
        $path=dirname(__FILE__).DIRECTORY_SEPARATOR.'../../';
        $path=Yii::app()->request->baseUrl."/";
        $path=$path.$Config->file_uploaded_path.$client_id.'/'.$directory_name.'/'.$attribute_name;
        //die($path);
        return $path;
        /* $Config = new Config();
         $directory_name="/".$folder_path;
         $path=Yii::app()->basePath."/../".$Config->file_uploaded_path.$model->client_id.$directory_name;*/

    }
    public  static function UploadFile($model,$attribute_name,$folder_path,$previous_file='',$client_id=true){

        $upload_file1 = CUploadedFile::getInstance($model,$attribute_name);

        //Generic::_setTrace($model);
        if($upload_file1){
            $Config = new Config();
            $path=dirname(__FILE__).DIRECTORY_SEPARATOR.'../../';

            if($client_id){
                $client_add=$model->client_id.'/';
            }else{
                $client_add='';
            }
            $path=$path.$Config->file_uploaded_path.$client_add.$folder_path;
            //die($path);
             $file_path = $path.'/';
            if(!file_exists($path)){
                mkdir($path, 0755, true);
            }

            if(isset($model->client_id) && $model->client_id>0){
                $id=$model->client_id;
            }else{
                $id=Yii::app()->session['portal_client_id'];
            }


            $file_name1 =$id.'_'.time().$attribute_name.".".$upload_file1->getExtensionName();
            $model->$attribute_name=$upload_file1;                  #initialize model attribute with file name
            $model->$attribute_name->saveAs($file_path.$file_name1);//this will upload selected file
            $model->$attribute_name = $file_name1;
            if($previous_file){
                @unlink($file_path.$previous_file);
            }

            return $file_name1;
        }else{

            return $previous_file;
        }

    }


    public  static function UploadFileActions($model,$attribute_name,$folder_path,$previous_file=''){

        $upload_file1 = CUploadedFile::getInstance($model,$attribute_name);
        //Generic::_setTrace($folder_path);
        //Generic::_setTrace($model);
        if($upload_file1){
            $Config = new Config();
            $path=dirname(__FILE__).DIRECTORY_SEPARATOR.'../../';

            $path=$path.$Config->file_uploaded_path/*.$model->client_id.'/'*/.$folder_path;
            //die($path);
            $file_path = $path.'/';
            if(!file_exists($path)){
                mkdir($path, 0755, true);
            }


            $file_name1 =time().$attribute_name.$model->client_id.".".$upload_file1->getExtensionName();
            $model->$attribute_name=$upload_file1;                  #initialize model attribute with file name
            $model->$attribute_name->saveAs($file_path.$file_name1);//this will upload selected file
            $model->$attribute_name = $file_name1;
            if($previous_file){
                @unlink($file_path.$previous_file);
            }

            return $file_name1;
        }else{

            return $previous_file;
        }

    }


    public static function GetProfileImage($fileName){

                /*$Config = new Config();
                $path=dirname(__FILE__).DIRECTORY_SEPARATOR.'../../';
                $image=$path.$Config->profile_image_path.$fileName;*/


        $Config = new Config();
        $path=dirname(__FILE__).DIRECTORY_SEPARATOR.'../../';
        $path=Yii::app()->baseUrl.'/';
        $image=$path.$Config->profile_image_path.$fileName;

        return $image;
    }
    public  static function UploadProfileImage($model,$attribute_name,$previous_file=''){

        $upload_file1 = CUploadedFile::getInstance($model,$attribute_name);
        //Generic::_setTrace($folder_path);
        //Generic::_setTrace($model);
        if($upload_file1){

            $Config = new Config();
            $main_image =time()."-".$model->username.".".$upload_file1->getExtensionName();
            $image_path = Yii::app()->basePath."/../".$Config->profile_image_path;
            $model->avatar=$upload_file1;#initialize model attribute with file name

            $model->avatar->saveAs($image_path.$main_image);//this will upload selected image file
            $model->avatar = $main_image;
            if($previous_file){
                @unlink($image_path.$previous_file);
            }
        }else{

            return $previous_file;
        }

    }
    public static function deleteFile($path, $fileName, $inUploaded=true, $disableCloudCheck=false){

        if($inUploaded===true){
            $base_path = $base_path = Yii::app()->basePath."/../uploaded/";
        }
        else{
            $base_path = Yii::app()->basePath."/../";
        }

        @unlink($base_path.$path.$fileName);
    }

    public static function UnlinkFile($model,$folder_path,$unlink_file){

        $Config = new Config();
        $path=dirname(__FILE__).DIRECTORY_SEPARATOR.'../../';
        $path=$path.$Config->file_uploaded_path.$model->client_id.'/'.$folder_path.'/';

        $file=$path.$unlink_file;
        //Generic::_setTrace($file);
        @unlink($file);
    }


    /**
     * Server media file such as image, css etc. from a managed manner
     * e.g. check its comes from cloud or local machine
     * @param $path
     * @param $file
     * @return string
     */
    public static function serveMediaContent($path, $file){
              return Yii::app()->request->baseUrl."/".$path.$file;
    }

    public static function extractModelError($model){

        $message = "";
        if(is_array($model)){
            foreach($model as $k=>$v){
                $message .= "$k: ";
                if(is_array($v)){
                    foreach($v as $row){
                        $message.=$row." | ";
                    }
                }
                $message.="\n";
            }
        }

        return $message;

    }

    /**
     * @param $model
     * @param $str
     * @param bool $extend
     * @param int $day
     */

    public static function getDatePicker($model,$str,$extend=false,$day=7)
    {
        if($model->$str !=''){
            $val=date('Y-m-d',strtotime($model->$str));
        }else{
            // extended functionality for selecting end date in date picker

            if($extend){
                $date = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " +".$day." days");
                $newDate=date('Y-m-d',$date);
                $model->$str=$newDate;
                $val=$newDate;
            }else{

                $val=date('Y-m-d');
                if($str=='date_of_birth'){
                    // changed the birth date of a client past 20 year
                    $date = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " -".(20*365)." days");
                    $val=date('Y-m-d',$date);

                    //$val='';
                }
            }



        }
       $controller = new CController('HelpController');
       $controller->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model'=>$model,
            'attribute'=>$str,
           // 'value'=>date('Y-m-d'),
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
                'changeYear' => true,
                'changeMonth' => true,
                'yearRange' => '-80:+20'
            ),
            'htmlOptions'=>array(
                'style'=>'vertical-align:top',
                "readonly"=>"readonly",
               // "class"=>'simple_field pick_date',
                "class"=>'simple_field form-control pick_date',
                'value'=>$val

            ),
        ));
    }


    public static function AddDatePicker($name){
        $controller = new CController('HelpController');
        $val=date('Y-m-d');
        $controller->widget('zii.widgets.jui.CJuiDatePicker',array(
            'name'=>$name,
            'id'=>$name.'_date_picker',
            'value'=>$val,
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
                'changeYear' => true,
                'changeMonth' => true,
                'yearRange' => '-80:+20'
            ),
            'htmlOptions'=>array(
                'style'=>'vertical-align:top',
                "readonly"=>"readonly",
                 "class"=>'simple_field date_picker',
               // "class"=>'simple_field form-control pick_date',
                'value'=>$val

            ),
        ));
    }
    public static function CheckPrivilege($id,$model=false){

        $access=false;
        if(isset($id)){

            $data=User::model()->find('id='.$id);
            if($data){

                if($data->type == 'Client'){
                    $access= true;
                }else{
                    //return true;
                    $access=  false;
                }
            }else{
                $access=  true;
            }
        }else{
            $access=  true;
        }
        // pass model to check portal == yes in future in dashboard abd pop ups
        return $access;
    }

    /**
     * @param $model
     * @param $id
     * @return mixed
     */
    public static function GetNameByModelId($model,$id){
        if(isset($id) && $id>0){
            $name=$model->find('id='.$id);//Pk($id);
            return $name->name;
        }
    }


    public static  function getSavingsNumber($client_id,$id)
    {
        $date_condition='   AND date(NOW()) <= DATE(client_offers.end_date)   ';
        $criteria=new CDbCriteria();
        if($client_id && $id){

            if($id==1){
               $typeName="Mortgage";
            }elseif($id==2){
                $typeName="Insurance";
            }elseif($id==3){
                $typeName="Pension";
            }elseif($id=4){
                $typeName="Credit";
            }
            /*$sql='SELECT count(id) as savings
                    FROM client_offers
                    WHERE contract_id IN (SELECT id from client_contract_list where client_id='.$client_id.' AND type="'.$typeName.'")
                    AND
                   client_id='.$client_id.' AND date(NOW()) <= DATE(client_offers.end_date)';*/

            $criteria->select='count(id) as savings';
            $criteria->condition='client_offers.client_id='.$client_id.' AND date(NOW()) <= DATE(client_offers.end_date)';
            $criteria->addCondition('client_offers.contract_id IN (SELECT id from client_contract_list where client_id='.$client_id.' AND type="'.$typeName.'")');

           
        }
        elseif($client_id){
           /* $sql="SELECT COUNT(*) as saving_count FROM client_offers where client_offers.client_id=".$client_id.$date_condition;*/
            $criteria->select='COUNT(*) as saving_count';
            $criteria->condition='client_offers.client_id='.$client_id.$date_condition;

        }
        else
        {
            /*$sql="SELECT COUNT(*) as saving_total_count FROM client_offers where date(NOW()) <= DATE(client_offers.end_date)";*/
            $criteria->select='COUNT(*) as saving_total_count';
            $criteria->condition='where date(NOW()) <= DATE(client_offers.end_date)';
        }

       //Generic::_setTrace($sql);
        /*$saving_data = Yii::app()->db->createCommand($sql)->queryScalar();*/
        $saving_data=Yii::app()->db->commandBuilder->createFindCommand(ClientOffers::model()->tableName(),$criteria,'client_offers')->queryScalar();
        return $saving_data*1 ;
    }
  /*  public static function GetErrorSummaryFromModel($model){
        $form=$this->beginWidget('CActiveForm', array(
            'id'=>'client-income-form',
            'action'=>Yii::app()->createUrl('/clientDashboard/MyDetailsChange'),
// Please note: When you enable ajax validation, make sure the corresponding
// controller action is handling ajax validation correctly.
// There is a call to performAjaxValidation() commented in generated controller code.
// See class documentation of CActiveForm for details on this.
            'enableAjaxValidation'=>false,
            'htmlOptions'=>array(
                'enctype' => 'multipart/form-data',
            ),
        ));
        $form->errorSummary($model);
    }*/

    public static function GetIframeURL($value,$amount=0,$L){
        $data= $amount - $value['price'];
        //Generic::_setTrace($amount);
        //$L = $this::$L;

        $str='';
        $str.='                 <div class="btt2">
                                    <a target="_blank"  href="'.$value['calculation_url'].'">'.$L->g('DIRECT SAVINGS').'</a>
                                    <strong>'.preg_replace("~([.][0-9])0*$~","", abs($data)).',-</strong>
                                </div>';
        return $str;

    }

    public static function getTotalOffer($client_id,$type=0){


        $saving_data=array();
        $saving_data['total'] = 0;
        $saving_data['saving_percent']=0;

        $typeName="Mortgage";
        $date_condition =" AND date(NOW()) <= DATE(client_offers.end_date)";


        /*$sql_offer='SELECT sum(client_offers.price) as total_offer
                   FROM client_offers
                    WHERE contract_id IN (SELECT id from client_contract_list where client_id='.$client_id.' AND type="'.$typeName.'")
                     and
                    client_id='.$client_id.$date_condition;
       $offer = Yii::app()->db->createCommand($sql_offer)->queryRow();*/
       //Generic::_setTrace($offer);

        $criteria2 = new CDbCriteria();
        $criteria2->select='sum(price) as total_offer';
        $criteria2->condition='client_id='.$client_id.$date_condition;
        $criteria2->addCondition('contract_id IN (SELECT id from client_contract_list where client_id='.$client_id.' AND type="'.$typeName.'")');
        $offer=Yii::app()->db->commandBuilder->createFindCommand(ClientOffers::model()->tableName(),$criteria2,'client_offers')->queryRow();



        if($offer['total_offer']>0)
        {

            /*$sql = 'select SUM(client_contract_list.price) as total_insurance
          FROM client_contract_list
          WHERE client_contract_list.id in(SELECT client_offers.contract_id from client_offers where (date(NOW()) <= DATE(client_offers.end_date) and client_id='.$client_id.'))
          and client_contract_list.type="'.$typeName.'" and client_id='.$client_id;
           //Generic::_setTrace($sql);
          $total_insurance= Yii::app()->db->createCommand($sql)->queryRow();*/

            $criteria3 = new CDbCriteria();
            $criteria3->select="SUM(t.price) as total_insurance";
            $criteria3->condition='t.type="'.$typeName.'" and client_id='.$client_id;
            $criteria3->addCondition('t.id in(SELECT client_offers.contract_id from client_offers where (date(NOW()) <= DATE(client_offers.end_date) and client_id='.$client_id.'))');
            $total_insurance=Yii::app()->db->commandBuilder->createFindCommand(ClientContractList::model()->tableName(),$criteria3)->queryRow();

            $saving_data['total'] = $total_insurance['total_insurance']-$offer['total_offer'];
            if(isset($total_insurance['total_insurance']) && $total_insurance['total_insurance']>0){
                $saving_data['saving_percent']=($offer['total_offer']*100)/$total_insurance['total_insurance'];
            }
        }

        return $saving_data;
    }


    public static function getTotalInsuranceOffer($client_id,$type=0){

        $saving_data=array();
        $saving_data['total'] = 0;
        $saving_data['saving_percent']=0;


        $typeName="Insurance";
        $date_condition =" AND date(NOW()) <= DATE(client_offers.end_date)";

        /*$sql_offer='SELECT sum(client_offers.price) as total_offer
                    FROM client_offers
                     WHERE contract_id IN (SELECT id from client_contract_list where client_id='.$client_id.' AND type="'.$typeName.'")
                      and
                     client_id='.$client_id.$date_condition;
        //Generic::_setTrace($sql_offer);
        $offer = Yii::app()->db->createCommand($sql_offer)->queryRow();*/

        $criteria2 = new CDbCriteria();
        $criteria2->select='sum(price) as total_offer';
        $criteria2->condition='client_id='.$client_id.$date_condition;
        $criteria2->addCondition('contract_id IN (SELECT id from client_contract_list where client_id='.$client_id.' AND type="'.$typeName.'")');
        $offer=Yii::app()->db->commandBuilder->createFindCommand(ClientOffers::model()->tableName(),$criteria2,'client_offers')->queryRow();


        if($offer['total_offer']>0)
        {
            /*$sql = 'select SUM(client_contract_list.price) as total_insurance
       FROM client_contract_list
       WHERE client_contract_list.id in(SELECT client_offers.contract_id from client_offers where (date(NOW()) <= DATE(client_offers.end_date) and client_id='.$client_id.'))
       and client_contract_list.type="'.$typeName.'" and client_id='.$client_id;
        //Generic::_setTrace($sql);
       $total_insurance= Yii::app()->db->createCommand($sql)->queryRow();*/

            $criteria3 = new CDbCriteria();
            $criteria3->select="SUM(t.price) as total_insurance";
            $criteria3->condition='t.type="'.$typeName.'" and client_id='.$client_id;
            $criteria3->addCondition('t.id in(SELECT client_offers.contract_id from client_offers where (date(NOW()) <= DATE(client_offers.end_date) and client_id='.$client_id.'))');
            $total_insurance=Yii::app()->db->commandBuilder->createFindCommand(ClientContractList::model()->tableName(),$criteria3)->queryRow();

            $saving_data['total'] = $total_insurance['total_insurance']-$offer['total_offer'];
            if(isset($total_insurance['total_insurance']) && $total_insurance['total_insurance']>0){
                $saving_data['saving_percent']=($offer['total_offer']*100)/$total_insurance['total_insurance'];
            }

        }

         return $saving_data;
  }

    public static function _timeFrameDate($time_frame=9){

        $date_range = array();

        $date_end = date('Y-m-d',strtotime(Enum::getLocalDateTime()."-1 day")) ;
        $sevenDay = date('Y-m-d',strtotime(Enum::getLocalDateTime().'-7 days'));
        switch($time_frame){
            case 1://last 7 days
                $date_start = date('Y-m-d',strtotime(Enum::getLocalDateTime().'-7 days'));
                break;
            case 2://last 15 days
                $date_start = date('Y-m-d',strtotime(Enum::getLocalDateTime().'-15 days'));
                break;
            case 3://last 30 days
                $date_start = date('Y-m-d',strtotime(Enum::getLocalDateTime().'-30 days'));
                break;
            case 4://last 90 days
                $date_start = date('Y-m-d',strtotime(Enum::getLocalDateTime().'-90 days'));
                break;
            case 5://yesterday
                $date_start = date('Y-m-d',strtotime(Enum::getLocalDateTime().'-1 day'));
                $date_end = date('Y-m-d',strtotime(Enum::getLocalDateTime().'-1 day'));
                break;
            case 6://?? year to date??
                $date_start = date('Y-m-d',strtotime(Enum::getLocalDateTime().'+1day -'.date('d',strtotime(Enum::getLocalDateTime())).'days'));
                $date_end = date('Y-m-d',strtotime(Enum::getLocalDateTime()));
                break;
            case 7://this year
                $date_start = date('Y-m-d', strtotime('01 january '.date('Y', strtotime(Enum::getLocalDateTime()))));
                $date_end = date('Y-m-d',strtotime(Enum::getLocalDateTime()));
                break;
            case 8://today
                $date_start = date('Y-m-d',strtotime(Enum::getLocalDateTime()));
                $date_end = date('Y-m-d',strtotime(Enum::getLocalDateTime()));
                break;
            case 9://last month
                $date_start = date('Y-m-d',strtotime('first day of last month'));
                $date_end = date('Y-m-d',strtotime('last day of last month'));
                break;
            case 10://custom range
                $date_start = date('Y-m-d',
                    (!empty($_REQUEST['customStartDate'])?strtotime($_REQUEST['customStartDate']):strtotime(Enum::getLocalDateTime()))
                );
                $date_end = date('Y-m-d',
                    (!empty($_REQUEST['customEndDate'])?strtotime($_REQUEST['customEndDate']):strtotime(Enum::getLocalDateTime()))
                );
                break;
            case 11: //this month
                $date_start=date('Y-m-01');
                $date_end= date('Y-m-d',strtotime('last day of this month')) ;
                break;
            default:
                $date_start = $sevenDay;
        }

        $date_range['start'] = $date_start;
        $date_range['end'] = $date_end;

        return $date_range;
    }


    public static function rollingDatesList($dates)
    {
        $strDateFrom = $dates['start'];
        $strDateTo = $dates['end'];

        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.

        // could test validity of dates here but I'm already doing
        // that in the main script

        $aryRange=array();

        $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
        $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

        if ($iDateTo>=$iDateFrom)
        {
            array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
            while ($iDateFrom<$iDateTo)
            {
                $iDateFrom+=86400; // add 24 hours
                if(strtotime(date('Y-m-d',$iDateFrom))<=strtotime(date('Y-m-d'))){
                    array_push($aryRange,date('Y-m-d',$iDateFrom));
                }

            }
        }
        return $aryRange;
    }

    //for company
    public static function UploadFileForCustomForm($model,$attribute_name,$custom_name,$folder_path,$previous_file=''){
        $upload_file1 = CUploadedFile::getInstance($model,$attribute_name);
        if($upload_file1){
            $Config = new Config();
            $path=dirname(__FILE__).DIRECTORY_SEPARATOR.'../../';
            $path=$path.$Config->file_uploaded_path.$folder_path.'/'.$custom_name;
            $file_path = $path.'/';
            if(!file_exists($path)){
                mkdir($path, 0755, true);
            }
            $file_name1 =time().$attribute_name.'_'.$custom_name.".".$upload_file1->getExtensionName();
            $model->$attribute_name=$upload_file1;                  #initialize model attribute with file name
            $model->$attribute_name->saveAs($file_path.$file_name1);//this will upload selected file
            $model->$attribute_name = $file_name1;
            if($previous_file){
                @unlink($file_path.$previous_file);
            }

            return $file_name1;
        }else{

            return $previous_file;
        }
    }

    //for company
    public static function  GetUploadedFilePathForCustomForm($model,$attribute_name,$directory_name){

        $Config = new Config();
        $path=dirname(__FILE__).DIRECTORY_SEPARATOR.'../../';
        $path=$path.$Config->file_uploaded_path.$model->$attribute_name.'/'.$directory_name.'/'.$model->$attribute_name;
        return $path;
    }

    public static function GetInsuranceDropDownModel($client_id){
        $insurance_type=array();
        if($client_id>0){
            $Criteria = new CDbCriteria();
            $Criteria->select = "t.id, in_cat.name";
            $Criteria->join = "INNER JOIN ".InsuranceCategories::model()->tableName()." in_cat ON t.insurance_type = in_cat.id";
            $Criteria->condition = 't.client_id = '.$client_id;
            $insurance_type = Yii::app()->db->commandBuilder->createFindCommand(ClientInsuranceGeneral::model()->tableName(),$Criteria)->queryAll();

            /*$sql="SELECT
               client_insurance_general.id,
               insurance_categories.`name`
               FROM
               client_insurance_general
               INNER JOIN insurance_categories ON client_insurance_general.insurance_type = insurance_categories.id
               WHERE client_insurance_general.client_id=".$client_id;
            $insurance_type = Yii::app()->db->createCommand($sql)->queryAll();*/
        }

        return CHtml::listData($insurance_type,'id','name');
    }
    public static function getAdvisorId($id)
    {
        $Criteria = new CDbCriteria();
        $Criteria->select = "id";
        $Criteria->condition = "employees_id=".$id;
        $advisor_id = Yii::app()->db->commandBuilder->createFindCommand(ClientAdvisors::model()->tableName(),$Criteria)->queryRow();

        /*$sql="SELECT id FROM client_advisors WHERE employees_id=".$id;
        $advisor_id = Yii::app()->db->createCommand($sql)->queryRow();*/
        return $advisor_id;
    }
    public static function setCookieName($cookie_name,$value=false)
    {
        $return_value='';
        if($cookie_name && $value):
        $cookie = new CHttpCookie($cookie_name, $value);
        $cookie->path = "/";
        //$cookie->expire = time()+3*24*60*60;
        $cookie->expire =0;
        Yii::app()->request->cookies[$cookie_name] = $cookie;

        //setcookie($cookie_name, $value, time()+3*24*60*60,'/');

        endif;

        if(isset(Yii::app()->request->cookies[$cookie_name])){
            $return_value = (string)Yii::app()->request->cookies[$cookie_name];
        }
        /*if(isset($_COOKIE[$cookie_name])){
            $return_value = $_COOKIE[$cookie_name];
        }*/

        if(strlen($return_value ) > 10){

        }else{
            $return_value=false;
        }


        return $return_value;
    }

    public static function getAdvisorMailAddress($id)
    {
        $Criteria = new CDbCriteria();
        $Criteria->select = "email";
        $Criteria->condition = "id=".$id;
        $email = Yii::app()->db->commandBuilder->createFindCommand(User::model()->tableName(),$Criteria)->queryScalar();

        /*$sql="SELECT tbl_user.email FROM tbl_user WHERE id=".$id;
        $email = Yii::app()->db->createCommand($sql)->queryScalar();*/
        return $email;
    }

    public static function GridContractDelete($type,$id){

        if($type!=''){

            $contract_list_model=ClientContractList::model()->find('type=:type AND contract_id=:contract_id', array(':type'=>$type,':contract_id'=>$id));
            if($contract_list_model){
                $res=ClientOffers::model()->deleteAll('contract_id=:id',array(':id'=>$contract_list_model->id));
                ClientContractList::model()->deleteAll('type=:type AND contract_id=:contract_id', array(':type'=>$type,':contract_id'=>$id));

            }
        }

    }

    public static function getMortgageDropDownModel($client_id,$type){

        $Criteria = new CDbCriteria();
        $Criteria->select = "contract_id, contract_name";
        $Criteria->condition = "type ='".$type."' and client_id=".$client_id;
        $contract_name = Yii::app()->db->commandBuilder->createFindCommand(ClientContractList::model()->tableName(),$Criteria)->queryAll();

        /*$sql = 'select client_contract_list.contract_id,client_contract_list.contract_name
                FROM
                client_contract_list
                WHERE type='."'$type'".'
                and client_contract_list.client_id='.$client_id;

        $contract_name = Yii::app()->db->createCommand($sql)->queryAll();*/

        $data= CHtml::listData($contract_name,'contract_id','contract_name');
        $data['0']='Select Mortgage';
        ksort($data);
        return $data;

    }

    public static function getClientAction()
    {
        $data=array();
        //return $actions_data;
        $cookieName='footer_banner';
        $write=false;
        $cookie_result= Generic::setCookieName($cookieName);
       // $cookie_result= false;

        if($cookie_result){

            $result= unserialize(urldecode($cookie_result));
            if(is_array($result)){
                $data=$result;
                //Generic::_setTrace($data);
            }else{
                $write=true;
            }
        }else{
            $write=true;
        }
        if($write){
            $Criteria = new CDbCriteria();
            $Criteria->select = "client_id, url, banner_url, banner_picture";
            $Criteria->condition = "footer_picture_is_active=1";
            $Criteria->order = "update_date DESC";
            $Criteria->limit = 3;
            $data = Yii::app()->db->commandBuilder->createFindCommand(ClientActions::model()->tableName(),$Criteria)->queryAll();

            /*$sql="SELECT client_actions.client_id, client_actions.url, client_actions.banner_picture FROM client_actions WHERE client_actions.footer_picture_is_active=1 ORDER BY update_date DESC LIMIT 0 ,3";
            $data=Yii::app()->db->createCommand($sql)->queryAll();*/

            $result=urlencode(serialize($data));
            Generic::setCookieName($cookieName,$result);

        }

        return $data;

    }

    public static function getDamageCount($client_id)
    {
        $Criteria = new CDbCriteria();
        $Criteria->select = "COUNT(*) AS count";
        $Criteria->condition = 'client_id = '.$client_id;
        $damage_count = Yii::app()->db->commandBuilder->createFindCommand(ClientDamage::model()->tableName(),$Criteria)->queryScalar();
        return $damage_count;

        /*$sql="SELECT count(*) AS count FROM client_damage WHERE client_id=".$client_id;
        $damage_count=Yii::app()->db->createCommand($sql)->queryScalar();
        return $damage_count;*/
    }
    public static function getClientInsurance(){
        $client_id = Yii::app()->session['portal_client_id'];
        $Criteria = new CDbCriteria();
        $Criteria->select = "t.id, t.client_id, t.insurance_type, in_cat.name, in_cat.id";
        $Criteria->join = "INNER JOIN ".InsuranceCategories::model()->tableName()." in_cat ON t.insurance_type = in_cat.id";
        $Criteria->condition = 't.client_id = '.$client_id;
        $result = Yii::app()->db->commandBuilder->createFindCommand(ClientInsuranceGeneral::model()->tableName(),$Criteria)->queryAll();

        /*$sql = "SELECT
        client_insurance_general.id,
        client_insurance_general.client_id,
        client_insurance_general.insurance_type,
        insurance_categories.`name`,
        insurance_categories.id
        FROM
        client_insurance_general
        INNER JOIN insurance_categories ON client_insurance_general.insurance_type = insurance_categories.id
        WHERE client_insurance_general.client_id = '$client_id'";
        $result = Yii::app()->db->createCommand($sql)->queryAll();*/

        $list = array();
        $list[''] = 'Select';
        foreach($result as $res){
            $list[$res['insurance_type']] = $res['name'];
        }
        return $list;
    }

    public static function getClientBasicDataById($clientId){

        $Criteria = new CDbCriteria();
        $Criteria->select = "id,first_name,last_name,concat(first_name,' ',last_name)as username ,email,avatar";
        $Criteria->condition = "id=".$clientId;
        $userModel = Yii::app()->db->commandBuilder->createFindCommand(User::model()->tableName(),$Criteria)->queryRow();
        return $userModel;

        /*$userModel=Yii::app()->db->createCommand('SELECT id,first_name,last_name,concat(first_name," ",last_name)as username ,email,avatar from '.User::model()->tableName(). ' where id='.$clientId)->queryRow();
        return $userModel;*/
    }

    public  static function BulkUploadFile($model,$attribute_name,$folder_path,$previous_file='',$client_id=true){

        $upload_file1 = CUploadedFile::getInstance($model,$attribute_name);
        if($upload_file1){
            $Config = new Config();
            $path=dirname(__FILE__).DIRECTORY_SEPARATOR.'../../';

            if($client_id){
                $client_add=$model->client_id.'/';
            }else{
                $client_add='';
            }
            $path=$path.$Config->file_uploaded_path.$client_add.$folder_path;
            //die($path);
            $file_path = $path.'/';
            if(!file_exists($path)){
                mkdir($path, 0755, true);
            }


            $file_name1 =time().".".$upload_file1->getExtensionName();
            $model->$attribute_name=$upload_file1;                  #initialize model attribute with file name
            $model->$attribute_name->saveAs($file_path.$file_name1);//this will upload selected file
            $model->$attribute_name = $file_name1;
            if($previous_file){
                @unlink($file_path.$previous_file);
            }

            return $file_name1;
        }else{

            return $previous_file;
        }

    }

    public static function GetFileNamesForBulkUpload($model,$controller,$L,$attribute){

        //Generic::_setTrace($controller->id,false);
        //Generic::_setTrace($model->$attribute);

        $fileJan=explode('_',$model->$attribute);
        if(count($fileJan)>0){

            if($fileJan[0]!=$model->client_id){

                return  CHtml::link($L->g($model->$attribute),
                    $controller->createUrl(Generic::GetUploadedFilePathForBoss($model, $attribute,'admin',false)));
            }else{
                return  CHtml::link(
                    $L->g($model->$attribute),
                    $controller->createUrl(Generic::GetUploadedFilePathForBoss($model, $attribute,'clientEmployersGeneral')));
            }
        }else{
            return CHtml::link(
                $L->g($model->$attribute),
                $controller->createUrl(Generic::GetUploadedFilePathForBoss($model, $attribute,'admin',false)));
        }
    }

    public static function getAdvisorRole()
    {

        return (isset(Yii::app()->session['super_admin']) && Yii::app()->session['super_admin'] == true)? 1 : 0;
    }

    public  static function UploadFileForBoss($model,$attribute_name,$folder_path,$previous_file='',$client_id=true){

        $upload_file1 = CUploadedFile::getInstance($model,$attribute_name);

        $controllerSalary='admin/payslip';
        $controllerSchedule='admin/schedule';
        //Generic::_setTrace($model);
        if(strstr($attribute_name,'salary')){
            $folder_path=$controllerSalary;
        }
        elseif(strstr($attribute_name,'schedule')){
            $folder_path=$controllerSchedule;
        }else{
            $folder_path='admin/boss';
        }
        if($upload_file1){
            $Config = new Config();
            $path=dirname(__FILE__).DIRECTORY_SEPARATOR.'../../';


            $path=$path.$Config->file_uploaded_path.$folder_path;
            //die($path);
            $file_path = $path.'/';
            if(!file_exists($path)){
                mkdir($path, 0755, true);
            }

            if(isset($model->client_id) && $model->client_id>0){
                $id=$model->client_id;
            }else{
                $id=Yii::app()->session['portal_client_id'];
            }


            $file_name1 =$id.'_'.time().$attribute_name.".".$upload_file1->getExtensionName();
            $model->$attribute_name=$upload_file1;                  #initialize model attribute with file name
            $model->$attribute_name->saveAs($file_path.$file_name1);//this will upload selected file
            $model->$attribute_name = $file_name1;
            if($previous_file){
                @unlink($file_path.$previous_file);
            }

            return $file_name1;
        }else{

            return $previous_file;
        }

    }

    public static function  GetUploadedFilePathForBoss($model,$attribute_name,$directory_name,$client_id=true){

        $Config = new Config();

        $controllerSalary='admin/payslip';
        $controllerSchedule='admin/schedule';
        //Generic::_setTrace($model);
        if(strstr($attribute_name,'salary')){
            $folder_path=$controllerSalary;
        }elseif(strstr($attribute_name,'schedule')){
            $folder_path=$controllerSchedule;
        }else{
            $folder_path='admin/boss';
        }

        $path=Yii::app()->request->baseUrl."/";
        $path=$path.$Config->file_uploaded_path.$folder_path;
        //die($path);
        $file_path = $path.'/';
        return $file_path.$model->$attribute_name;

    }
    public static function GetFileNamesForBossBulkUpload($model,$controller,$L,$attribute){

        //Generic::_setTrace($controller->id,false);
        //Generic::_setTrace($model->$attribute);

        $fileJan=explode('_',$model->$attribute);
        if(count($fileJan)>0){

            if($fileJan[0]!=$model->client_id){

                return  CHtml::link($L->g($model->$attribute),
                    $controller->createUrl(Generic::GetUploadedFilePathForBoss($model, $attribute,'admin',false)));
            }else{
                return  CHtml::link(
                    $L->g($model->$attribute),
                    $controller->createUrl(Generic::GetUploadedFilePathForBoss($model, $attribute,'clientEmployersGeneral')));
            }
        }else{
            return CHtml::link(
                $L->g($model->$attribute),
                $controller->createUrl(Generic::GetUploadedFilePathForBoss($model, $attribute,'admin',false)));
        }
    }

    public static function calculateValue(){
        $sql = "SELECT * FROM calculate_value_of_mortgage_credit_retirement";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        return $result;
    }


    
} 