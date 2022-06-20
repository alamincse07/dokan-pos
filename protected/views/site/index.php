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
$dokan_stuff='<option value="">Salesman</option>';
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



//daily 'daily_sell_info.php';



$vrc_q=" select * from daily_sell_information where DATE(date) ='$today'  order by category desc , id asc " ;
//die($vrc_q);
$vrc_res= Yii::app()->db->createCommand($vrc_q)->query();
//$vrc_res_all=$vrc_res->fetch_all(MYSQLI_ASSOC);

$vrc_list='';
$total_vrc_taka=0;
$total_vrc_sold=0;

$dsr_list='';
$total_dsr_taka=0;
$total_dsr_sold=0;

$esr_list='';
$total_esr_taka=0;
$total_esr_sold=0;

$bata_list='';
$total_bata_taka=0;
$total_bata_sold=0;

$indian_list='';
$total_indian_taka=0;
$total_indian_sold=0;


$pega_list='';
$total_pega_taka=0;
$total_pega_sold=0;

$lotto_list='';
$total_lotto_taka=0;
$total_lotto_sold=0;

$apex_list='';
$total_apex_taka=0;
$total_apex_sold=0;
if($vrc_res){
    while($val=$vrc_res->read()){

        $loss='';
        if($val['profit']<0){
            $loss='red';
        }
        if(strtoupper($val['category'])=='DSR'){
            $total_dsr_sold++;
            $total_dsr_taka = ($total_dsr_taka+$val['price']);

            $dsr_list .='<div class="single-product-info">
                                <div class="serial-no">'.$total_dsr_sold.'.</div>
                                <div class="product-name">'.$val['article'].'</div>
                                <div class="sell-no">'.$val['size'].'</div>
                                <div class="author-name">'.$val['sells_man'].'</div>
                                <div class="product-no '.$loss.'">'.$val['price'].'</div>
                                <div class="clear"></div>
                            </div>';
        }
        if(strtoupper($val['category'])=='ESR'){
            $total_esr_sold++;
            $total_esr_taka = ($total_esr_taka+$val['price']);

            $esr_list .='<div class="single-product-info">
                                <div class="serial-no">'.$total_esr_sold.'.</div>
                                <div class="product-name">'.$val['article'].'</div>
                                <div class="sell-no">'.$val['size'].'</div>
                                <div class="author-name">'.$val['sells_man'].'</div>
                                <div class="product-no '.$loss.'">'.$val['price'].'</div>
                                <div class="clear"></div>
                            </div>';
        }

        if(strtoupper($val['category'])=='INDIAN'){

            $total_indian_sold++;
            $total_indian_taka = ($total_indian_taka+$val['price']);
            $indian_list .='<div class="single-product-info">
                                <div class="serial-no">'.$total_indian_sold.'.</div>
                                <div class="product-name">'.$val['article'].'</div>
                                <div class="sell-no">'.$val['size'].'</div>
                                <div class="author-name">'.$val['sells_man'].'</div>
                             <div class="product-no '.$loss.'">'.$val['price'].'</div>
                                <div class="clear"></div>
                            </div>';
        }
        if(strtoupper($val['category'])=='VRC'){

            $total_vrc_sold++;
            $total_vrc_taka = ($total_vrc_taka+$val['price']);
            $vrc_list .='<div class="single-product-info">
                                <div class="serial-no">'.$total_vrc_sold.'.</div>
                                <div class="product-name">'.$val['article'].'</div>
                                <div class="sell-no">'.$val['size'].'</div>
                                <div class="author-name">'.$val['sells_man'].'</div>
                               <div class="product-no '.$loss.'">'.$val['price'].'</div>
                                <div class="clear"></div>
                            </div>';
        }
        if(strtoupper($val['category'])=='BATA'){

            $total_bata_sold++;
            $total_bata_taka = ($total_bata_taka+$val['price']);
            $bata_list .='<div class="single-product-info">
                                <div class="serial-no">'.$total_bata_sold.'.</div>
                                <div class="product-name">'.$val['article'].'</div>
                                <div class="sell-no">'.$val['size'].'</div>
                                <div class="author-name">'.$val['sells_man'].'</div>
                               <div class="product-no '.$loss.'">'.$val['price'].'</div>
                                <div class="clear"></div>
                            </div>';
        }
        if(strtoupper($val['category'])=='PEGA'){

            $total_pega_sold++;
            $total_pega_taka = ($total_pega_taka+$val['price']);
            $pega_list .='<div class="single-product-info">
                                <div class="serial-no">'.$total_pega_sold.'.</div>
                                <div class="product-name">'.$val['article'].'</div>
                                <div class="sell-no">'.$val['size'].'</div>
                                <div class="author-name">'.$val['sells_man'].'</div>
                                <div class="product-no '.$loss.'">'.$val['price'].'</div>
                                <div class="clear"></div>
                            </div>';
        }
        if(strtoupper($val['category'])=='LOTTO'){

            $total_lotto_sold++;
            $total_lotto_taka = ($total_lotto_taka+$val['price']);
            $lotto_list .='<div class="single-product-info">
                                <div class="serial-no">'.$total_lotto_sold.'.</div>
                                <div class="product-name">'.$val['article'].'</div>
                                <div class="sell-no">'.$val['size'].'</div>
                                <div class="author-name">'.$val['sells_man'].'</div>
                                <div class="product-no '.$loss.'">'.$val['price'].'</div>
                                <div class="clear"></div>
                            </div>';
        }
        if(strtoupper($val['category'])=='APEX'){


            $total_apex_sold++;
            $total_apex_taka = ($total_apex_taka+$val['price']);
            $apex_list .='<div class="single-product-info">
                                <div class="serial-no">'.$total_apex_sold.'.</div>
                                <div class="product-name">'.$val['article'].'</div>
                                <div class="sell-no">'.$val['size'].'</div>
                                <div class="author-name">'.$val['sells_man'].'</div>
                                <div class="product-no '.$loss.'">'.$val['price'].'</div>
                                <div class="clear"></div>
                            </div>';
        }
    }

}

