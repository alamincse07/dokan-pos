<?php
/* @var $this SiteController */
$L = $this::$L;
$this->pageTitle=Yii::app()->name;

$user_name= $this->getUserFullName();
$user_type=1;
if(isset($_REQUEST['date'])){

    $today = $_REQUEST['date'];
}else{
    $today = date('Y-m-d');
    // $today = '2013-12-06';
}
//$today = '2014-05-21';
$menus='';
$date= $today;
$day= common_class::Convert_day(date('D'));

//Yii::app()->db->createCommand(
$qr=" select cost_name from cost_items where  cost_type=2";
$qr_res= Yii::app()->db->createCommand($qr)->query();
//Generic::_setTrace($qr_res);
//$select='<option value="">Select</option>';
$dokan_stuff='';
while($row=$qr_res->read()){
    //Generic::_setTrace($row);
    $dokan_stuff.='<option value="'.$row['cost_name'].'">'.$row['cost_name'].'</option>';
    // $dokan_stuff[]= $row['cost_name'];
}

$all_articles='';

#all articles------

//$all_articles=$common_obj->GetAllArticles();

$day= common_class::Convert_day(date('D'));
$all_sells_man_name='<option>select</option>';
/*
$sells_man_q= "SELECT member_name FROM member ";
$resm= Yii::app()->db->createCommand($sells_man_q);
$sells_mana = $resm->fetch_all(MYSQLI_ASSOC);
foreach($sells_mana as $k=>$val){
//print $val['member_name'];
    $all_sells_man_name.='<option value="'.$val['member_name'].'">'.$val['member_name'].'</option>';
}*/


$sell_info=[];
//daily 'daily_sell_info.php';
$vrc_q=" select * from daily_sell_information where DATE(date) ='$today'  order by category desc , id asc " ;
//die($vrc_q);
$vrc_res= Yii::app()->db->createCommand($vrc_q)->query();
//$vrc_res_all=$vrc_res->fetch_all(MYSQLI_ASSOC);


if($vrc_res){
    while($val=$vrc_res->read()){

        $loss='';
        if($val['profit']<0){
            $loss='w3-red';
        }
        $html='<div class="w3-third w3-padding-small w3-border w3-border-blue">  
                 <div class="w3-threequarter" > '.$val['article'].'   </div >
                  <div class=" w3-quarter w3-cyan '.$loss.'">'.intval($val['price']).'</div> 
                </div >';
        $sell_info[$val['category']]['items'][]=$html  ; 
        $sell_info[$val['category']]['total_taka'][]=$val['price']  ; 
        
    }

}


#print_r($sell_info);
//vrc
$vrc_list = (isset($sell_info['VRC']['items']))? implode(" ",$sell_info['VRC']['items']):'';
$total_vrc_taka=(isset($sell_info['VRC']['total_taka']))? array_sum($sell_info['VRC']['total_taka']):0;
$total_vrc_sold=(isset($sell_info['VRC']['items']))?count($sell_info['VRC']['items']):0;

//dsr
$dsr_list = (isset($sell_info['DSR']['items']))? implode(" ",$sell_info['DSR']['items']):'';
$total_dsr_taka=(isset($sell_info['DSR']['total_taka']))? array_sum($sell_info['DSR']['total_taka']):0;
$total_dsr_sold=(isset($sell_info['DSR']['items']))?count($sell_info['DSR']['items']):0;


//BATA
$bata_list = (isset($sell_info['BATA']['items']))? implode(" ",$sell_info['BATA']['items']):'';
$total_bata_taka=(isset($sell_info['BATA']['total_taka']))? array_sum($sell_info['BATA']['total_taka']):0;
$total_bata_sold=(isset($sell_info['BATA']['items']))?count($sell_info['BATA']['items']):0;



//PEGA
$pega_list = (isset($sell_info['PEGA']['items']))? implode(" ",$sell_info['PEGA']['items']):'';
$total_pega_taka=(isset($sell_info['PEGA']['total_taka']))? array_sum($sell_info['PEGA']['total_taka']):0;
$total_pega_sold=(isset($sell_info['PEGA']['items']))?count($sell_info['PEGA']['items']):0;


//APEX
$apex_list = (isset($sell_info['APEX']['items']))? implode(" ",$sell_info['APEX']['items']):'';
$total_apex_taka=(isset($sell_info['APEX']['total_taka']))? array_sum($sell_info['APEX']['total_taka']):0;
$total_apex_sold=(isset($sell_info['APEX']['items']))?count($sell_info['APEX']['items']):0;

//INDIAN
$indian_list = (isset($sell_info['INDIAN']['items']))? implode(" ",$sell_info['INDIAN']['items']):'';
$total_indian_taka=(isset($sell_info['INDIAN']['total_taka']))? array_sum($sell_info['INDIAN']['total_taka']):0;
$total_indian_sold=(isset($sell_info['INDIAN']['items']))?count($sell_info['INDIAN']['items']):0;

