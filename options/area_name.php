<?php
session_start();

date_default_timezone_set("Asia/Dhaka");
$today = date('Y-m-d');

require_once 'menu_links.php';

// set up DB
$conn = mysql_connect("localhost", "root", "");
mysql_select_db("dokan");

// set your db encoding -- for ascent chars (if required)
mysql_query("SET NAMES 'utf8'");

// include and create object
include("inc/jqgrid_dist.php");
$g = new jqgrid();

// set few params
$grid["caption"] = "Sample Grid";

// $grid["url"] = ""; // your paramterized URL -- defaults to REQUEST_URI
$grid["rowNum"] = 20; // by default 20
$grid["sortname"] = 'id'; // by default sort grid by this field
$grid["sortorder"] = "desc"; // ASC or DESC

//$grid["multiselect"] = TRUE; // allow you to multi-select through checkboxes

$g->set_options($grid);

// set database table for CRUD operations
$g->table = "area_names";

// subqueries are also supported now (v1.2)
// $g->select_command = "select * from (select * from invheader) as o";

// render grid


$col = array();
$col["title"] = "Id"; // caption of column
$col["name"] = "id"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
$col["width"] = "10";
$col["hidden"] = true;
$cols[] = $col;

$col = array();
$col["title"] = "Area Name";
$col["name"] = "area_name";
$col["width"] = "30";
$col["editable"] = true; // this column is editable
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required

$cols[] = $col;


$g->set_columns($cols);

//this is only for other users
/*$g->set_actions(array(
        "add"=>false, // allow/disallow add
        "edit"=>false, // allow/disallow edit
        "delete"=>false, // allow/disallow delete
        "rowactions"=>false, // show/hide row wise edit/del/save option
        "export"=>true, // show/hide export to excel option
        "autofilter" => true, // show/hide autofilter for search
        "search" => "simple" // show single/multi field search condition (e.g. simple or advance)
    )
);*/




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
            Add or Edit Area Name
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