$total_vrc_taka= ceil($total_vrc_taka);
$total_dsr_taka= ceil($total_dsr_taka);
$total_esr_taka= ceil($total_esr_taka);
$total_indian_taka= ceil($total_indian_taka);
$total_pega_taka= ceil($total_pega_taka);
$total_lotto_taka= ceil($total_lotto_taka);
$total_bata_taka= ceil($total_bata_taka);
$total_apex_taka= ceil($total_apex_taka);

$total_all_sold = $total_vrc_sold+$total_dsr_sold+$total_esr_sold+$total_pega_sold+$total_lotto_sold+$total_indian_sold+$total_bata_sold+$total_apex_sold;

//die($all_sells_man_name);



///////////////////////// 'note_information.php';


$note_list='';
$note_q=" select * from remember_event where DATE(date) ='$today' " ;
//die($note_q);
$note_res_all= Yii::app()->db->createCommand($note_q)->queryAll();

if($note_res_all && count($note_res_all)>0){

    foreach($note_res_all as $k=>$val){

        $note_list .='<li>**'.$val['notes'].'**</li>';
    }
    $note_list=' <marquee onMouseOver="this.stop()" onMouseOut="this.start()" scrolldelay="10" scrollamount="1" direction="left" height="20">
                    <ul id="remember_content">

                        '.$note_list.'
                    </ul>
                </marquee>';


}

$note_list2=' <marquee  scrolldelay="10" scrollamount="1" direction="left">
                    <ul class="remember_items" id="remember_content">

                       <li>add some taka</li>
                    </ul>
                </marquee>';
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

$vrc_q="SELECT
    customer_due_information.`name`,
    customer_due_information.`id`,
    customer_transaction.transaction_type,
    customer_transaction.amount,
    customer_transaction.total_due
    FROM
    customer_due_information
    INNER JOIN customer_transaction ON customer_due_information.id = customer_transaction.customer_id
    WHERE   customer_transaction.date='$today' order by customer_transaction.id asc " ;
//die($vrc_q);
$vrc_res_all= Yii::app()->db->createCommand($vrc_q)->queryAll();
//$vrc_res_all=$vrc_res->fetch_all(MYSQLI_ASSOC);
// print_r($vrc_res_all);
$cus_articles_due= [];
$due_list='';
$total_due_today=0;
$total_due_sold=count($vrc_res_all);
foreach($vrc_res_all as $k=>$val){
     //total_due =1 means the linked payment
    if($val['transaction_type'] == 'PAID' && $val['total_due'] =='1'){
        if(isset($cus_articles_due[$val['id']])){
           
            $amount = $cus_articles_due[$val['id']]['amount'] -  $val['amount'];
            $cus_articles_due[$val['id']] = ['name'=> $val['name'], 'amount'=>$amount];
        }
    }else{
        if($val['transaction_type'] !== 'PAID'){
            $cus_articles_due[$val['id']] = ['name'=> $val['name'], 'amount'=>$val['amount']];

        }
       
    }


}

foreach($cus_articles_due as $k=>$val){
    $total_due_today = ($total_due_today+$val['amount']);
    //$articles = explode(',',$val['articles']);
    $due_list .='<div class="single-product-info">
                                <div class="serial-no"></div>
                               
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
















?>



<style>
    .ui-datepicker {
        display: none;
        padding: 0.2em 0.2em 0;
        width: 13em;
    }
</style>

<!--Plug-in Initialisation-->
<script type="text/javascript">
    $(document).ready(function() {
        //Horizontal Tab
        $('#parentHorizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'hor_1', // The tab groups identifier
            activetab_bg: '#c26dff', // background color for active tabs in this group
            inactive_bg: '#8e0100', // background color for inactive tabs in this group
            active_border_color: '#c26dff', // border color for active tabs heads in this group
            active_content_border_color: '#8e0100', // border
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });

        // Child Tab
        $('#ChildVerticalTab_1').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true,
            tabidentify: 'ver_1', // The tab groups identifier
            activetab_bg: '#fff', // background color for active tabs in this group
            inactive_bg: '#fffe11', // background color for inactive tabs in this group
            active_border_color: '#c26dff', // border color for active tabs heads in this group
            active_content_border_color: '#c26dff' // border color for active tabs contect in this group so that it matches the tab head border
        });

        //Vertical Tab
        $('#parentVerticalTab').easyResponsiveTabs({
            type: 'vertical', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            tabidentify: 'hor_1', // The tab groups identifier
            activetab_bg: '#c26dff', // background color for active tabs in this group
            inactive_bg: '#8e0100', // background color for inactive tabs in this group
            active_border_color: '#c26dff', // border color for active tabs heads in this group
            active_content_border_color: '#8e0100', // border

            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo2');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
    });
</script>
<script type="application/javascript">


