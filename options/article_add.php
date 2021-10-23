<?php
require_once '../db_connect.php';
require_once 'menu_links.php';

$q='';
$which_result_div='';
$msg='';
mb_internal_encoding('utf-8');
$db->query('SET CHARACTER SET utf8');
$db->query('SET SESSION collation_connection =utf8_general_ci');
if(isset($_REQUEST['cat'])){
    $where=" where category like '".$_REQUEST['cat']."'";
    $selected=strtoupper($_REQUEST['cat']);
}else{
    $where=" ";
    $selected='';

}
$ar_q= "SELECT article FROM articles $where group by  article ";
$res_ar_q= $db->query($ar_q);
$res_all = $res_ar_q->fetch_all(MYSQLI_ASSOC);
$all_articles='';
//die(print_r($sells_mana));
foreach($res_all as $k=>$val){
//print $val['member_name'];
    $all_articles.='<option value="'.$val['article'].'">'.$val['article'].'</option>';
}
if(isset($_POST['stock_article__sexyCombo'])){
   // die(print_r($_POST));//
    if(isset($_POST['stock_article__sexyCombo']) && $_POST['stock_article__sexyCombo']=='' ){
        $msg='Please Give Article';

    }
    elseif(isset($_POST['article_pair']) && $_POST['article_pair']=='' ){
        $msg='মোট জোড়া দিন';

    }
   elseif(isset($_POST['article_total_taka']) && $_POST['article_total_taka']=='' && strtoupper($_REQUEST['category_stock'])!='DSR'){
        $msg='মোট কেনাদাম দিন';

    }
    elseif(isset($_POST['article_body_rate']) && $_POST['article_body_rate']=='' && strtoupper($_REQUEST['category_stock'])=='DSR'){
        $msg='বডিরেট দিন';
    }else{
        $msg='ok';
    }


    if($msg=='ok'){
        //insert


        $article=  $db->real_escape_string(trim(strtoupper($_REQUEST['stock_article__sexyCombo'])));
        $category =  $db->real_escape_string(trim(strtoupper($_REQUEST['category_stock'])));
        $pair =  $db->real_escape_string(trim(strtoupper($_REQUEST['article_pair'])));
        $orginal_article =  $db->real_escape_string(trim(strtoupper($_REQUEST['orginal_article'])));


        if(strtoupper($category=='JSR')){
            $percentage=0.18;
              $body_rate =  $db->real_escape_string(trim(strtoupper($_REQUEST['article_body_rate'])));


            $actual_rate = $body_rate-(intval(ceil($body_rate*$percentage)));

            $total_taka = $actual_rate*$pair;


        }
        elseif(strtoupper($category=='DSR')){
            $percentage=0.28;

            $body_rate =  $db->real_escape_string(trim(strtoupper($_REQUEST['article_body_rate'])));


            $actual_rate = $body_rate-(intval(ceil($body_rate*$percentage)));

            $total_taka = $actual_rate*$pair;

            IF(isset($_POST['article_body_rate']) && $_POST['article_body_rate']==''){
                $msg='Please Give body rate';
            }
        }else{
            $total_taka =  $db->real_escape_string(trim(strtoupper($_REQUEST['article_total_taka'])));
            $actual_rate =  $db->real_escape_string(trim(strtoupper($_REQUEST['article_actual_rate'])));
            $body_rate =  $db->real_escape_string(trim(strtoupper($_REQUEST['article_body_rate'])));

            if($actual_rate!=''&& $actual_rate*1 > 0){

            }else{
                $actual_rate= intval(ceil($total_taka/$pair));
            }
        }

          //$body_rate =  $db->real_escape_string(trim(strtoupper($_REQUEST['article_body_rate'])));


    if(isset($actual_rate) && $actual_rate!='' && $actual_rate>0){
        $upacp=" ,increment=$actual_rate-actual_price, actual_price= IF(actual_price<$actual_rate,$actual_rate,actual_price)";
    }else{
        $upacp='';
    }
        $sql=" Insert into articles set article='$article', category='$category', total_pair=$pair, total_taka=$total_taka,actual_price='$actual_rate',body_rate='$body_rate',added_date=NOW(),last_added_pair=$pair,last_added_taka=$total_taka, orginal_article='$orginal_article' on duplicate key update  total_pair=(total_pair+$pair), total_taka=(total_taka+$total_taka),added_date=NOW(),last_added_pair=$pair,last_added_taka=$total_taka".$upacp;
        $sql2=" Insert into last_added_items set article='$article', category='$category', total_pair=$pair, total_taka=$total_taka,actual_price='$actual_rate',body_rate='$body_rate',added_date=NOW(),last_added_pair=$pair,last_added_taka=$total_taka, orginal_article='$orginal_article' on duplicate key update  total_pair=(total_pair+$pair), total_taka=(total_taka+$total_taka),added_date=NOW(),last_added_pair=$pair,last_added_taka=$total_taka";

       // DIE($sql);
       $res= $db->query($sql2);
       $res= $db->query($sql);
        if($res){
            header("Location:http://localhost/dokan/options/last_added.php?article=".$article."&date=".$today);
        }else{
            die("Error happens".$sql);
        }


    }else{
        // show message
    }


    $which_result_div='Total Stock Information';
    $q= "SELECT SUM(total_pair) as pair , SUM(total_taka) as taka FROM `articles`; ";
    $res= $db->query($q);
    $data = $res->fetch_assoc();
    //$all_sells_man_name='';
    $result_div='
                    <div class="single_result">

                        Total Pair : '.$data['pair'].'
                    </div>
                    <div class="single_result">

                        Total Taka : '.$data['taka'].'
                    </div>';

}



?>
<!DOCTYPE html>
<html>

