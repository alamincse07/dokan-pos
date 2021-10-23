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
$grid["caption"] = "Sample Grid";

// $grid["url"] = ""; // your paramterized URL -- defaults to REQUEST_URI
$grid["rowNum"] = 20; // by default 20
$grid["sortname"] = 'id'; // by default sort grid by this field
$grid["sortorder"] = "desc"; // ASC or DESC

//$grid["multiselect"] = TRUE; // allow you to multi-select through checkboxes

$g->set_options($grid);

// set database table for CRUD operations
$g->table = "articles";

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
$col["title"] = "Article";
$col["name"] = "article";
$col["width"] = "50";
$col["editable"] = true; // this column is editable
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required

$cols[] = $col;


$col = array();
$col["title"] = "Category";
$col["name"] = "category";
$col["width"] = "20";
$col["editable"] = true; // this column is editable
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
// can be switched to select (dropdown)
 $col["edittype"] = "select"; // render as select
 $col["editoptions"] = array("value"=>'JSR:JSR;BATA:BATA;VRC:VRC;DSR:DSR;APEX:APEX;PEGA:PEGA'); // with these values "key:value;key:value;key:value"


$cols[] = $col;

$col = array();
$col["title"] = "Total Pair";
$col["name"] = "total_pair";
$col["width"] = "20";
$col["editable"] = true; // this column is editable
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required

$cols[] = $col;




$col = array();
$col["title"] = "Actual Price";
$col["name"] = "actual_price";
$col["width"] = "20";
$col["editable"] = true; // this column is editable
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required

$cols[] = $col;



$col = array();
$col["title"] = "Total Taka";
$col["name"] = "total_taka";
$col["width"] = "20";
$col["editable"] = true; // this column is editable
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required

if(isset($_SESSION['user_type']) && $_SESSION['user_type']!=1){
    $col["hidden"] = true;
}else{
    $col["hidden"] = false;
}
$cols[] = $col;





$col = array();
$col["title"] = "Body Rate";
$col["name"] = "body_rate";
$col["width"] = "20";
$col["editable"] = true; // this column is editable
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
//$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required

$cols[] = $col;



$col = array();
$col["title"] = "Added Date";
$col["name"] = "added_date";
$col["width"] = "25";
$col["editable"] = true; // this column is editable
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
//$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required
$col["formatter"] = "date"; // format as date
// $col["formatoptions"] = array("srcformat"=>'Y-m-d',"newformat"=>'d/m/Y'); // @todo: format as date, not working with editing

$cols[] = $col;






$col = array();
$col["title"] = "Last Added Pair";
$col["name"] = "last_added_pair";
$col["width"] = "20";
$col["editable"] = true; // this column is editable
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
//$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required

$cols[] = $col;



$col = array();
$col["title"] = "Last Added Taka";
$col["name"] = "last_added_taka";
$col["width"] = "20";
$col["editable"] = true; // this column is editable
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
//$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required

$cols[] = $col;


$col = array();
$col["title"] = "Company article";
$col["name"] = "orginal_article";
$col["width"] = "20";
$col["editable"] = true; // this column is editable
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
//$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required

$cols[] = $col;


$col = array();
$col["title"] = "Increment";
$col["name"] = "increment";
$col["width"] = "20";
$col["editable"] = true; // this column is editable
$col["editoptions"] = array("size"=>20); // with default display of textbox with size 20
//$col["editrules"] = array("required"=>true, "edithidden"=>true); // and is required

$cols[] = $col;

$g->set_columns($cols);

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
    <link rel="stylesheet" type="text/css" media="screen" href="js/themes/dot-luv/jquery-ui.custom.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="js/jqgrid/css/ui.jqgrid.css"/>

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