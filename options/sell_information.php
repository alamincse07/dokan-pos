<?php
session_start();

date_default_timezone_set("Asia/Dhaka");
$today = date('Y-m-d');

require_once 'menu_links.php';

/**
 * PHP Grid Component
 *
 * @author Abu Ghufran <gridphp@gmail.com> - http://www.phpgrid.org
 * @version 1.4.6
 * @license: see license.txt included in package
 */

// set up DB
$conn = mysql_connect("localhost", "root", "");
mysql_select_db("dokan");

// set your db encoding -- for ascent chars (if required)
mysql_query("SET NAMES 'utf8'");

// include and create object
include("inc/jqgrid_dist.php");
$g = new jqgrid();

// set few params
$grid["caption"] = "Sell Information";

// $grid["url"] = ""; // your paramterized URL -- defaults to REQUEST_URI
$grid["rowNum"] = 100; // by default 20
$grid["sortname"] = 'id'; // by default sort grid by this field
$grid["sortorder"] = "desc"; // ASC or DESC

//$grid["multiselect"] = TRUE; // allow you to multi-select through checkboxes

$g->set_options($grid);

// set database table for CRUD operations
$g->table = "daily_sell_information";

// subqueries are also supported now (v1.2)
// $g->select_command = "select * from (select * from invheader) as o";

// render grid

if(isset($_SESSION['user_type']) && $_SESSION['user_type']!=1){

    $g->set_actions(array(
            "add"=>false, // allow/disallow add
            "edit"=>false, // allow/disallow edit
            "delete"=>false, // allow/disallow delete
            "rowactions"=>false, // show/hide row wise edit/del/save option
            "export"=>true, // show/hide export to excel option
            "autofilter" => true, // show/hide autofilter for search
            "search" => "simple" // show single/multi field search condition (e.g. simple or advance)
        )
    );
}else{



    $g->set_actions(array(
            "add"=>true, // allow/disallow add
            "edit"=>true, // allow/disallow edit
            "delete"=>true, // allow/disallow delete
            "rowactions"=>true, // show/hide row wise edit/del/save option
            "export"=>true, // show/hide export to excel option
            "autofilter" => true, // show/hide autofilter for search
            "search" => "simple" // show single/multi field search condition (e.g. simple or advance)
        )
    );
}
//this is only for other users




$out = $g->render("list1");
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
    <link rel="stylesheet" type="text/css" media="screen" href="js/themes/dot-luv/jquery-ui.custom.css"></link>
    <link rel="stylesheet" type="text/css" media="screen" href="js/jqgrid/css/ui.jqgrid.css"></link>

    <script src="js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
    <script src="js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
    <script src="js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>


</head>

<body>

<!--Start header-->
<header>
    <div class="inner-wrapper">
        <div class="single-page-header">
            Add or Edit Article here
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
                <?php echo $out?>
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