<head>
    <title>Al-amin Bhai project | Single page</title>
    <!--Jquery Library-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="../js/jquery.min1.7.1.js"></script>

    <!--Jquery Library-->

    <link rel="stylesheet" href="../css/style.css"/>
    <link href="../css/sexy.css" rel="stylesheet" type="text/css" />
    <link href="../css/jquery-ui-1.9.0.custom.css" rel="stylesheet" type="text/css" />
    <link href="../css/sexy-combo.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../js/jquery.sexy-combo.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-1.9.0.custom.js"></script>

    <style>
        div.sexy input {
            background: url("../css/text-bg.gif") repeat-x scroll 0 0 #FFFFFF;
            border: 1px solid #B5B8C8;
            float: left;
            font: bold 14px/16px tahoma,arial,helvetica,sans-serif;
            height: 27px;
            left: 150px;
            margin: 0;
            overflow: hidden;
            padding: 1px 2px;
            top: -35px;
            vertical-align: middle;
            width: 200px;
        }



        div.sexy div.list-wrapper {
            background-color: #FFFFFF;
            border: 1px solid #D9D9D9;
            bottom: auto;
            left: 150px;
            margin: 0;
            padding: 0;
            top: -5px;
            width: 220px;
        }
    </style>
</head>

<body>
<script>

    $(document).ready(function(){

        $('#cat').val('<?=$selected;?>');
        $("select").sexyCombo({
            autoFill: true
            //triggerSelected: true            //skin: "custom"
        });
    });


</script>

<!--Start header-->
<header>
    <div class="inner-wrapper">
        <div style="font-size: 15px; height: auto;line-height: 23px;" class="single-page-header black">
            VRC -- শুরু হবে 0 তারপর +
            <span  >

                <span style="padding-left: 20px"> লেদার / চামড়া / সিলিপার --1 </span>
                <span style="padding-left: 20px"> প্লাস্টিক/ বার্মিচ --2 </span>
                <span style="padding-left: 20px"> কেডস / কাপুড়ী  --3 </span>
                <span style="padding-left: 20px"> অন্যান্য-4 </span> +

            </span>

             <span  >
                    <br/>
                <span style="padding-left: 20px">লেডিস --2 </span>
                <span style="padding-left: 20px"> জেন্ট --4</span>
                <span style="padding-left: 20px"> বাচ্চা  --0 </span> +


            </span>

              <span  >
                    <br/>
                <span style="padding-left: 20px">এবং  2 অংকের সংখ্যা </span>
                  <br/>
                <span style="padding-left: 20px"> নতুন আর্টিকেল আছে কিনা চেক করো</span>



            </span>

        </div>

    </div>
</header>
<!--End header-->


<section>
    <!--Start index-body-container -->
    <div class="inner-wrapper">
        <div class="main-container single-page-container">
            <div class="single-page-left">
                <ul>

                    <?=$menus;?>

                </ul>
                <div class="clear"></div>
            </div>
            <div class="single-page-content">

               <!-- <div style="color: red;text-align: center;font-weight: bolder;" class="MSG"> <?/*=$msg;*/?></div>-->
                <div  class="search_admin_all article_add"  style="width: 250px;border: 0; margin-left: 200px;">
                <form method="post" action="">


                    <div class="single-search " >


                        

                            <span  class="input_label">আর্টিকেল  </span>
                            <!--<input required="true" AUTOFOCUS="TRUE" class="text_input  for_article" type="text" name="stock_article">-->
                            <select style="min-width: 220px; float: right;" id="common_article" name="stock_article"  size="1">

                                <?=$all_articles;?>

                            </select>

                            
                    </div>
                    <div class="single-search" >





                        <span  class="input_label"> বডিরেট</span>

                        <input class="text_input  for_article"   type="text"   name="article_body_rate">


                    </div>
                    <div class="single-search" >


                        

                            <span  class="input_label"> ক্যাটাগরি</span>
                            <!--<input class="text_input  for_article" type="text" name="stock">-->
                            <select  id="cat" style="float: right;" name="category_stock">

                                <option value="DSR">DSR</option>

                                <option value="VRC">VRC</option>

                                <option value="JSR">JSR</option>

                                <option value="BATA">BATA</option>
                                <option value="PEGA">PEGA</option>
                                <option value="APEX">APEX</option>




                            </select>
                            
                    </div>
                    <div class="single-search" >
                        

                            <span  class="input_label"> জোড়া</span>

                            <input required="true"  class="text_input  for_article"   VALUE="1" type="text"   name="article_pair">

                            

                    </div>


                    <!--<div class="single-search" >

                        


                            <span  class="input_label"> কেনাদাম</span>




                            
                    </div>-->
                    <div class="single-search" >



                        <span  class="input_label"> মোট কেনাদাম</span>
                        <input class="text_input  for_article" type="hidden"   name="article_actual_rate">

                        <input class="text_input  for_article"  type="text" name="article_total_taka">

                    </div>

                    <div class="single-search" >





                        <span  class="input_label">চালানে লেখা  </span>

                        <input class="text_input  for_article" type="text"   name="orginal_article">


                    </div>

                    <div class="single-search" >

                        <span style="color: red;text-align: center;font-weight: bolder;" class="MSG"> <?=$msg;?></span>

                            <input type="submit" name="all_stock" class="button" value="Add Article">

                    </div>

                </form>

                </div>







            </div>
            <div class="clear"></div>
        </div>
    </div>
    <!--End index-body-container -->
</section>


<!--Start footer-->
<footer>
    <div class="main-footer">
        <div class="inner-wrapper">
            <div class="copyright">
                &copy; copyright by al-amin bhai.
            </div>
        </div>
    </div>
</footer>
<!--Endt footer-->

</body>
</html>>