function GetPrice(art){
     console.log('getting price--');
     
    
    if(art !='' && art!='undefined'&& window.price_list[art]!='undefined' && window.price_list[art] > 1)
       {
           
        $('#common_price').val(window.price_list[art]);

       }else{
           
           $('#common_price').focus();
           $('#common_price').val('');

           setTimeout(function() {
            document.getElementById('common_price').focus();
            }, 100);
       }
    
}
 window.price_list=[];
    $(document).ready(function(){

    
        $('#common_article').on('change', function(event, params) {
           
                GetPrice($(this).val());
                $('#salesman').val('');
                $('input[name=salesman__sexyCombo]').val('Salesman');
          });

        $('#single_chk').attr('checked',true);
        $.ajax({
            dataType:"json"

            ,url:SITE_URL+"SimpleAjax/ArticleInfo?all=true"

            ,success: function(data) {
                if(data.status == 'success')
                {
                    $('.js_articles').attr("data-placeholder","Select Article");
                    $('.js_articles').html("<option value=''></option>"+data.all_articles);
                    $('.js_articles').chosen();
                    $('#due_article').chosen();
                    $('.chosen-container').width("220px");
                    /*$(".sexy_select").sexyCombo({
                        autoFill: true,
                        triggerSelected: true            //skin: "custom"
                    });*/
                    if(window.price_list.length<1){
                        window.price_list=data.price_list;
                    }



                }
            }
        });
    });


</script>


<!--Start header-->
<header>
    <div class="inner-wrapper">
        <div class="main-header">
            <div class="top-nav-left">
                <div class="user-name">
                    USER : <?= $user_name;?>
                </div>
                <div class="date-plus-day">
                    <div class="date"><?=$date;?></div>
                    <div class="day"><?=$day;?></div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="top-nav">
                <div class="counts">
                    <ul>
                        <li>মোটজোড়া : <span class="product-counter total_sold_counter"><?=$total_all_sold;?></span></li>
                        <li>বাটা : <span class="product-counter total_sold_bata_counter"><?=$total_bata_sold;?></span></li>
                        <li>ঈগল  : <span class="product-counter total_sold_esr_counter"><?=$total_esr_sold;?></span></li>
                        <li>ঢাকা : <span class="product-counter total_sold_dsr_counter"><?=$total_dsr_sold;?></span></li>
                        <li>INDIAN : <span class="product-counter total_sold_dsr_counter"><?=$total_indian_sold;?></span></li>
                        <li>অন্যান্য : <span class="product-counter total_sold_vrc_counter"><?=$total_vrc_sold;?></span> </li>
                        <li>পেগাসাস : <span class="product-counter total_sold_pega_counter"><?=$total_pega_sold;?></span></li>
                        <li>LOTTO : <span class="product-counter total_sold_lotto_counter"><?=$total_lotto_sold;?></span></li>
                        <li>এপেক্স : <span class="product-counter total_sold_apex_counter"><?=$total_apex_sold;?></span></li>
                        <!-- <li>MEMO : <span class="product-counter total_sold_memo_counter">2563</span></li>-->
                    </ul>
                </div>
                <div class="extra_menu">

                    <div class="previous-cash">
                        <a class="bikroy" href="javascript:void(0);" onclick="open_and_show('common')">বিক্রিত</a>
                    </div>
                    <div onclick="Correct(this)"  class="entry_correct">
                        ভূল সংশোধন
                    </div>
                    <div class="result">
                        <a  onclick="get_cash_amount();" href="javascript:void(0);">হিসাব ক্লোজ </a>
                    </div>
                    <div class="result">
                        <a href="/site/logout">বাহির </a>
                    </div>

                </div>

                <div class="important-note">
                    <div class="important-note-content">
                        <?=$note_list;?>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</header>
<!--End header-->


<section>

<div class="container9">

