<?php

class SimpleAjaxController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = "empty-layout";

    /**
     * @return array action filters
     */
    /*public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }*/

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                //'actions'=>array('admin','delete'),
                'actions' => array('*'),
                'users' => array('@'),
            ),
        );
    }





    public function actionDueInformationAdd(){
        //name__sexyCombo
        $today=date('Y-m-d');
       //  Generic::_setTrace($_REQUEST);
        $manager= Yii::app()->session['user'];
       // $area= strtoupper(addslashes($_POST['due_area__sexyCombo']));
		$area= strtoupper(addslashes($_POST['due_area']));
        $occupation= strtoupper(addslashes($_POST['occupation']));
        $article= addslashes($_POST['due_article']);
        $c_name= strtoupper(addslashes($_POST['name__sexyCombo']));
        if(trim($occupation)=='' || trim($c_name)==''){
            die(json_encode(array('status'=>'failed','q'=>'সঠিক নাম ও পেশা দিন ')));
        }
        $amount= addslashes($_POST['due_amount']);
        $partial_amount= addslashes($_POST['partial_due_amount']);
        if(!is_numeric( $partial_amount)){

            $partial_amount = 0;
        }

        $due_amount = $amount;
        if(isset($partial_amount) && ($partial_amount>0 && ($partial_amount < $amount))){

           
            $due_amount = $amount - $partial_amount ;
        }
        

        $model= CustomerDueInformation::model()->find('area_name=:area_name AND occupation=:occupation AND name=:c_name', array(':area_name'=>$area,':occupation'=>$occupation,':c_name'=>$c_name));
        if($model){

            $old=$model->articles;
            $model->articles = $article.', '.$old  ;
            $model->manager=$manager;
            $model->date=$today;
        }else{

            $model= new CustomerDueInformation();
            $model->amount=0;
            $model->manager=$manager;
            $model->area_name=$area;
            $model->occupation=$occupation;
            $model->name=$c_name;
            $model->articles=$article;
            $model->date=$today;
          
        }
        $model->save();

        if($model->id){
            $customer_id= $model->id;

            $cq="insert into customer_transaction set customer_id=$customer_id, date='$today', amount=$amount,transaction_type='$article'";
            $re2s=Yii::app()->db->createCommand($cq)->execute();

            $cq2='';
            if(isset($partial_amount) && ($partial_amount>0 && ($partial_amount < $amount))){

                $cq2="insert into customer_transaction set customer_id=$customer_id, date='$today', total_due='1', amount=$partial_amount,transaction_type='PAID'";
                 $re2s=Yii::app()->db->createCommand($cq2)->execute();

            }


            die(json_encode(array('status'=>'success','c_name'=>$c_name,'due_amount'=>$due_amount, 'cq1'=>$cq,'cq2'=>$cq2,'submitted'=>$_POST)));
        }else{
            die(json_encode(array('status'=>'failed','q'=>'no customer found to add')));//Generic::_setTrace($model->errors);
        }



    }
    public function  actionArticleInfo(){
        if(isset($_REQUEST['all'])){
            $common_obj= new common_class();
            $all_articles=$common_obj->GetAllArticles();
            die(json_encode(array('status'=>'success','all_articles'=>$all_articles['dropdown_option'],'price_list'=>$all_articles['price_list'])));
        }else{

            $manager= Yii::app()->session['user'];

            $article=  addslashes($_POST['article']);

            $article= strtoupper(trim($article));
            $up_q="select * from  articles   where  article like '$article' ";

            $data=Yii::app()->db->createCommand($up_q)->queryRow();


            if($data){

               // $data = $res->read();

                die(json_encode(array('status'=>'success','info'=>$data)));
            }else{
                die(json_encode(array('status'=>'failed','msg'=>'সঠিক আর্টিকেল দিন ')));
            }

        }
    }

    public function actionFerot(){
        $manager= @Yii::app()->session['user'];
        $amount=  addslashes(@$_POST['amount']);
        $article=  addslashes(@$_POST['article']);
        $today=date('Y-m-d');
        $article= strtoupper(trim($article));

        if(isset($_POST['back_memo']) && !empty(trim($_POST['back_memo']))){
            $memo_id=$_POST['back_memo'];
            $up_q="select * from  daily_sell_information where  id = '$memo_id' ";

            $data=Yii::app()->db->createCommand($up_q)->queryRow();
            if($data){
                $amount= $data['price'];
                $article= $data['article'];
            }


        }
        $up_q="update articles set total_pair=total_pair+1 , total_taka= total_taka+actual_price,added_date='$today'  where  upper(article)='$article' ";
//die($up_q);
        $res=Yii::app()->db->createCommand($up_q)->execute();


        if($res){
            $q="insert into money_back_iteams set amount='$amount',article='$article',manager='$manager',date='$today' ";
//die($q);
            $res=Yii::app()->db->createCommand($q)->execute();

            die(json_encode(array('status'=>'success','article'=>$article,'price'=>$amount, 'memo'=>@$_POST['back_memo'])));
        }else{
            die(json_encode(array('status'=>'failed','msg'=>'সঠিক আর্টিকেল দিন ')));
        }

    }

    public function actionCostLend(){

        $today=date('Y-m-d');
        $dokan_stuff=array();
        $qr=" select cost_name from cost_items where cost_type=2";
        $qr_res= Yii::app()->db->createCommand($qr)->query();
//$dokan_stuff=$qr_res->fetch_all(MYSQLI_ASSOC);
        while($row=$qr_res->read()){
            $dokan_stuff[]= strtolower($row['cost_name']);
        }
//die(print_r($dokan_stuff));

        $manager= Yii::app()->session['user'];
        $cost_name=  addslashes(@$_POST['cost_items_all__sexyCombo']);
		if($cost_name==''){
		 $cost_name=  addslashes(@$_POST['cost_items_all']);
		 }
        $cost_amount =  addslashes($_POST['cost_amount']);
        if(strtolower($cost_name)=='কর্জ' ||strtolower($cost_name)=='lend' ||strtolower($cost_name)=='korjo'){
            $lender_name = ucwords(trim( addslashes($_POST['lender_name__sexyCombo'])));
            $inuq=" Insert into lenders  set name='$lender_name' , date='$today' , amount=$cost_amount  on duplicate key update name='$lender_name' , date='$today' , amount=amount+$cost_amount ";
            // die($inuq);
            $up=Yii::app()->db->createCommand($inuq)->execute();
            $cost_type= $cost_name.'-'.$lender_name;
            $q=" Insert into daily_cost_items  set cost_type='$cost_type' , date='$today' , amount=$cost_amount, manager='$manager' ";
            // die($inuq);
            $up=Yii::app()->db->createCommand($q)->execute();
            if($up){

                $html='<div class="cost-info">
                    <div  style="float: left" class="progduct-name">
                       '.$cost_type.'
                    </div>

                    <div style="float: right;color:red;">'.$cost_amount.'</div>
                    <div class="clear"></div>
                </div>';
                die(json_encode(array('status'=>'success','html'=>$html,'costName'=>$cost_type,'amount'=>$cost_amount)));
            }
        }
        else{

            $cost_type= $cost_name;
            $q=" Insert into daily_cost_items  set cost_type='$cost_type' , date='$today' , amount=$cost_amount, manager='$manager' ";
            if(in_array(strtolower($cost_name),$dokan_stuff)){
                $qsr=" Insert into kormocari  set name='$cost_name' , taken_date='$today' , amount=$cost_amount, manager='$manager' ";
                // die($inuq);
                $up=Yii::app()->db->createCommand($qsr)->execute();

            }

            // die($inuq);
            $up=Yii::app()->db->createCommand($q)->execute();
            if($up){

                $html='<div class="cost-info">
                    <div  style="float: left" class="progduct-name">
                       '.$cost_type.'
                    </div>

                    <div style="float: right;color:red;">'.$cost_amount.'</div>
                    <div class="clear"></div>
                </div>';
                die(json_encode(array('status'=>'success','html'=>$html, 'costName'=>$cost_type,'amount'=>$cost_amount)));
            }

        }

        /*
        $html='
                                <div class="input-label-name">
                                    নাম
                                </div>

                                <div class="input-field-right">
                                    <input type="text" class="input-field" id="name" name="name" value="">
                                </div>
                                <div class="clear"></div>
                            ';*/
    }

    public  function  actionDailyAdd(){

        $today= date('Y-m-d');
            #die(print_r($_POST));
                    $manager= @Yii::app()->session['user'];

                    $amount= trim($_POST['amount']);

                    if(isset($_GET['lend'])){


                        $lender_id = trim($_POST['lender_id']);
                        if($lender_id>0){

                            $name= trim($_REQUEST['name']);

                            $inq="update  lenders   set amount=(amount-$amount),date='$today'  where  id=$lender_id" ;

                            $res=Yii::app()->db->createCommand($inq)->execute();

                            $q="insert into  daily_add_amount set category='Lend Paid',name='$name',amount=$amount,taken_by='$manager',date='$today' " ;
            //die($q);
                $res=Yii::app()->db->createCommand($q)->execute();


                if($res){
                    die(json_encode(array('status'=>'success')));
                }
                else{
                    die(json_encode(array('status'=>'failed','q'=>$q)));
                }

            }



        }
        else{


            $cid = trim(@$_POST['c_id']);
            if($cid>0){

                $category='DUE';
                $name=trim($_POST['customer_name']);
                try {
                    Generic::JomaTransaction($cid,$name,$amount);
                  } catch(Exception $e) {
                    die(json_encode(array('status'=>'failed','msg'=>'something was wrong while processing the transaction', 'error'=>$e->getMessage())));
                  }
                

               
            }
            else{
                $category='OTHER';
                $name= trim($_POST['other_add_option']);
            }

            $q="insert into  daily_add_amount set category='$category',name='$name',amount=$amount,taken_by='$manager',date='$today' " ;
//die($q);
            $res=Yii::app()->db->createCommand($q)->execute();
            if($res){
                $html='<div class="single-product-info">
            <div class="product-name">'.$name.'</div>
            <div class="product-no">'.$amount.'</div>
            <div class="clear"></div>
            </div>';
                die(json_encode(array('status'=>'success','html'=>$html,'category'=>$category,'name'=>$name,'amount'=>$amount)));
            }
            else{
                die(json_encode(array('status'=>'failed','q'=>$q)));
            }

            }

    }

    

    public  function actionDueCustomerNames(){

        $manager= Yii::app()->session['user'];

        $area_name=  addslashes($_POST['area_name']);
        $occupation=  addslashes($_POST['occupation']);

        $options='<option value="">Select or write</option>';
        $q=" select name from customer_due_information where area_name like '$area_name' AND occupation like '$occupation' AND amount > 0 order by name " ;
//die($q);
        $res=Yii::app()->db->createCommand($q)->query();
        if($res){
            while( $row= $res->read()){
                $options.='<option value="'.$row['name'].'">'.ucwords($row['name']).'</option>';
            }
            $newHtml= '
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroup-sizing-default">নাম </span>
            </div>
            <select class="form-control" onchange="GetDueTaka(this);" id="customer_name" name="customer_name" size="1">
              <option value="">Select </option><option value="ANIS">ANIS</option>
              </select>
          ';

            $html='<div class="input-label-name input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default2">নাম </span>
                     </div>
                        <div class="input-field-right form-control">
                            <select class="1form-control"  onchange="GetDueTaka(this);" id="customer_name" name="customer_name"  size="1">
                            '.$options.'
                            </select>
                        </div>
                        <div class="clear"></div>';

            die(json_encode(array('status'=>'success','html'=>$html,'options'=>$options)));
        }
        else{
            die(json_encode(array('status'=>'failed','q'=>$q)));
        }

        /*
        $html='
                                <div class="input-label-name">
                                    নাম
                                </div>

                                <div class="input-field-right">
                                    <input type="text" class="input-field" id="name" name="name" value="">
                                </div>
                                <div class="clear"></div>
                            ';*/
    }

    public function actionCustomerDueAmount(){

        if(!empty($_POST['area_name'])){

            
            $manager= Yii::app()->session['user'];
            $area_name=  addslashes($_POST['area_name']);
            $occupation=  addslashes($_POST['occupation']);
            $name=  addslashes($_POST['name']);

            $options='<option value="">Select</option>';
            $q=" select id,amount  from customer_due_information where area_name like '$area_name' AND occupation like '$occupation' AND name ='$name' order by id limit 1" ;
    //die($q);
            $res=Yii::app()->db->createCommand($q)->query();
            if($res){

                $row =$res->read();
                die(json_encode(array('status'=>'success','id'=>$row['id'],"amount"=>$row['amount'])));
            }else{
                die(json_encode(array('status'=>'failed','q'=>quoted_printable_encode)));
            }
        }
            die(json_encode(array('status'=>'failed','q'=>'invalid')));
        

        /*
        $html='
                                <div class="input-label-name">
                                    নাম
                                </div>

                                <div class="input-field-right">
                                    <input type="text" class="input-field" id="name" name="name" value="">
                                </div>
                                <div class="clear"></div>
                            ';*/
    }

    public function actionDueAreaNames(){

        if(isset($_POST['area_name'])){

            $manager= Yii::app()->session['user'];
            $area_name=  addslashes($_POST['area_name']);

            $options='<option value="">-----</option>';
            $q=" select occupation from customer_due_information where area_name like '$area_name' AND  amount>0  group by occupation order by occupation " ;
            $res=Yii::app()->db->createCommand($q)->query();
            if($res){
                while( $row= $res->read()){
                    $options.='<option value="'.$row['occupation'].'">'.ucwords($row['occupation']).'</option>';
                }

                $html='
                
                <div class="input-label-name input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-defaultp">পেশা</span>
                        </div>
                        <div class="input-field-right form-control">
                            <select onchange="GetDueNames(this);" id="due_occupation" name="due_occupation"  size="1">
                            '.$options.'
                            </select>
                        </div>
                        <div class="clear"></div>';

                die(json_encode(array('status'=>'success','html'=>$html)));
            }
            else{
                die(json_encode(array('status'=>'failed','q'=>$q)));
            }



        }
        elseif(isset($_POST['lender_list'])){
            $lender_list='<option value="">Select or write</option>';
            $qc=" select id,name,amount,date from lenders where amount>0  order by name " ;
//die($q);
            $resl=Yii::app()->db->createCommand($qc)->query();
            if($resl){
                while( $row= $resl->read()){
                    $lender_list.='<option value="'.$row['id'].'">'.ucwords($row['name']).'-'.$row['amount'].'-'.$row['date'].'</option>';
                }
            }
            die(json_encode(array('status'=>'success','html'=>$lender_list)));


        }else{

            $add_q ='SELECT area_name FROM customer_due_information where amount > 0 group by area_name order by area_name ';
            $areas= Yii::app()->db->createCommand($add_q)->queryAll();
            //$areas=$res->fetch_all(MYSQLI_ASSOC);
            $all_areas_due_name='<option value="">Select</option>';
            foreach($areas as $k=>$val){
                $all_areas_due_name.='<option value="'.$val['area_name'].'">'.ucwords($val['area_name']).'</option>';
            }

            $html='


                        <div class="input-label-name input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-defaultpesas">এলাকা ‌‍</span>
                            ‍
                        </div>

                        <div class="input-field-right form-control">
                            <select   onchange="get_due_occupation_name(this);" id="add_area" name="add_area"  size="1">

                               '.$all_areas_due_name.'

                            </select>
                        </div>
                        <div class="clear"></div>


    ';
            die(json_encode(array('status'=>'success','html'=>$html)));





        }


    }


    public function actionLenderList(){
        $manager= Yii::app()->session['user'];


        $options='<option value="">Select</option>';


        $qc=" select id,name,amount,date from lenders where amount>0  order by name " ;
//die($q);
        $res=Yii::app()->db->createCommand($qc)->query();


        if($res){
            while( $row= $res->read()){
                $options.='<option value="'.$row['id'].'">'.ucwords($row['name']).'-'.$row['amount'].'-'.$row['date'].'</option>';
            }
            /*onchange="GetLendAmount(this);"*/
            $html='   <select  id="lender_id" name="lender_id"  size="1">
                            '.$options.'
                            </select>       ';

            die(json_encode(array('status'=>'success','html'=>$html)));
        }
        else{
            die(json_encode(array('status'=>'failed','q'=>$qc)));
        }

        /*
        $html='
                                <div class="input-label-name">
                                    নাম
                                </div>

                                <div class="input-field-right">
                                    <input type="text" class="input-field" id="name" name="name" value="">
                                </div>
                                <div class="clear"></div>
                            ';*/
    }


    public function actionRemoveLastSold(){

        if(isset(Yii::app()->session['last_article_sold']) && Yii::app()->session['last_article_sold']!=''){

            $category_article = Yii::app()->session['last_article_sold'];

            $UPq="UPDATE  articles set total_pair=total_pair+1,total_taka=total_taka+actual_price where article='$category_article'";
            $res1=Yii::app()->db->createCommand($UPq)->execute();
            if($res1){
                $dlq='Delete from daily_sell_information where  id>0 ORDER BY id DESC LIMIT 1';

                $res2=Yii::app()->db->createCommand($dlq)->execute();
                if($res2){
                    unset(Yii::app()->session['last_article_sold']);
                    die(json_encode(array('status'=>'success')));
                }

            }

        }else{
            die(json_encode(array('status'=>'failed')));
        }
    }
    public function actionLendingInfo(){
        //die(print_r($_POST));
        $manager= Yii::app()->session['user'];

        $name=  addslashes($_POST['name']);

        $options='<option value="">Select</option>';
        $q=" select id,amount  from lenders where  name LIKE '$name' order by id limit 1" ;
//die($q);
        $res=Yii::app()->db->createCommand($q)->query();
        if($res){

            $row =$res->read();
            die(json_encode(array('status'=>'success','id'=>$row['id'],"amount"=>$row['amount'])));
        }
        else{
            die(json_encode(array('status'=>'failed','q'=>$q)));
        }

        /*
        $html='
                                <div class="input-label-name">
                                    নাম
                                </div>

                                <div class="input-field-right">
                                    <input type="text" class="input-field" id="name" name="name" value="">
                                </div>
                                <div class="clear"></div>
                            ';*/
    }


    public function actionRemember(){

        $note= addslashes($_REQUEST['note']);
        $date=   addslashes($_REQUEST['date']);
        $qr="Insert into remember_event set notes='$note', date='$date'";
        $res=Yii::app()->db->createCommand($qr)->execute();
        if($res){
            die(json_encode(array('status'=>'success')));
        }else{
            die(json_encode(array('status'=>'failed')));
        }

    }

    public function actionMemoNo(){
        if(isset($_POST['token'])){

            $sql="select * from daily_sell_information where id=".$_POST['token'];
            $res=Yii::app()->db->createCommand($sql)->query();
            if($res){

                $row=$res->read();
                $cat=strtolower($row['category']);
                $img_class=$cat.'_img';
                $right_class='right_item';
                $left_class='left_item';

                if($cat=='dsr' || $cat=='esr'){

                    $right_class='dsr_right_item';
                    $left_class='dsr_left_item';
                }
                if($cat=='esr'){
                    $img_class='dsr_img'; // need to update the image
                }
                $html='

                        <div class="cash_memo">

                                    <div class="'.$left_class.'">
                    '.$row['article'].'
                                    </div>
                                    <div class="'.$right_class.'">
                                        <div class="item_date">
                    '.date('d-M-Y',strtotime($row['date'])).'
                                        </div>
                                        <div class="item_taka">
                    '.$row['price'].'
                                        </div>
                                        <div class="item_signature">
                    '.$row['manager'].'
                                        </div>


                                    </div>
                                </div>
                        ';
                $html='<div class="status '.$img_class.'">'.$html.'</div>';
                $url = Yii::app()->request->baseUrl."/memo.php?article=".$row['article']."&price=".$row['price']."&date=".$row['date']."&category=".$row['category']."&id=".$row['id'];
                die(json_encode(array('status'=>'success','memo'=>$url,'html'=>$html,'data'=>$row,'img_class'=>$img_class)));

            }else{
                die(json_encode(array('status'=>'failed','html'=>'','data'=>'')));
            }
        }
    }



    public function actionSold(){

        $category=@$_REQUEST['category'];


        if(isset($_REQUEST[$category.'_article']) && !isset($_REQUEST[$category.'_article__sexyCombo'])){
            $_POST[$category.'_article__sexyCombo']=$_REQUEST[$category.'_article'];
        }

        $manager=Yii::app()->session['user'];
        if(isset($_POST[$category.'_article__sexyCombo']) && $_POST[$category.'_article__sexyCombo']!=''){
            $category_article = TRIM(strtoupper($_POST[$category.'_article__sexyCombo']));
            $category_sells_man = isset($_REQUEST['salesman'])?$_REQUEST['salesman']:'';
            //$category_size = strtoupper($_POST[$category.'_size']);
            $category_size = '';//strtoupper($_POST[$category.'_size']);
            $category_price = strtoupper($_POST[$category.'_price']);

            #print_r($_REQUEST);die;
            if($_REQUEST['category'] == 'common'){
                $category = $_REQUEST['category'];
                //require_once 'common_class.php';
                //Generic::_setTrace($_POST[$category.'_article__sexyCombo']);
                $common_obj= new common_class();
                $article_info= $common_obj->Get_Article_Details($_POST[$category.'_article__sexyCombo']);
                $category = strtoupper($article_info['category']);
                $actual_rate= strtolower($article_info['actual_price']);
                $profit= $category_price-$actual_rate;
                $UPq="UPDATE  articles set total_pair=total_pair-1,total_taka=total_taka-actual_price where article='$category_article'";
                $res1=Yii::app()->db->createCommand($UPq)->execute();
                if(empty($category)){
                    die(json_encode(array('status'=>'failed','category'=>$category,'article'=>'','sells_man'=>'','size'=>'','price'=>'','color'=>'2')));
                }
                if($category=='ESR'){
                    $profit= intval($category_price * 0.28);
                }

                if($category=='DSR'){
                    $profit= intval($category_price * 0.28);
                }

                $model= new DailySellInformation();
                $model->category =$category;
                $model->profit = $profit;
                $model->sells_man = $category_sells_man;
                $model->article = $category_article;
                $model->manager = $manager;
                $model->price  =$category_price;
                $model->date  = date('Y-m-d H:i:s');
                $model->save();
                if($model->save()){

                    $token = $model->id;

                }else{
                    Generic::_setTrace($model->errors);
                }


                $url = Yii::app()->request->baseUrl."/memo.php?".http_build_query($model->attributes);
                Yii::app()->session['last_article_sold']=$category_article;
                die(json_encode(array('status'=>'success','memo'=>$url,'token'=>$token,'category'=>strtolower($category),'article'=>$category_article,'sells_man'=>$category_sells_man,'size'=>$category_size,'profit'=>$profit,'price'=>number_format($category_price),'color'=>'2')));



            }


            $inq="Insert into daily_sell_information set category='$category', article='$category_article',size='$category_size',manager='$manager',sells_man='$category_sells_man',price=$category_price";
            $res=Yii::app()->db->createCommand($inq);
            $token=Yii::app()->db->insert_id;
            if(!$res){die(Yii::app()->db->error.$inq);}
            die(json_encode(array('status'=>'success','token'=>$token,'category'=>$category,'article'=>$category_article,'sells_man'=>$category_sells_man,'size'=>$category_size,'price'=>number_format($category_price),'color'=>'2')));
        }else{
            die(json_encode(array('status'=>'failed','category'=>$category,'article'=>'','sells_man'=>'','size'=>'','price'=>'','color'=>'2')));
        }

    }


    public function actionLeave(){

        $q='';
        $which_result_div='';
        $msg='';

        $today=date('Y-m-d');

        $manager= Yii::app()->session['user'];
        if(isset($_REQUEST['name'])){



            $qsr=" Insert into kormocari  set name='".$_REQUEST['name']."' , taken_date='$today' , `leave`=".$_REQUEST['cuti'].", manager='$manager' ";
            //PRINT($qsr);
            //PRINT($qsr);
            $up=Yii::app()->db->createCommand($qsr)->execute();
            die(json_encode(array('status'=>'success')));



        }
        die(json_encode(array('status'=>'success','MSG'=>'NO DATA')));

    }













}