#print $total_dsr_taka;die;

$total_vrc_taka= ceil($total_vrc_taka);
$total_dsr_taka= ceil($total_dsr_taka);
$total_indian_taka= ceil($total_indian_taka);

$total_pega_taka= ceil($total_pega_taka);
$total_bata_taka= ceil($total_bata_taka);
$total_apex_taka= ceil($total_apex_taka);

$total_all_sold = $total_vrc_sold+$total_dsr_sold+$total_pega_sold+$total_indian_sold+$total_bata_sold+$total_apex_sold;

//die($all_sells_man_name);



///////////////////////// 'note_information.php';


$note_list='';
$note_q=" select * from remember_event where DATE(date) ='$today' " ;
//die($note_q);
$note_res_all= Yii::app()->db->createCommand($note_q)->queryAll();

if($note_res_all && count($note_res_all)>0){

    foreach($note_res_all as $k=>$val){

       // $note_list .='<li>**'.$val['notes'].'**</li>';
        $note_list .=' <span class="w3-padding-left">'.$val['notes'].'</span>';
    }
  


}



/*
///////////////////////////////////////////
////////////////////////////// 'due_add_information.php';


$due_q ='SELECT area_name FROM `area_names`';
$areas= Yii::app()->db->createCommand($due_q)->queryAll();
//$areas=$res->fetch_all(MYSQLI_ASSOC);
$all_areas_name='';
foreach($areas as $k=>$val){
    $all_areas_name.='<option value="'.$val['area_name'].'">'.ucwords($val['area_name']).'</option>';
}

$occupation_q ='SELECT occupation FROM `customer_occupation` group by occupation order by occupation  ';
$occupations= Yii::app()->db->createCommand($occupation_q)->queryAll();
//$occupations=$res->fetch_all(MYSQLI_ASSOC);
$all_occupation='<option value="">Select</option>';
foreach($occupations as $k=>$val){
    $all_occupation.='<option value="'.$val['occupation'].'">'.ucwords($val['occupation']).'</option>';
}

$vrc_q=" SELECT
customer_due_information.`name`,
customer_transaction.transaction_type,
customer_transaction.amount
FROM
customer_due_information
INNER JOIN customer_transaction ON customer_due_information.id = customer_transaction.customer_id
 WHERE customer_transaction.transaction_type !='PAID' and  customer_transaction.date='$today'  " ;
//die($vrc_q);
$vrc_res_all= Yii::app()->db->createCommand($vrc_q)->queryAll();
//$vrc_res_all=$vrc_res->fetch_all(MYSQLI_ASSOC);
$due_list='';
$total_due_today=0;
$total_due_sold=count($vrc_res_all);
foreach($vrc_res_all as $k=>$val){
    $total_due_today = ($total_due_today+$val['amount']);
    //$articles = explode(',',$val['articles']);
    $due_list .='<div class="single-product-info">
                                <div class="serial-no"></div>
                                <div class="product-name">'.$val['transaction_type'].'</div>
                                <div class="sell-no"></div>
                                <div class="author-name">'.$val['name'].'</div>
                                <div class="product-no">---'.$val['amount'].'</div>
                                <div class="clear"></div>
                            </div>';
}


///////////////////////////////////////////////////////
/////////////////////////////////// 'add_money_info.php';


$all_areas_due_name='<option value="">Select</option>';

$total_add_today='0';


$daily_add_q=" select * from daily_add_amount  where DATE(date) ='$today'  " ;
//die($daily_add_q);
$daily_add_res_all= Yii::app()->db->createCommand($daily_add_q)->queryAll();
//$daily_add_res_all=$daily_add_res->fetch_all(MYSQLI_ASSOC);
//die(print_r($daily_add_res_all));
$add_list='';
$total_add_today=0;
$total_due_sold=count($daily_add_res_all);
foreach($daily_add_res_all as $k=>$val){
    $total_add_today = ($total_add_today+$val['amount']);
//$articles = explode(',',$val['articles']);
    $add_list .='<div class="single-product-info">

    <div class="author-name">'.$val['name'].'</div>
    <div class="product-no">'.$val['amount'].'</div>
    <div class="clear"></div>
</div>';
}


/////////////////////////////////////////////////////////
//////////////////////////////////// 'back_iteams.php';


$back_q=" select * from money_back_iteams  where DATE(date) ='$today'  " ;
//die($back_q);
$back_res_all= Yii::app()->db->createCommand($back_q)->queryAll();
//$back_res_all=$back_res->fetch_all(MYSQLI_ASSOC);
$back_list='';
$total_back_taka=0;
$total_back_sold=count($back_res_all);
foreach($back_res_all as $k=>$val){
    $total_back_taka = ($total_back_taka+$val['amount']);
    $back_list .='<div class="single-product-info">

                                <div class="product-name">'.$val['article'].'</div>

                                <div class="product-no">'.$val['amount'].'</div>
                                <div class="clear"></div>
                            </div>';
}



/////////////////////////////////////////////////////
///////////////////////////////// 'cost_info.php';



$cost_q=" select * from daily_cost_items  where DATE(date) ='$today'  " ;
//die($cost_q);
$cost_res_all= Yii::app()->db->createCommand($cost_q)->queryAll();
//$cost_res_all=$cost_res->fetch_all(MYSQLI_ASSOC);
$cost_list='';
$total_cost_taka=0;
$total_cost_sold=count($cost_res_all);
foreach($cost_res_all as $k=>$val){
    $total_cost_taka = ($total_cost_taka+$val['amount']);
    $cost_list .='<div class="cost-info">
                    <div class="progduct-name" style="float: left">
                       '.$val['cost_type'].'
                    </div>

                    <div style="float: right;color:red;">'.$val['amount'].'</div>
                    <div class="clear"></div>
                  </div>';

}

//-------------------------------for dsr-------------------------------------------


$dsr_cq=" select * from cost_items  order by  cost_name asc" ;
//die($dsr_q);
$cost_items= Yii::app()->db->createCommand($dsr_cq)->queryAll();
//$cost_items =$dsr_resc->fetch_all(MYSQLI_ASSOC);
$cost_items_all='';


foreach($cost_items as $k=>$val){
    $cost_items_all.='<option value="'.$val['cost_name'].'">'.ucwords($val['cost_name']).'</option>';
}


$lender_list='';
$qc=" select name from lenders where amount>0  order by name " ;
//die($q);
$resl=Yii::app()->db->createCommand($qc)->query();
if($resl){
    while( $row= $resl->read()){
        $lender_list.='<option value="'.$row['name'].'">'.ucwords($row['name']).'</option>';
    }


}
///////////////////////////////////////////////////////////////////


*/




 $common_obj= new common_class();
 $all_articles=$common_obj->Get_articles()['dropdown_option'];