<div  id="parentHorizontalTab">
    <ul class="resp-tabs-list hor_1 non-print">

        <li class="js_sale"><a  href="javascript:void(0);" onclick="open_and_show('common')">বিক্রিত</a></li>
        <li><a onclick="open_and_show('bata');" href="javascript:void(0);">বাটা</a></li>

                <li><a onclick="open_and_show('dsr');" href="javascript:void(0);">ঢাকা</a></li>
                <li><a onclick="open_and_show('esr');" href="javascript:void(0);">ঈগল </a></li>

        <li><a onclick="open_and_show('indian');" href="javascript:void(0);">INDIAN</a></li>
        <li><a onclick="open_and_show('vrc');" href="javascript:void(0);">অন্যান্য</a></li>
        <li><a onclick="open_and_show('apex');" href="javascript:void(0);">এপেক্স</a></li>


        <li><a onclick="open_and_show('pega');" href="javascript:void(0);">পেগা</a></li>
        <li><a onclick="open_and_show('lotto');" href="javascript:void(0);">LOTTO</a></li>
        <li><a onclick="open_and_show('due');" href="javascript:void(0);">বাকী</a></li>
        <li><a onclick="open_and_show('add');" href="javascript:void(0);">জমা</a></li>
        <li><a onclick="open_and_show('search');" href="javascript:void(0);">খোজ</a></li>
        <li><a onclick="open_and_show('cost');" href="javascript:void(0);">খরচ</a></li>
        <li><a onclick="open_and_show('back');" href="javascript:void(0);">ফেরত</a></li>
        <li class="js_close"><a onclick="open_and_show('back');" href="javascript:void(0);">Final</a></li>
          <!--<li><a target="_blank" href="http://localhost/dokan/options/claim.php">ক্লেম</a></li>-->

    </ul>
    <div class="resp-tabs-container hor_1">
        <div class="single-tab common_div non-print">
            <div  class="tab_content " style="margin-left:150px">
                <div class="data-input-holder " >
                    <h1 class="add-item">বিক্রিত জুতা যোগ করো</h1>
                    <form  method="post" action="">
                        <fieldset>
                            <div  class="input-field-block ">
                                <div class="input-label-name1">

                                    <input title="মোট টাকা দিবেন " type="radio" id="paikari_chk" onchange="multi_sell();" name="sell_type">

                         <span title="মোট টাকা দিবেন ">
                               পাইকারী
                        </span>


                                    <input type="radio" title="জোড়ার  টাকা দিবেন " id="single_chk"  onchange="single_sell();" name="sell_type">

                          <span title="জোড়ার  টাকা দিবেন ">
                          খুচরা

                        </span>

                                    <input type="text" id="multipair" value="1" size="1"> Pair


                                </div>


                                <div class="clear"></div>
                            </div>

                            <div class="input-field-block">
                                <div class="input-label-name">
                                    ‍‌‍আর্টিকেল
                                </div>

                                <div class="input-field-right">
                                    <select style="min-width: 220px;" id="common_article" onSelect="GetPrice(this)" class="sexy_select js_articles" name="common_article"  size="1">

                                        <?=$all_articles;?>

                                    </select>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="input-field-block paikari hidden">
                                <div class="input-label-name">
                                    জোড়া
                                </div>

                                <div class="input-field-right">
                                    <input type="text" id="common_pair" class="input-field" name="common_size" value="0">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="input-field-block">
                                <div class="input-label-name">
                                    মুল্য
                                </div>

                                <div class="input-field-right">
                                    <input type="text" required="true" class="input-field common_price" name="common_price" id="common_price" value="">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="input-field-block">
                                        <div class="input-label-name">
                                        Sold by
                                        </div>

                                        <div class="input-field-right ">
                                            <select class="sexy_select" style="min-width: 220px; float: right;" id="salesman" name="salesman"  size="1">

                                            <?=$dokan_stuff;?>

                                            </select>
                                        </div>
                                        <div class="clear"></div>
                            </div>
                           

                            <div style="margin-top:10px">
                            <input class="common_save submit_button" onclick="Common_add(event,this,'#common_price','common');"  type="submit" value="যোগ করুন "/>

                            </div>
                        </fieldset>
                    </form>
                    <div class="total added_item">
                        যোগের পূর্বে সঠিক তথ্য দিন
                    </div>
                    <div class="last_addedc">

                    </div>
                </div>
                <div class="data-input-holder" style="margin-left:100px" >
                    <button onclick="ClearMemo()"> Clear Invoice X</button>


                    <table id="memolist">
                    <thead>
                      <tr>
                        <th>Article</th>
                        <th>Memo</th>
                    	<th>Taka</th>
                      </tr>
                     </thead>
                     <tbody>
                     
                      </tbody>
                    </table>
                </div>


            </div>
        </div>
        <div class="single-tab bata_div non-print">


                <div class="index-container-left ">
                    <div class="product-collection ">
                        <div class="product-head">
                            <div class="products-buyer-info">বাটা  বিক্রয় তালিকা -

                                মোট টাকা : <span id="total_bata_taka"><?=$total_bata_taka;?></span>.00/-
                                মোট জোড়া  : <span class="total_sold_bata_counter"><?=$total_bata_sold;?> </span>
                            </div>
                        </div>
                        <div class="bata_products_sold">

                            <?=$bata_list;?>
                        </div>

                        <div class="clear"></div>
                    </div>
                </div>

        </div>
        <div  class="single-tab dsr_div non-print">
            <div >

                <div class="index-container-left">
                    <div class="product-collection ">
                        <div class="product-head">
                            <div class="products-buyer-info"> ঢাকা সম্রাট  বিক্রয় তালিকা -

                                মোট টাকা : <span id="total_dsr_taka"><?=$total_dsr_taka;?></span>.00/-
                                মোট জোড়া  : <span class="total_sold_dsr_counter"><?=$total_dsr_sold;?> </span>
                            </div>
                        </div>
                        <div class="dsr_products_sold">

                            <?=$dsr_list;?>
                        </div>

                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>

        <div  class="single-tab esr_div non-print">
            <div >

                <div class="index-container-left">
                    <div class="product-collection ">
                        <div class="product-head">
                            <div class="products-buyer-info"> ঈগল  সম্রাট  বিক্রয় তালিকা -

                                মোট টাকা : <span id="total_esr_taka"><?=$total_esr_taka;?></span>.00/-
                                মোট জোড়া  : <span class="total_sold_esr_counter"><?=$total_esr_sold;?> </span>
                            </div>
                        </div>
                        <div class="esr_products_sold">

                            <?=$esr_list;?>
                        </div>

                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>

        <div  class="single-tab indian_div non-print">
            <div >

                <div class="index-container-left">
                    <div class="product-collection ">
                        <div class="product-head">
                            <div class="products-buyer-info"> INDIAN বিক্রয় তালিকা -

                                মোট টাকা : <span id="total_indian_taka"><?=$total_indian_taka;?></span>.00/-
                                মোট জোড়া  : <span class="total_sold_indian_counter"><?=$total_indian_sold;?> </span>
                            </div>
                        </div>
                        <div class="indian_products_sold">

                            <?=$indian_list;?>
                        </div>

                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <div  class="single-tab vrc_div non-print">
            <div   class="hidden1 ">

                <div class="index-container-left">
                    <div class="product-collection ">
                        <div class="product-head">
                            <div class="products-buyer-info">অন্যান্য বিক্রয় তালিকা -

                                মোট টাকা : <span id="total_vrc_taka"><?=$total_vrc_taka;?></span>.00/-
                                মোট জোড়া  : <span class="total_sold_vrc_counter"><?=$total_vrc_sold;?> </span>
                            </div>
                        </div>
                        <div class="vrc_products_sold">

                            <?=$vrc_list;?>
                        </div>

                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <div  class="single-tab apex_div non-print">
            <div  >

                <div class="index-container-left">
                    <div class="product-collection ">
                        <div class="product-head">
                            <div class="products-buyer-info">এপেক্স বিক্রয় তালিকা -

                                মোট টাকা : <span id="total_apex_taka"><?=$total_apex_taka;?></span>.00/-
                                মোট জোড়া  : <span class="total_sold_apex_counter"><?=$total_apex_sold;?> </span>
                            </div>
                        </div>
                        <div class="apex_products_sold">

                            <?=$apex_list;?>
                        </div>

                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>

        <div  class="single-tab pega_div non-print">

            <div  >

                <div class="index-container-left">
                    <div class="product-collection ">
                        <div class="product-head">
                            <div class="products-buyer-info">পেগাসাস বিক্রয় তালিকা -

                                মোট টাকা : <span id="total_pega_taka"><?=$total_pega_taka;?></span>.00/-
                                মোট জোড়া  : <span class="total_sold_pega_counter"><?=$total_pega_sold;?> </span>
                            </div>
                        </div>
                        <div class="pega_products_sold">

                            <?=$pega_list;?>
                        </div>

                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
        <div  class="single-tab lotto_div non-print">

