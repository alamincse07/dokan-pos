<?php
require_once '../db_connect.php';

require_once 'menu_links.php';

$result_div='';
$which_result_div='';
$ar_q= "SELECT article FROM articles group by  article ";
$res_ar_q= $db->query($ar_q);
$res_all = $res_ar_q->fetch_all(MYSQLI_ASSOC);
$all_articles='';
//die(print_r($sells_mana));
foreach($res_all as $k=>$val){
//print $val['member_name'];
    $all_articles.='<option value="'.$val['article'].'">'.$val['article'].'</option>';
}

if(isset($_POST['all_stock_info'])){

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
if(isset($_POST['stock_article'])){

    $which_result_div=' Stock Information of '.$_POST['stock_article'];
    $q= "SELECT SUM(total_pair) as pair , SUM(total_taka) as taka FROM `articles` where article like '".addslashes($_POST['stock_article'])."'";
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

if(isset($_POST['category_stock'])){

    $which_result_div=' Stock Information of '.$_POST['category_stock'];
    $q= "SELECT SUM(total_pair) as pair , SUM(total_taka) as taka FROM `articles` where  category like '".addslashes($_POST['category_stock'])."'; ";
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
if(isset($_POST['profit_single_date'])){

    $which_result_div=' Daily Information of '.$_POST['profit_single_date'];
    $q= "SELECT COUNT(id) as pair, SUM(price) as taka, SUM(profit)as profit  FROM `daily_sell_information` WHERE date(date) like '".addslashes($_POST['profit_single_date'])."' ";
    $res= $db->query($q);
    $data = $res->fetch_assoc();
    //$all_sells_man_name='';
    $result_div='
                    <div class="single_result">

                        Total Pair : '.$data['pair'].'
                    </div>
                    <div class="single_result">

                        Total Taka : '.$data['taka'].'
                    </div>
                    <div class="single_result">

                    Total Profit : '.$data['profit'].'
                    </div>';

}
if(isset($_POST['profit_start_day'],$_POST['profit_start_day'])){

    $which_result_div=' Date Information of '.$_POST['profit_start_day'].' to '.$_POST['profit_end_day'];
    $q= "SELECT COUNT(id) as pair, SUM(price) as taka, SUM(profit)as profit  FROM `daily_sell_information` WHERE date(date) between '".addslashes($_POST['profit_start_day'])."'  AND '".addslashes($_POST['profit_end_day'])."'  ";
    $res= $db->query($q);
    $data = $res->fetch_assoc();
    //$all_sells_man_name='';
    $result_div='
                    <div class="single_result">

                        Total Pair : '.$data['pair'].'
                    </div>
                    <div class="single_result">

                        Total Taka : '.$data['taka'].'
                    </div>
                    <div class="single_result">

                    Total Profit : '.$data['profit'].'
                    </div>';

}
if(isset($_POST['profit_with_category'],$_POST['profit_with_category_start_day'],$_POST['profit_with_category_end_day'])){

    $which_result_div=' Profit  of '.$_POST['profit_with_category'].' from '.$_POST['profit_with_category_start_day'].' to '.$_POST['profit_with_category_end_day'];
    $q= "SELECT COUNT(id) as pair, SUM(price) as taka, SUM(profit)as profit  FROM `daily_sell_information` WHERE category like '".addslashes($_POST['profit_with_category'])."' AND date(date) between '".addslashes($_POST['profit_with_category_start_day'])."'  AND '".addslashes($_POST['profit_with_category_end_day'])."'  ";
    $res= $db->query($q);
    $data = $res->fetch_assoc();
    //$all_sells_man_name='';
    $result_div='
                    <div class="single_result">

                        Total Pair : '.$data['pair'].'
                    </div>
                    <div class="single_result">

                        Total Taka : '.$data['taka'].'
                    </div>
                    <div class="single_result">

                    Total Profit : '.$data['profit'].'
                    </div>';

}
if(isset($_POST['profit_article'],$_POST['baring_cost_start_day'],$_POST['baring_cost_end_day'])){

    $which_result_div=' Sell info of   '.$_POST['profit_article']." from ".$_POST['baring_cost_start_day'].' to '.$_POST['baring_cost_end_day'];
    //$q= "SELECT  SUM(amount) as taka   FROM `daily_cost_items` WHERE cost_type like ' Bearing Cost' AND date(date) between '".addslashes($_POST['baring_cost_start_day'])."'  AND '".addslashes($_POST['baring_cost_end_day'])."'  ";
    $q= "SELECT COUNT(id) as pair, SUM(price) as taka, SUM(profit)as profit  FROM `daily_sell_information` WHERE article like '".addslashes($_POST['profit_article'])."' AND date(date) between '".addslashes($_POST['baring_cost_start_day'])."'  AND '".addslashes($_POST['baring_cost_end_day'])."'  ";
    $res= $db->query($q);
    $data = $res->fetch_assoc();
    $result_div='
                    <div class="single_result">

                        Total Pair : '.$data['pair'].'
                    </div>
                    <div class="single_result">

                        Total Taka : '.$data['taka'].'
                    </div>
                    <div class="single_result">

                    Total Profit : '.$data['profit'].'
                    </div>';


}




?>
<!DOCTYPE html>
<html>

<head>
    <title>Al-amin Bhai project | Single page</title>
    <!--Jquery Library-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="../js/jquery.min1.7.1.js"></script>
    <!--Jquery Library-->

    <link rel="stylesheet" href="../css/style.css"/>
    <!--    <link rel="stylesheet" type="text/css" media="screen" href="js/themes/ui-darkness/jquery-ui.custom.css"></link>-->
    <!--<link rel="stylesheet" type="text/css" media="screen" href="js/themes/excite-bike/jquery-ui.custom.css"></link>-->
    <link rel="stylesheet"  href="js/themes/dot-luv/jquery-ui.custom.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="js/jqgrid/css/ui.jqgrid.css"/>

    <script src="js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
    <script src="js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
    <script src="js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
<script>

    $(function() {
        $(".date_picker").datepicker({ dateFormat: "yy-mm-dd" });
      /*  $('.date_picker').click(function(){
            $(".date_picker").datepicker({ dateFormat: "yy-mm-dd" });
        });*/

    });
</script>
<style>
    .ui-datepicker {
        display: none;
        padding: 0.2em 0.2em 0;
        width: 12em;
    }
</style>
</head>

<body>

<!--Start header-->
<header>
    <div class="inner-wrapper">
        <div class="single-page-header">
           Search Information
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

                <div  class="search_admin_all" >
                    <div class="single-search2" >


                        <form method="post" action="">
                            Total stock info
                            <input type="hidden" name="all_stock_info">
                            <input type="submit" name="all_stock" class="button" value="Search">
                        </form>
                    </div>
                    <div class="single-search2" >


                        <form method="post" action="">
                            Stock Information of
                            <span  class="input_label"> Article </span>



                            <select  id="stock_article" name="stock_article"  size="1">

                                <?=$all_articles;?>

                            </select>
                            <input type="submit" name="all_stock" class="button" value="Search">
                        </form>
                    </div>
                    <div class="single-search2" >


                        <form method="post" action="">
                            Stock Information of
                            <span  class="input_label"> Category</span>
                            <!--<input class="text_input" type="text" name="stock">-->
                            <select  name="category_stock">
                                <option value="BATA">BATA</option>
                                <option value="PEGA">PEGA</option>
                                <option value="APEX">APEX</option>
                                <option value="VRC">VRC</option>
                                <option value="JSR">JSR</option>
                                <option value="DSR">DSR</option>

                            </select>
                            <input type="submit" name="all_stock" class="button" value="Search">
                        </form>
                    </div>
                    <div class="single-search2" >
                        <form method="post" action="">
                            Sale & Profit Information of
                            <span  class="input_label"> Date</span>

                            <input class="text_input date_picker"  type="text" value="<?=$today;?>" name="profit_single_date">

                            <input type="submit" name="all_stock" class="button" value="Search">
                        </form>

                    </div>
                    <div class="single-search2" >

                        <form method="post" action="">
                            Sale & Profit  of
                            <span  class="input_label"> Start Date</span>

                            <input class="text_input date_picker"  value="<?=$today;?>" type="text" name="profit_start_day">

                            <span  class="input_label"> End Date</span>

                            <input class="text_input date_picker" type="text" value="<?=$today;?>" name="profit_end_day">

                            <input type="submit" name="all_stock"  class="button" value="Search">
                        </form>
                    </div>
                    <div class="single-search2" >

                        <form method="post" action="">
                           Profit of
                            <select style="width: 75px;" name="profit_with_category">
                                <option value="BATA">BATA</option>
                                <option value="PEGA">PEGA</option>
                                <option value="APEX">APEX</option>
                                <option value="VRC">VRC</option>
                                <option value="JSR">JSR</option>
                                <option value="DSR">DSR</option>

                            </select>

                            <span  class="input_label"> Start Date</span>

                            <input class="text_input date_picker" type="text" value="<?=$today;?>" name="profit_with_category_start_day">

                            <span  class="input_label"> End Date</span>

                            <input class="text_input date_picker" type="text" value="<?=$today;?>"  name="profit_with_category_end_day">

                            <input type="submit" name="all_stock" class="button" value="Search">
                        </form>
                    </div>
                    <div class="single-search2" >

                        <form method="post" action="">
                            Sell of   Article

                            

                            <select  id="profit_article" name="profit_article"  size="1">

                                <?=$all_articles;?>

                            </select>

                            <span  class="input_label">From</span>

                            <input class="text_input date_picker" type="text" value="<?=$today;?>" name="baring_cost_start_day">

                            <span  class="input_label ">To</span>

                            <input class="text_input date_picker" type="text" value="<?=$today;?>"  name="baring_cost_end_day">

                            <input type="submit" name="all_stock" class="button" value="Search">
                        </form>
                    </div>



                </div>
                <div class="search_result" >

                    <div class="result_text">
                        Result
                    </div>
                    <div class="which_result">
                        <?=$which_result_div;?>
                    </div>

                  <?=$result_div;?>

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