?>

<!DOCTYPE html>
<html>
 <head>
   
    <title>Modern Shoe Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="../lib/w3.css">
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/dokan2.js"></script>
    
    <style>
    
      @media print{
            .noprint{
                 display:none !important;
            }

            
           

             /* .city{
                 display:block !important;
            } */
             .due.add.addition.cost.leave{
                 display:block !important;
            }

            form{
                 display:none !important;
            }


        }

    </style>
  
 </head>   

<body class="w3-pale-blue">

    <nav class="w3-sidenav w3-white w3-card-2 w3-center noprint" style="display:none">
        <a href="javascript:void(0)" onclick="w3_close()" class="w3-closenav w3-large">Close &times;</a>
        <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
        <a href="#">Link 4</a>
        <a href="#">Link 5</a>
        <a href="#">Link 5</a>
        <a href="#">Link 5</a>
        <a href="#">Link 5</a>
        <a href="#">Link 5</a>
        <a href="#">Link 5</a>
        <a href="#">Link 5</a>
        <a href="#">Link 5</a>
        <a href="#">Link 5</a>
        <a href="#">Link 5</a>
    </nav>

    <div id="main">

        <header class="w3-container w3-teal">
           
           
           
            <div class="w3-row w3-center">
                <div class="w3-col l1 m1 s1 w3-teal w3-center">
                    <span class="w3-opennav w3-xlarge " onclick="w3_open()">&#9776;</span>
                </div>
                <div class="w3-col l9 m8 s8 w3-black w3-center w3-tag">
                    <h4>Modern Shoe Store </h4>
                </div>
                <div class="w3-col l2 m3 s3 w3-teal w3-center">
                    <p> <a href="#"><?php echo Yii::app()->user->name;?></a> <span class="w3-hide-small">   <?php echo date("Y-m-d")  ?> </span></p>
                </div>
            </div>


           

        </header>
       
        


        <div class="w3-container w3-black w3-border-blue">
            <marquee  direction="left" behavior="loop" scrollamount="6">

               <?= $note_list?>
                
            </marquee>
            
        </div>
        <div class="w3-container w3-teal w3-center">
           <span class="w3-margin-2">Total:<span class="w3-tag w3-black w3-small"><span class="total_sold_counter">  <?=$total_all_sold?></span></span></span>
           <span class="w3-margin-2">DSR:<span class="w3-tag w3-black w3-small"><span class="total_sold_dsr_counter">  <?=$total_dsr_sold?></span></span></span>
           <span class="w3-margin-2">VRC:<span class="w3-tag w3-black w3-small"><span class="total_sold_vrs_counter">  <?=$total_vrc_sold?></span></span></span>
           <span class="w3-margin-2">BATA:<span class="w3-tag w3-black w3-small"><span class="total_sold_bata_counter">  <?=$total_bata_sold?></span></span></span>
           <span class="w3-margin-2">PEGA:<span class="w3-tag w3-black w3-small"><span class="total_sold_pega_counter">  <?=$total_pega_sold?></span></span></span>
          
           
        </div>
        
        
       

        <div class="w3-row w3-center">
            

            <nav class="w3-sidenav w3-black w3-card-1 noprint" style="width:20%">
                
                <a id="sell_btn" href="#" class="tablink w3-padding-16" onclick="openDiv(event, 'sell_item')">বিক্রি</a>
                <a href="#" class="tablink w3-padding-16" onclick="openDiv(event, 'all_sell')">বিক্রিত</a>
                <!-- <a href="#" class="tablink w3-padding-16" onclick="openDiv(event, 'due')">বাকী</a>
                <a href="#" class="tablink w3-padding-16" onclick="openDiv(event, 'add')">জমা</a>
                <a href="#" class="tablink w3-padding-16" onclick="openDiv(event, 'cost')">খরচ</a>
                <a href="#" class="tablink w3-padding-16" onclick="openDiv(event, 'search')">খোজ</a>
                <a href="#" class="tablink w3-padding-16" onclick="openDiv(event, 'back')">ফেরত</a>
                
                <a href="#" class="tablink w3-padding-8" onclick="openDiv(event, 'leave')">ছুটি</a>
                <a href="#" class="tablink w3-padding-8" onclick="document.getElementById('remember').style.display='block'">মনে করো</a>
                <a href="#" class="tablink w3-padding-16" onclick="openDiv(event, 'important')">তথ্য</a>
                <a href="#" class="tablink w3-padding-16" onclick="openDiv(event, 'final')">হিসাব</a> -->
              
            </nav>
            
            <div class="w3-container w3-pale-blue" style="margin-left:12%">
            
                <div id="sell_item" class="w3-container city w3-animate-zoom noprint " style="margin-top:5px;">
                    
                    <div class="w3-row">
                    
                        <div class="w3-col l4 m4 w3-hide-small"> &nbsp;  &nbsp;  </div>
                        <div class="w3-col l4 m4 s12 article_form w3-blue-grey"> 

                            <div class="w3-container w3-black">
                                <h4>বিক্রিত জুতা তথ্য</h4>
                            </div>
                            
                            <form class="w3-container" onsubmit="Common_add(event,this,'#common_price','common');">
                                <label class="w3-label w3-text-black"><b>‍‌‍আর্টিকেল</b></label>
                                <input required class="w3-input w3-border w3-light-grey" id="common_article" name="common_article" list="f_article" type="text">
                                <input type="hidden" id="multipair" value="1" size="1">

                                <label class="w3-label w3-text-black"><b>মুল্য</b></label>
                                <input required class="w3-input w3-border w3-light-grey" id="common_price"  name="common_price" type="number">
                            
                                <p>
                                    <button type="submit" class="w3-btn w3-round-xlarge  w3-teal" style="width:100%;box-shadow:0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19)" >যোগ করুন</button>
                                </p>
                            </form>

                            <div class="w3-card w3-yellow">
                                <p>যোগের পূর্বে সঠিক তথ্য দিন</p>
                                <div class="last_addedc">
                                
                                </div>
                            </div>
                        </div>

                        <div class="w3-col l4 m4 w3-hide-small"> &nbsp; &nbsp;  </div>
                    </div>

                    
                </div>
            




                <div id="all_sell" class="w3-container city w3-animate-zoom  w3-padding-24 noprint" >
             
                        <div class="w3-quarter w3-orange w3-center ">
                        
                            <ul class="w3-ul w3-hoverable w3-text-center">
                                <li><a href="#" class="tablink w3-padding-medium" onclick="openCity(event, 'vrc', 'sale')">VRC</a> </li>
                                <li><a href="#" class="tablink w3-padding-medium" onclick="openCity(event, 'dsr','sale')">DSR</a> </li>
                                <li><a href="#" class="tablink w3-padding-medium" onclick="openCity(event, 'indian','sale')">INDIAN</a> </li>
                                <li><a href="#" class="tablink w3-padding-medium" onclick="openCity(event, 'apex','sale')">APEX</a> </li>
                                <li><a href="#" class="tablink w3-padding-medium" onclick="openCity(event, 'bata','sale')">BATA</a> </li>
                                <li><a href="#" class="tablink w3-padding-medium" onclick="openCity(event, 'pega','sale')">PEGA</a> </li>
                            </ul>
                        
                        </div>
                        
                        <div class="w3-threequarter w3-amber">
                        
                            <div id="dsr" class="w3-container3 sale w3-animate-zoom ">
                        
                                <div class="w3-black"> <h4> DSR SELL LIST  --- <span id="total_dsr_taka"><?=$total_dsr_taka?></span> </h4> 
                                
                                 </div>
                                <div class="w3-row dsr_products_sold">
                                
                                     <?=$dsr_list?>


                                </div>
                        
                        
                            </div>
                        
                            <div id="vrc" class="w3-container sale w3-animate-zoom ">
                        
                                <div class="w3-black">
                                    <h4> VRC SELL LIST  --- <span id="total_vrc_taka"><?=$total_vrc_taka?></span></h4>
                                    
                                </div>
                                <div class="w3-row vrc_products_sold">
                                
                                <?=$vrc_list?>
                            
                            
                                 </div>
                        
                        
                            </div>



                             <div id="indian" class="w3-container3 sale w3-animate-zoom ">
                        
                                <div class="w3-black"> <h4> INDIAN SELL LIST  --- <span id="total_indian_taka"><?=$total_indian_taka?></span> </h4> 
                                
                                 </div>
                                <div class="w3-row indian_products_sold">
                                
                                     <?=$indian_list?>


                                </div>
                        
                        
                            </div>
                        
                        
                            <div id="bata" class="w3-container sale w3-animate-zoom ">
                        
                                <div class="w3-black">
                                    <h4> BATA SELL LIST  --- <span id="total_bata_taka"><?=$total_bata_taka?></span></h4>
                                </div>
                                <div class="w3-row bata_products_sold">
                                
                                  <?=$bata_list?>
                                
                                
                                </div>
                        
                        
                            </div>
                            <div id="apex" class="w3-container sale w3-animate-zoom ">
                            
                                <div class="w3-black">
                                    <h4> Apex SELL LIST  --- <span id="total_bata_taka"><?=$total_bata_taka?></span></h4>
                                </div>
                                <div class="w3-row apex_products_sold">
                                
                                  <?=$apex_list?>
                                
                                
                                
                                
                                </div>
                            
                            
                            </div>


                             <div id="pega" class="w3-container sale w3-animate-zoom ">
                            
                                <div class="w3-black">
                                    <h4> PEGA SELL LIST  --- <span id="total_pega_taka"><?=$total_pega_taka?></span></h4>
                                </div>
                                <div class="w3-row">
                                
                                <?=$pega_list?>
                                
                                
                                
                                
                                </div>
                            
                            
                            </div>
                        
                        </div>
                        
                      
                    

                   
                   




                </div>
            


                <div id="due" class="w3-container city w3-animate-zoom  w3-padding-24">

                    <div class="w3-quarter w3-orange w3-center noprint">

                        <ul class="w3-ul w3-hoverable w3-text-center">
                            <li><a href="#" class="tablink w3-padding-medium" onclick="opendue(event, 'due_item')"> বাকী তথ্য</a> </li>
                            <li><a href="#" class="tablink w3-padding-medium" onclick="opendue(event, 'due_list')">আজকের বাকী </a> </li>
                        </ul>

                    </div>

                    <div class="w3-threequarter w3-amber">

                        <div id="due_list" class="w3-container3 due w3-animate-zoom ">

                            <div class="w3-black">
                                <h4> আজকের বাকী </h4>
                            </div>
                            <div class="w3-row">



                                <div class="w3-third w3-padding-small w3-border">
                                    <div class="w3-threequarter">
                                        demo demo demo
                                    </div>
                                    <div class=" w3-quarter w3-cyan">
                                        155
                                    </div>
                                </div>



                            </div>


                        </div>

                        <div id="due_item" class="w3-container due w3-animate-zoom ">

                            <div class="w3-black">
                                <h4> বাকীর তথ্য</h4>
                            </div>
                            <div class="w3-row">
                                <form class="w3-container">
                                    
                                    <label class="w3-label w3-text-black"><b>‍এলাকা ‌‍</b></label>
                                    <select required class="w3-select" name="option">
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                    </select>

                                    <label class="w3-label w3-text-black"><b>পেশা</b></label>
                                    <select required class="w3-select" name="option">
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                    </select>


                                    <label class="w3-label w3-text-black"><b>নাম</b></label>
                                    <input required="" class="w3-input w3-border w3-light-grey" type="text">

                                    <label class="w3-label w3-text-black"><b>আর্টিকেল</b></label>
                                    <input required="" class="w3-input w3-border w3-light-grey" list="f_article" type="text">
                                
                                    <label class="w3-label w3-text-black"><b>মুল্য</b></label>
                                    <input required="" class="w3-input w3-border w3-light-grey" type="number">
                                
                                    <p>
                                        <button type="submit" class="w3-btn w3-teal">যোগ করুন</button>
                                    </p>
                                </form>

                            </div>


                        </div>


                    </div>










                </div>




                <div id="add" class="w3-container city w3-animate-zoom  w3-padding-24">
                
                    <div class="w3-quarter w3-orange w3-center noprint">
                
                        <ul class="w3-ul w3-hoverable w3-text-center">
                            <li><a href="#" class="tablink w3-padding-medium" onclick="openCity(event, 'add_item','addition')"> জমা তথ্য</a> </li>
                            <li><a href="#" class="tablink w3-padding-medium" onclick="openCity(event, 'add_list','addition')">আজকের জমা </a> </li>
                        </ul>
                
                    </div>
                
                    <div class="w3-threequarter w3-amber">
                
                        <div id="add_list" class="w3-container3 addition w3-animate-zoom ">
                
                            <div class="w3-black">
                                <h4> আজকের জমা </h4>
                            </div>
                            <div class="w3-row">
                
                
                
                                <div class="w3-third w3-padding-small w3-border">
                                    <div class="w3-threequarter">
                                        demo demo demo
                                    </div>
                                    <div class=" w3-quarter w3-cyan">
                                        155
                                    </div>
                                </div>
                
                
                
                            </div>
                
                
                        </div>
                
                        <div id="add_item" class="w3-container addition w3-animate-zoom ">
                
                            <div class="w3-black">
                                <h4> জমার তথ্য</h4>
                            </div>
                            <div class="w3-row">
                                <form class="w3-container">
                
                                    <label class="w3-label w3-text-black"><b>‍এলাকা ‌‍</b></label>
                                    <select required class="w3-select" name="option">
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                    </select>
                
                                    <label class="w3-label w3-text-black"><b>পেশা</b></label>
                                    <select required class="w3-select" name="option">
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                    </select>
                
                
                                    <label class="w3-label w3-text-black"><b>নাম</b></label>
                                    <input required="" class="w3-input w3-border w3-light-grey" type="text">
                
                                  
                                    <label class="w3-label w3-text-black"><b>মুল্য</b></label>
                                    <input required="" class="w3-input w3-border w3-light-grey" type="number">
                
                                    <p class="transactions"> </p>
                                    <p>
                                        <button type="submit" class="w3-btn w3-teal">যোগ করুন</button>
                                    </p>
                                </form>
                
                            </div>
                
                
                        </div>
                
                
                    </div>
                
                
                
                
                
                
                
                
                
                
                </div>




                <div id="cost" class="w3-container city w3-animate-zoom  w3-padding-24">
                
                    <div class="w3-quarter w3-orange w3-center noprint">
                
                        <ul class="w3-ul w3-hoverable w3-text-center">
                            <li><a href="#" class="tablink w3-padding-medium" onclick="openCity(event, 'cost_item','cost')"> খরচ তথ্য</a> </li>
                            <li><a href="#" class="tablink w3-padding-medium" onclick="openCity(event, 'cost_list','cost')">আজকের খরচ </a> </li>
                        </ul>
                
                    </div>
                
                    <div class="w3-threequarter w3-amber">
                
                        <div id="cost_list" class="w3-container3 cost w3-animate-zoom ">
                
                            <div class="w3-black">
                                <h4> আজকের খরচ </h4>
                            </div>
                            <div class="w3-row">
                
                
                
                                <div class="w3-third w3-padding-small w3-border">
                                    <div class="w3-threequarter">
                                        demo demo demo
                                    </div>
                                    <div class=" w3-quarter w3-cyan">
                                        155
                                    </div>
                                </div>
                
                
                
                            </div>
                
                
                        </div>
                
                        <div id="cost_item" class="w3-container cost w3-animate-zoom ">
                
                            <div class="w3-black">
                                <h4> খরচ তথ্য</h4>
                            </div>
                            <div class="w3-row">
                                <form class="w3-container">
                
                                    <label class="w3-label w3-text-black"><b>খরচের খাত ‌‍</b></label>
                                    <select required class="w3-select" name="option">
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                    </select>
                
                                    <label class="w3-label w3-text-black"><b>টাকা</b></label>
                                    <input required="" class="w3-input w3-border w3-light-grey" type="number">
                
                                    <p>
                                        <button type="submit" class="w3-btn w3-teal">যোগ করুন</button>
                                    </p>
                                </form>
                
                            </div>
                
                
                        </div>
                
                
                    </div>
                
                                
                
                
                </div>


                <div id="search" class="w3-container city w3-animate-zoom  w3-padding-24 noprint">
                
                    <div class="search_list search w3-padding-medium">

                        <div class="w3-half w3-orange w3-center w3-padding-medium">
                        
                            <form class="w3-container">
                                <label class="w3-label w3-text-black"><b>‍‌‍আর্টিকেল</b></label>
                                <input required="" class="w3-input w3-border w3-light-grey" type="text">
                        
                        
                                <p>
                                    <button type="submit" class="w3-btn w3-teal">খোজ করুন</button>
                                </p>
                        
                                <p>
                                    <button type="submit" class="w3-btn w3-teal">সম্ভাব্য খোজ</button>
                                </p>
                            </form>
                        
                        </div>
                        
                        <div class="w3-half w3-amber w3-padding-medium">
                        
                            <form class="w3-container">
                                <label class="w3-label w3-text-black"><b>মেমো নং</b></label>
                                <input required="" class="w3-input w3-border w3-light-grey" type="text">
                            
                            
                                <p>
                                    <button type="submit" class="w3-btn w3-teal">খোজ করুন</button>
                                </p>
                            
                            
                                <div class="js_status">
                                    <div class="status vrc_img">
                                
                                        <div class="cash_memo">
                                
                                            <div class="left_item">
                                                ASIA-HILL-6-7
                                            </div>
                                            <div class="right_item">
                                                <div class="item_date">
                                                    17-Mar-2017
                                                </div>
                                                <div class="item_taka">
                                                    130.00
                                                </div>
                                                <div class="item_signature">
                                                    MIJANUR
                                                </div>
                                
                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            </form>
                        
                        
                        </div>

                    </div>
                   
                
                
                
                
                </div>



                <div id="back" class="w3-container city w3-animate-zoom  w3-padding-24">

                    <div class="w3-quarter w3-orange w3-center noprint">

                        <ul class="w3-ul w3-hoverable w3-text-center">
                            <li><a href="#" class="tablink w3-padding-medium" onclick="openCity(event, 'back_item','back')"> ফেরত তথ্য</a>
                            </li>
                            <li><a href="#" class="tablink w3-padding-medium" onclick="openCity(event, 'back_list','back')">আজকের ফেরত
                                </a> </li>
                        </ul>

                    </div>

                    <div class="w3-threequarter w3-amber">

                        <div id="back_list" class="w3-container3 back w3-animate-zoom ">

                            <div class="w3-black">
                                <h4> আজকের ফেরত </h4>
                            </div>
                            <div class="w3-row">



                                <div class="w3-third w3-padding-small w3-border">
                                    <div class="w3-threequarter">
                                        demo demo demo
                                    </div>
                                    <div class=" w3-quarter w3-cyan">
                                        155
                                    </div>
                                </div>



                            </div>


                        </div>

                        <div id="back_item" class="w3-container back w3-animate-zoom ">

                            <div class="w3-black">
                                <h4> ফেরত তথ্য</h4>
                            </div>
                            <div class="w3-row">
                                <form class="w3-container">

                                    <label class="w3-label w3-text-black"><b>আর্টিকেল ‌‍</b></label>
                                    <input required="" class="w3-input w3-border w3-light-grey" list="f_article" type="text">

                                    <label class="w3-label w3-text-black"><b>টাকা</b></label>
                                    <input required="" class="w3-input w3-border w3-light-grey" type="number">

                                    <p>
                                        <button type="submit" class="w3-btn w3-teal">যোগ করুন</button>
                                    </p>
                                </form>

                            </div>


                        </div>


                    </div>




                </div>



                <div id="leave" class="w3-container city">
                    <div class="w3-content w3-card-8 w3-padding-24">


                        

                        <header class="w3-container w3-teal">
                            <h2>ছুটির তথ্য</h2>
                        </header>
                        <div class="w3-container leave_list w3-orange">
                          
                                <div class="w3-quarter">
                                    mijan
                                </div>
                           
                        
                        </div>
                        <form class="w3-container">
                        
                            <label class="w3-label w3-text-black"><b>নাম ‌‍</b></label>
                            <select required="" class="w3-select" name="option">
                                <option value="" disabled="" selected="">Choose your option</option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                                <option value="3">Option 3</option>
                            </select>
                        
                            <p>
                                <label class="w3-label w3-text-black"><b>ছুটির পরিমান(দিন)</b></label>
                                <input required="" class="w3-input w3-border w3-light-grey" type="number">
                            
                            </p>
                            <p>
                                <button type="submit" class="w3-btn w3-teal">যোগ করুন</button>
                            </p>
                        </form>
                    </div>
                </div>




                <div id="important" class="w3-container city">
                    <div class="w3-content w3-card-8 w3-padding-16">
                

                        <form class="w3-container w3-card-4 w3-teal">
                        
                            <h2 class="w3-black">Important Note</h2>
                        
                            <p>
                                <label>Title</label>
                                <input class="w3-input w3-border w3-round" name="first" type="text">
                            </p>
                        
                            <p>
                                <label>Description</label>                        
                            </p>
                            
                            <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px;"></textarea>
                        
                            <p>
                                <label>Picture</label>
                                <input class="w3-input w3-border w3-round-xxlarge" name="last" type="file"></p>
                        
                        
                            <p>
                                <button type="submit" class="w3-btn w3-red">যোগ করুন</button>
                            </p>
                        
                        
                        </form>

                    </div>
                </div>





                <div id="remember" class="w3-modal">
                    <div class="w3-modal-content w3-card-8">
                        <header class="w3-container w3-teal">
                            <span onclick="document.getElementById('remember').style.display='none'" class="w3-closebtn">&times;</span>
                            <h2>স্মরন রাখ</h2>
                        </header>
                        <div class="w3-container">
                        <form class="w3-container">
                        
                            <label class="w3-label w3-text-black"><b>যা মনে রাখতে চান  ‌‍</b></label>
                            <input required="" class="w3-input w3-border w3-light-grey"  type="text">
                        
                            <label class="w3-label w3-text-black"><b>তারিখ</b></label>
                            <input required="" class="w3-input w3-border w3-light-grey" type="date">
                        
                            <p>
                                <button type="submit" class="w3-btn w3-teal">যোগ করুন</button>
                            </p>
                        </form>
                        </div>
                
                    </div>
                </div>




                <div id="final" class="w3-container city">
                    <div class="w3-content w3-card-8 w3-padding-16">


                        <div class="w3-container w3-card-4 w3-white">

                            <h2 class="w3-black">Daily Account</h2>

                           
                            <table class="w3-table w3-striped">
                            
                            
                                <tr>
                                    <td>সম্রাট বিক্রী</td>
                                    <td>94</td>
                                </tr>
                            
                                <tr>
                                    <td>অন্যান্য বিক্রী</td>
                                    <td>94</td>
                                </tr>
                            
                                <tr>
                                    <td>বাটা বিক্রী</td>
                                    <td>94</td>
                                </tr>
                            
                                <tr>
                                    <td>এপেক্স বিক্রী</td>
                                    <td>94</td>
                                </tr>
                            
                                <tr>
                                    <td class="w3-border-bottom w3-border-red">পেগাসাস বিক্রী</td>
                                    <td class="w3-border-bottom w3-border-red">94</td>
                                </tr>
                            
                            
                            
                                <tr>
                                    <td>মোট বিক্রী</td>
                                    <td>94</td>
                                </tr>
                            
                                <tr>
                                    <td>ফেরত</td>
                                    <td>94</td>
                                </tr>
                            
                                <tr>
                                    <td class="w3-border-bottom w3-border-red">বাকী</td>
                                    <td class="w3-border-bottom w3-border-red">94</td>
                                </tr>
                            
                            
                                <tr>
                                    <td>...</td>
                                    <td>94</td>
                                </tr>
                            
                            
                                <tr>
                                    <td>জমা</td>
                                    <td>94</td>
                                </tr>
                            
                                <tr>
                                    <td class="w3-border-bottom w3-border-red">ক্যাশ</td>
                                    <td class="w3-border-bottom w3-border-red">94</td>
                                </tr>
                            
                            
                            
                                <tr>
                                    <td>মোট টাকা</td>
                                    <td>94</td>
                                </tr>
                            
                                <tr>
                                    <td class="w3-border-bottom w3-border-red">মোট খরচ</td>
                                    <td class="w3-border-bottom w3-border-red">67</td>
                                </tr>
                            
                            
                                <td>সর্বশেষ</td>
                                <td>67</td>
                                </tr>
                                <tr>
                            
                            </table>
                           
                        </div>

                    </div>
                </div>





            
            </div>
            
            <script>
                function openDiv(evt, cityName) {
                    var i, x, tablinks;
                    x = document.getElementsByClassName("city");
                    for (i = 0; i < x.length; i++) {
                        x[i].style.display = "none";
                    }
                    tablinks = document.getElementsByClassName("tablink");
                    for (i = 0; i < x.length; i++) {
                        tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
                    }
                    document.getElementById(cityName).style.display = "block";
                  
                    evt.currentTarget.className += " w3-red";
                }
            </script>

        </div>

        <div id="loading" class="w3-overlay  w3-black js_loader">
            <div class="w3-display-middle">
                অপেক্ষা করুন ....
            </div>
        </div>

        <!-- <footer class="w3-container w3-teal">
            <h5>Footer</h5>
            <p>Footer information goes here</p>
        </footer> -->

    </div>

    <script>
        function w3_open() {
            document.getElementById("main").style.marginLeft = "25%";
            document.getElementsByClassName("w3-sidenav")[0].style.width = "25%";
            document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
            document.getElementsByClassName("w3-opennav")[0].style.display = 'none';
        }
        function w3_close() {
            document.getElementById("main").style.marginLeft = "0%";
            document.getElementsByClassName("w3-sidenav")[0].style.display = "none";
            document.getElementsByClassName("w3-opennav")[0].style.display = "inline-block";
        }
    </script>


<script>
    function openCity(evt, cityName,class_name) {
        var i, x, tablinks;
        x = document.getElementsByClassName(class_name);
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        // tablinks = document.getElementsByClassName("tablink");
        // for (i = 0; i < x.length; i++) {
        //     tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
        // }
        document.getElementById(cityName).style.display = "block";
          document.getElementById(cityName).style.minHeight = "300px";
       // evt.currentTarget.firstElementChild.className += " w3-border-red";
    }

    function opendue(evt, cityName) {
            var i, x, tablinks;
            x = document.getElementsByClassName("due");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            // tablinks = document.getElementsByClassName("tablink");
            // for (i = 0; i < x.length; i++) {
            //     tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
            // }
            document.getElementById(cityName).style.display = "block";
            document.getElementById(cityName).style.minHeight = "300px";
            // evt.currentTarget.firstElementChild.className += " w3-border-red";
        }

    
</script>


<datalist style="min-width: 220px; float: right;" id="f_article">

  <?php echo $all_articles?>
</datalist>

</body>

</html>