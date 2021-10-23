<?php
include_once "../db_connect.php";
//die(print_r($_REQUEST));
$manager= @$_SESSION['user'];



require_once 'menu_links.php';





// set up DB
$conn = mysql_connect("localhost", "root", "");
mysql_select_db("dokan");

// set your db encoding -- for ascent chars (if required)
mysql_query("SET NAMES 'utf8'");
// include and create object
include("inc/jqgrid_dist.php");

$article = $db->real_escape_string($_REQUEST['article']);
$date = $db->real_escape_string($_REQUEST['date']);



$g = new jqgrid();

// $grid["url"] = ""; // your paramterized URL -- defaults to REQUEST_URI
$grid["rowNum"] = 50; // by default 20
$grid["sortname"] = 'id'; // by default sort grid by this field
$grid["sortorder"] = "desc"; // ASC or DESC
$grid["caption"] = "Customer Transaction"; // caption of grid
$grid["autowidth"] = false; // expand grid to screen width
$grid["multiselect"] = false; // allow you to multi-select through checkboxes

$g->set_options($grid);

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

// you can provide custom SQL query to display data
$g->select_command = "select * from articles  where  article='$article' ";


// this db table will be used for add,edit,delete
$g->table = "articles";

// pass the cooked columns to grid
//$g->set_columns($cols);

// generate grid output, with unique grid name as 'list1'



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
        <div  style="color: #000000;font-size: 20px;" class="single-page-header">
           Last Added or Changed article

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

                    <ul>

                        <li class="big"><a target=""  href="http://localhost/dokan/options/article_add.php?cat=DSR">DSR ADD </a></li>
                        <li class="big"><a target=""  href="http://localhost/dokan/options/article_add.php?cat=VRC">VRC ADD </a></li>
                        <li class="big"><a target=""  href="http://localhost/dokan/options/article_add.php?cat=APEX">APEX ADD </a></li>
                        <li class="big"><a target=""  href="http://localhost/dokan/options/article_add.php?cat=PEGA">PEGA ADD </a></li>
                        <li class="big"><a target=""  href="http://localhost/dokan/options/article_add.php?cat=BATA">BATA ADD </a></li>
                        <li class="big"><a target=""  href="http://localhost/dokan/options/article_add.php?cat=JSR">JSR ADD </a></li>
                        <li class="big"><a target="" href="http://localhost/dokan/">মূল হিসাব </a></li>
                        <li class="big"><a target="" href="http://localhost/dokan/options/index.php">স্টক</a></li>
                        <li class="big"><a target="" href="http://localhost/dokan/options/dokan_stock.php"> তথ্য </a></li>
                    </ul>

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