<div  >

    <div class="index-container-left">
        <div class="product-collection ">
            <div class="product-head">
                <div class="products-buyer-info">LOTTO বিক্রয় তালিকা -

                    মোট টাকা : <span id="total_lotto_taka"><?=$total_lotto_taka;?></span>.00/-
                    মোট জোড়া  : <span class="total_sold_lotto_counter"><?=$total_lotto_sold;?> </span>
                </div>
            </div>
            <div class="lotto_products_sold">

                <?=$lotto_list;?>
            </div>

            <div class="clear"></div>
        </div>
    </div>
</div>
</div>
        <div  class="single-tab baki_div">


            <div  class="hidden1 due_div">

                <div   class="due_total_div print">
                    <div>
                        মোট বাকী - <span class="total_due"><?=$total_due_today;?></span>.00/-

                    </div>
                      <div class="due_items">

                        <?=$due_list;?>

                    </div>

                </div>
                <div class="tab_content_right  data-input-holder non-print">
                    <h1 class="add-item">বাকী সম্পর্কিত তথ্য </h1>
                    <form  id="baki_info">
                        <fieldset>
                            <div class="input-field-block">
                                <div class="input-label-name">
                                    ‍এলাকা ‌‍
                                </div>

                                <div class="input-field-right">
                                    <select id="due_area"  class="sexy_select" name="due_area"  size="1">

                                        <?=$all_areas_name;?>

                                    </select>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="input-field-block">
                                <div class="input-label-name">
                                    পেশা
                                </div>

                                <div class="input-field-right">
                                    <select id="occupation"  onchange="Build_customer_names(this,'#due_area')" name="occupation"  size="1">

                                        <?=$all_occupation;?>
                                    </select>

                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="input-field-block">
                                <div class="input-label-name">
                                    নাম
                                </div>

                                <div class="input-field-right js_due_customer_names">
                                    <input type="text" class="input-field" id="name" name="name" value="">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="input-field-block">
                                <div class="input-label-name">
                                    আর্টিকেল
                                </div>

                                <div class="input-field-right">

                                    <select  class="sexy_select js_articles" id="due_article" name="due_article"  size="1">

                                        <?=$all_articles;?>

                                    </select>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="input-field-block">
                                <div class="input-label-name">
                                নীট  টাকা
                                </div>

                                <div class="input-field-right">
                                    <input type="text" class="input-field" name="due_amount" id="due_amount" value="">
                                </div>

                                <div class="clear"></div>
                            </div>
                            <div class="input-field-block">
                                <div class="input-label-name">
                                এখন জমা 
                                </div>

                                <div class="input-field-right">
                                    <input type="text" class="input-field" name="partial_due_amount" id="partial_due_amount" value="0">
                                </div>

                                <div class="clear"></div>
                            </div>

                            <input class="common_save submit_button" onclick="Due_add(event,this,'#name','#due_amount');"  type="submit" value="যোগ করুন "/>
                        </fieldset>
                    </form>
                    <div class="total due_last_added">
                        যোগের পূর্বে সঠিক তথ্য দিন
                    </div>
                    <div class="last_added"></div>
                </div>


            </div>


        </div>

        <div  class="single-tab joma_div">

            <!--vertical Tabs-->

            <div id="ChildVerticalTab_1">
                <ul class="resp-tabs-list ver_1 non-print">
                    <li>আজকের জমা </li>
                    <li> অন্যান্য  জমা </li>
                    <li onclick="show_lenders()">কর্জ জমা </li>
                    <li onclick="set_due_list()">বাকী  জমা </li>
                </ul>
                <div class="resp-tabs-container ver_1">
                    <div class="print" >
                        <div class="add_total_div">
                            মোট জমা - <span class="total_add"><?=$total_add_today;?></span>.00/-

                        </div>
                         <div class="add_items">

                            <?=$add_list;?>

                        </div>

                    </div>
                    <div class="other-joma non-print">
                        <form  class="js_other_joma">



                            <div class="input-field-block">
                                <div class="input-label-name">
                                    জমার নাম
                                </div>

                                <div class="input-field-right lenders_div">

                                    <input type="text" required="true" class="input-field" name="other_add_option" id="other_add_option" value="">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="input-field-block">
                                <div class="input-label-name">
                                    টাকা
                                </div>

                                <div class="input-field-right">
                                    <input type="text" class="input-field js_taka" name="amount" id="add_amount1" value="">

                                </div>

                            </div>

                            <input type="button" value="যোগ করুন " onclick="Insert_add_amount1(event,this,'#add_amount','.add_last_added');" class="common_save submit_button">


                        </form>

                    </div>
                    <div class="lend-joma non-print">
                        <form class="korjo_joma">

                            <div class="input-field-block">
                                <div class="input-label-name">
                                    জমাকারীর নাম
                                </div>

                                <div class="input-field-right lenders_div">


                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="input-field-block">
                                <div class="input-label-name">
                                    টাকা
                                </div>

                                <div class="input-field-right">

                                    <input type="text" class="input-field js_taka" name="amount" id="lend_amount" value="">

                                </div>

                            </div>

                            <input type="submit" value="যোগ করুন " onclick="Insert_add_amount2(event,this,'#add_amount','.add_last_added');" class="common_save submit_button">

                        </form>
                    </div>
                    <div class="non-print">
                        <form >
                            <fieldset>
                                <div class="due_money_add_fields">

                                    <div class="input-field-block js_due_areas">
                                        <div class="input-label-name">
                                            ‍এলাকা ‌‍
                                        </div>

                                        <div class="input-field-right">
                                            <select   class="sexy_select" onchange="get_due_occupation_name(this);" id="add_area" name="add_area"  size="1">

                                                <?=$all_areas_due_name;?>

                                            </select>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="input-field-block due_occupation_from_area">

                                    </div>
                                    <div class="input-field-block due_customer_names">

                                    </div>

                                </div>

                                <div class="input-field-block">
                                    <div class="input-label-name">
                                        টাকা
                                    </div>

                                    <div class="input-field-right">
                                        <input type="hidden" class="input-field" name="customer_id" id="customer_id" value="0">
                                        <input type="hidden" class="input-field" name="customer_taka" id="customer_taka" value="0">

                                        <input type="text" class="input-field js_taka" name="add_amount" id="add_amount" value="">

                                    </div>
                                    <div style="padding-left: 5px;" class="input-field-right">
                                        <a style="display: none;" id="c_transaction" target="_blank" href="">লেনদেন </a>
                                    </div>
                                    <div class="clear"></div>
                                </div>

                                <input class="common_save submit_button" onclick="Insert_add_amount3(event,this,'#add_amount','.add_last_added');"  type="submit" value="যোগ করুন "/>
                            </fieldset>
                        </form>

                    </div>
                </div>
                <div class="total add_last_added non-print">
                    যোগের পূর্বে সঠিক তথ্য দিন
                </div>
                <div class="last_added"></div>
            </div>


        </div>
        <div  class="single-tab search_div non-print">
            <div  class="hidden1 ">

                <div class="data-input-holder " >

                    <form  method="post" action="">
                        <fieldset>




                            <div class="input-field-block">
                                <div class="input-label-name">
                                    আর্টিকেল
                                </div>

                                <div class="input-field-right">
                                    <input type="text" class="input-field" name="search_article" id="search_article" value="">

                                </div>
                                <div class="clear"></div>
                            </div>




                            <input class="common_save submit_button" onclick="search_for_article(event,this,'#search_article','.search_last_searched');"  type="submit" value="খোজ করুন "/>
                        </fieldset>
                    </form>

                    <input type="hidden" class="input-field" name="possible_search_article" id="possible_search_article" value="">
                    <input class="common_save submit_button" onclick="possible_search_for_article(event,this,'#search_article','.search_last_searched');"  type="submit" value="সম্ভাব্য খোজ "/>

                    <div  style="margin: 5px;" class="article_info">

                    </div>
                    <div style="display: none;" class="total search_last_searched">
                        দুঃখিত আর্টিকেল নাই
                    </div>

                </div>
                <div class="last_searched">
                    <div class="token_test">
                        <div class="float_left">
                            মেমো নং &nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                        <div class="float_left">
                            <input class="input-field" size="20" type="text" id="token">
                        </div>
                        <input type="submit" value="খোজ করুন " onclick="search_for_token();" class="submit_button">
                    </div>
                    <div class="js_status">

                        <div class="status">

                            <div class="cash_memo">

                                <div class="left_item">

                                </div>
                                <div class="right_item">
                                    <div class="item_date">

                                    </div>
                                    <div class="item_taka">

                                    </div>
                                    <div class="item_signature">

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>



                </div>

            </div>
        </div>
        <div  class="single-tab cost_div">

            <div  class="hidden1 cost_div">

                <div class="data-input-holder " >
                    <div class="cost_lists print">

                   <p> Total Cost</p>
                        <div class="newspaper">
                            
                            <?=$cost_list;?>
                        </div>
                    </div>
                    <div class="form-right non-print">
                        <form  method="post" action="">
                            <fieldset>
                                <div class="due_money_cost_fields">

                                    <div style=" background-color: white;" class="input-field-block">
                                        <div  style="width: 135px;" class="input-label-name">
                                            মোট খরচ - <span class="total_cost"><?=$total_cost_taka;?></span>
                                        </div>

                                        <div class="input-field-right">

                                        </div>
                                        <div class="clear"></div>
                                    </div>


                                    <div class="input-field-block">
                                        <div class="input-label-name">
                                            খরচের খাত
                                        </div>

                                        <div class="input-field-right ">
                                            <select onchange="check_lend(this);" class="sexy_select" id="cost_items_all" name="cost_items_all">
                                                <?=$cost_items_all;?>
                                            </select>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div  style="display: none;" class="input-field-block lend_div">
                                        <div class="input-label-name">
                                            কর্জ কারী
                                        </div>

                                        <div class="input-field-right lender_names">
                                            <select name="lender_name" class="sexy_select" id="cost_lender_name">
                                                <?=$lender_list;?>
                                            </select>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="input-field-block">
                                    <div class="input-label-name">
                                        টাকা
                                    </div>

                                    <div class="input-field-right">
                                        <input type="text" class="input-field" name="cost_amount" id="cost_amount" value="">
                                    </div>
                                    <div class="clear"></div>
                                </div>



                                <div class="input-field-block"></div>

                                <input class="common_save submit_button" onclick="cost_add(event,this,'#cost_amount','.cost_last_costed');"  type="submit" value=" যোগ  করুন "/>
                            </fieldset>
                        </form>

                        <div class="total cost_last_costed">
                            যোগের পূর্বে সঠিক তথ্য দিন
                        </div>
                        <div class="last_costed"></div>
                    </div>



                </div>


            </div>
        </div>


        <div  class="single-tab ferot_div">
            <div  class="hidden1 back_div">
                <div   class="due_total_div print">
                    মোট ফেরত- <span class="total_back"><?=$total_back_taka;?></span>.00/-
                    <div style="display: inline-block;" class="back_items">

                        <?=$back_list;?>

                    </div>

                </div>
                <div class="tab_content_right data-input-holder non-print" >

                        <?php

                        if(isset($_SESSION['user_type']) && $_SESSION['user_type']==1){ ?>
                                            <form  method="post" action="" >
                                                <fieldset>
                                                    <div class="due_money_back_fields">



                                                        <div class="input-field-block">
                                                            <div class="input-label-name">
                                                                আর্টিকেল
                                                            </div>

                                                            <div class="input-field-right">

                                                                <select class="sexy_select js_articles" id="back_article" name="back_article"  size="1">

                                                                    <?=$all_articles;?>

                                                                </select>
                                                            </div>
                                                            <div class="clear"></div>
                                                        </div>
                                                    </div>
                                                    <div  style="display: none;" class="other_money_back">

                                                        <div class="input-field-block"></div>
                                                    </div>


                                                    <div class="input-field-block">
                                                        <div class="input-label-name">
                                                            টাকা
                                                        </div>

                                                        <div class="input-field-right">
                                                            <input type="text" class="input-field" name="back_amount" id="back_amount" value="">
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>

                                                    <input class="common_save submit_button" onclick="Insert_back_amount(event,this,'#back_amount','.back_last_backed');"  type="submit" value="যোগ করুন "/>
                                                </fieldset>
                                            </form>
                                            <div class="total back_last_backed">
                                                যোগের পূর্বে সঠিক তথ্য দিন
                                            </div>
                                            <div class="last_backed"></div>

                        <?php  } ?>

                </div>


            </div>
        </div>
        <div  class="single-tab final_result_div print">
            <div  class="tab_content">

                <div class="data-input-holder " >

                    <form  method="post" action="">
                        <fieldset>




                            <div class="input-field-block">
                                <div class="input-label-name">
                                    বাটা বিক্রী
                                </div>

                                <div class="input-field-right">
                                    <span id="final_bata">0</span>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="input-field-block">
                                <div class="input-label-name">
                                    এপেক্স বিক্রী
                                </div>

                                <div class="input-field-right">
                                    <span id="final_apex">0</span>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="input-field-block">
                                <div class="input-label-name">
                                    পেগাসাস  বিক্রী
                                </div>

                                <div class="input-field-right">
                                    <span id="final_pega">0</span>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="input-field-block">
                                <div class="input-label-name">
                                    LOTTO  বিক্রী
                                </div>

                                <div class="input-field-right">
                                    <span id="final_lotto">0</span>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="input-field-block">
                                <div class="input-label-name">
                                    ঢাকা সম্রাট বিক্রী
                                </div>

                                <div class="input-field-right">
                                    <span id="final_dsr">0</span>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="input-field-block">
                                <div class="input-label-name">
                                ঈগল  সম্রাট বিক্রী
                                </div>

                                <div class="input-field-right">
                                    <span id="final_esr">0</span>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="input-field-block">
                                <div class="input-label-name">
                                    INDIAN বিক্রী
                                </div>

                                <div class="input-field-right">
                                    <span id="final_indian">0</span>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="input-field-block">
                                <div class="input-label-name">
                                    অন্যান্য বিক্রী
                                </div>

                                <div class="input-field-right">
                                    <span id="final_vrc">0</span>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="separation"></div>

                            <div class="input-field-block">
                                <div class="input-label-name">
                                    মোট  বিক্রী
                                </div>

                                <div class="input-field-right">
                                    <span id="final_sell">0</span>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="input-field-block">
                                <div class="input-label-name">
                                    ফেরত
                                </div>

                                <div class="input-field-right">
                                    - <span id="final_back">0</span>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="input-field-block">
                                <div class="input-label-name">
                                    বাকী
                                </div>

                                <div class="input-field-right">
                                    - <span id="final_due">0</span>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="separation"></div>
                            <div class="input-field-block">
                                <div class="input-label-name">
                                    &nbsp;
                                </div>

                                <div class="input-field-right">
                                    <span id="final_operation1">0</span>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="input-field-block">
                                <div class="input-label-name">
                                    জমা
                                </div>

                                <div class="input-field-right">
                                    <span id="final_add">0</span>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="input-field-block">
                                <div class="input-label-name">
                                    ক্যাশ
                                </div>

                                <div class="input-field-right">
                                    <span id="final_cash">0</span>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="separation"></div>


                            <div class="input-field-block">
                                <div class="input-label-name">
                                    মোট টাকা
                                </div>

                                <div class="input-field-right">
                                    <span id="final_operation2">0</span>
                                </div>
                                <div class="clear"></div>
                            </div>

                            <div class="input-field-block">
                                <div class="input-label-name">
                                    মোট খরচ
                                </div>

                                <div class="input-field-right">
                                    - <span id="final_cost">0</span>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="separation"></div>
                            <div class="input-field-block final_result">
                                <div class="input-label-name">
                                    সর্বশেষ
                                </div>

                                <div class="input-field-right">
                                    <span id="final_result">0</span>
                                </div>
                                <div class="clear"></div>
                            </div>





                        </fieldset>
                    </form>

                </div>


            </div>
        </div>


    </div>
</div>
</div>
<!--Start index-body-container -->
<div class=" container1 index-container-right non-print">
    <div class="right-nav">
        <ul>
            <li><a onclick="showDialog();" href="javascript:void(0);">মনে করো </a></li>
            <li><a onclick="showCuti();" href="javascript:void(0);">ছুটি নিল  </a></li>

            <?php $this->renderPartial('../options/menu_links')?>

        </ul>
        <div class="clear"></div>
    </div>
</div>



<!--<div class="main-container1 hidden">






<div  class="hidden1 add_div">
    <div   class="add_total_div">
        মোট জমা - <span class="total_add"><?/*=$total_add_today;*/?></span>.00/-
        <div class="add_items">

            <?/*=$add_list;*/?>

        </div>

    </div>
    <div class="data-input-holder " style="width:54%; height:390px; color:#ffff56;padding-left: 400px; background-color: #888cde;">
        <div class="add-item"> <div class="other_add_info">
                <button onclick="show_add_money_info('.due_money_add_fields','.other_money_add');">অন্যান্য জমা </button></div>
            <div class="due_money_info"><button onclick="show_add_money_info('.other_money_add','.due_money_add_fields');"> বাকী টাকা পাওনা  তথ্য
                </button>
            </div>
        </div>
        <form  method="post" action="">
            <fieldset>
                <div class="due_money_add_fields">

                    <div class="input-field-block js_due_areas">
                        <div class="input-label-name">
                            ‍এলাকা ‌‍
                        </div>

                        <div class="input-field-right">
                            <select   class="sexy_select" onchange="get_due_occupation_name(this);" id="add_area" name="add_area"  size="1">

                                <?/*=$all_areas_due_name;*/?>

                            </select>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="input-field-block due_occupation_from_area">

                    </div>
                    <div class="input-field-block due_customer_names">

                    </div>

                </div>


                <div class="input-field-block">
                    <div class="input-label-name">
                        টাকা
                    </div>

                    <div class="input-field-right">
                         <input type="text" class="input-field" name="add_amount" id="add_amount" value="">

                    </div>
                    <div style="padding-left: 5px;" class="input-field-right">
                        <a style="display: none;" id="c_transaction" target="_blank" href="">লেনদেন </a>
                    </div>
                    <div class="clear"></div>
                </div>

                <input class="common_save submit_button" onclick="Insert_add_amount(event,this,'#add_amount','.add_last_added');"  type="submit" value="যোগ করুন "/>
            </fieldset>
        </form>
        <div class="total add_last_added">
            যোগের পূর্বে সঠিক তথ্য দিন
        </div>
        <div class="last_added"></div>
    </div>


</div>






<div class="clear"></div>

</div>-->
<div>

</div>
<div class="loading">
    <div class="loading_text">
        অপেক্ষা  করুন ....
    </div>
</div>

<!--End index-body-container -->
</section>


<!--Start footer-->
<footer>
    <div id="dialog-modal" title="Basic modal dialog" style="display: none;">

        <input id="note_text"  size="50" type="text" name="note_text" placeholder="যা মনে রাখতে চান লিখুন " value="">
        <input type="date" size="10" placeholder="তারিখ" id="note_date" readonly="true" value="<?=$today;?>">
        <input class="button" onclick="add_remember_event('#note_text','#note_date');" type="button" value="যোগ করো ">
    </div>

    <!-- <div style="color: red;text-align: center;font-weight: bolder;" class="MSG"> <?/*=$msg;*/?></div>-->
    <div id="js_cuti_div" class="search_admin_all js_cuti_div"  style="display:none; ">
        <form id="cuti_form">


            <div class="single-search " >




                <span  class="input_label">নাম  </span>
                <!--<input required="true" AUTOFOCUS="TRUE" class="text_input  for_article" type="text" name="stock_article">-->
                <select style="min-width: 220px; float: right;" id="common_article2" name="name"  size="1">

                    <?=$dokan_stuff;?>

                </select>


            </div>
            <div class="single-search" >

                <span  class="input_label">ছুটির পরিমান  </span>

                <input class="text_input  for_article"   type="text"  value="1" name="cuti">

                দিন


            </div>

            <div class="single-search" >


                <input type="submit"  onclick="add_leave_event(this,event);" name="kormocari_info" class="button" value="যোগ করো">

            </div>

        </form>

    </div>


    <div class="main-footer hidden1">
        <div class="inner-wrapper">
            <div class="copyright">
                &copy; copyright by ModernShoeStore.com
            </div>

        </div>
    </div>

</footer>
<!--End footer-->


<style>

    input#common_price {
        width: 205px;
    }

    .chosen-container-single .chosen-default {
        color: #c60000;
        height: 32px;
        padding: 3px;
    }

</style>