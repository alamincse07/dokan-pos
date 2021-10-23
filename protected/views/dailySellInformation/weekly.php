<?php
/**
 * Created by PhpStorm.
 * User: abdullah alamin
 * Date: 5/31/15
 * Time: 8:32 PM
 */



$menus='';
$today=date('Y-m-d');

if(isset($_REQUEST['start'],$_REQUEST['end'])){


    $end= date('Y-m-d',strtotime($today.' -'.$_REQUEST['end'].' days'));
    $condition= "date BETWEEN '".$_REQUEST['start']."' AND '".$_REQUEST['end']."' ";
    $label=$_REQUEST['start']." to  ".$_REQUEST['end'];
}else{
    $end= date('Y-m-d',strtotime($today.' -42 days'));
    $condition= " date BETWEEN '$end' AND '$today' ";
    $label=' Last month ';
}
//die($condition);
$dates=array();
$tableData=array();
$tableData2=array();
$tableData3=array();
$categories=['JSR','PEGA','APEX','DSR','BATA','VRC','INDIAN'];
//$con = new mysqli('localhost','root','','dokan');
//$con= new PDO('pgsql:host=localhost;dbname=dokan', 'postgres', 'root');
if (1){

    $pair="  select count(id) AS val, 
    CONCAT
    (
      MONTHNAME(date),
      '-',
      WEEK(date)
    ) AS week
  FROM daily_sell_information
  WHERE $condition
  GROUP BY WEEK(date)
  ORDER BY YEARWEEK(date, 2)
  ";

    //die($pair);
    $profit_sql=" select  SUM(profit) AS val, 
    CONCAT
    (
      MONTHNAME(date),
      '-',
      WEEK(date)
    ) AS week
  FROM daily_sell_information
  WHERE $condition
  GROUP BY WEEK(date)
  ORDER BY YEARWEEK(date, 2)
  ";

    $sell=" select SUM(price) AS val, 
    CONCAT
    (
      MONTHNAME(date),
      '-',
      WEEK(date)
    ) AS week
  FROM daily_sell_information
  WHERE $condition
  GROUP BY WEEK(date)
  ORDER BY YEARWEEK(date, 2)
  ";

    //$stock_pair="SELECT category,SUM(total_pair) as total FROM articles GROUP BY category";

    //$stock_taka=" SELECT category,SUM(total_taka) as total FROM articles GROUP BY category";


    $qr_res= Yii::app()->db->createCommand($sell)->query();

    $dokan_stuff='';
    $tableDataCategorySell=[];
    $tableDataCategorySelldates=[];
    while($res=$qr_res->read()){

        $tableDataCategorySell[]=intval($res['val']);
        $date=$res['week'];
        $tableDataCategorySelldates[]=$date;

    }
    //print_r($tableDataCategorySell);die;
/////////////////////////////pair ///////////////////////////////

    $qr_res= Yii::app()->db->createCommand($pair)->query();
    $tableDataCategoryPair=[];
    $tableDataCategoryPairdates=[];
    while($res=$qr_res->read()){

        $tableDataCategoryPair[]=intval($res['val']);
        $date=$res['week'];
        $tableDataCategoryPairdates[]=$date;
    }

/////////////////////////////pair ///////////////////////////////


    /////////////// profit///////////////////

    $qr_res= Yii::app()->db->createCommand($profit_sql)->query();

    $tableDataCategoryProfit=[];
    $tableDataCategoryProfitdates=[];
    while($res=$qr_res->read()){

        $tableDataCategoryProfit[]=intval($res['val']);
        $date=$res['week'];
        $tableDataCategoryProfitdates[]=$date;
    }

}



$base_url= Yii::app()->request->baseUrl;
?>
<link rel="stylesheet" href="<?=$base_url?>/css/style.css"/>
<link href="<?=$base_url?>/css/sexy.css" rel="stylesheet" type="text/css" />
<link href="<?=$base_url?>/css/sexy-combo.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$base_url?>/js/jquery.sexy-combo.js"></script>
<link rel="stylesheet"  href="<?=$base_url?>/js/themes/dot-luv/jquery-ui.custom.css"/>

<!-- <script type="text/javascript" src="<?=$base_url?>/js/highcharts.js"></script> -->
<script src="https://code.highcharts.com/highcharts.js"></script>


<script type="application/javascript">

$(function () {

    $('.date_picker').datepicker({ dateFormat: 'yy-mm-dd' });
    alert('ready??');

 


Highcharts.chart('container_profit', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Monthly Average Profit'
    },

    xAxis: {
        categories: <?= json_encode($tableDataCategoryProfitdates)?>
        },
    yAxis: {
        title: {
            text: 'Total'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Total Profit ',
        data: <?= json_encode($tableDataCategoryProfit)?>
    }]
});



Highcharts.chart('container_sell', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Monthly Average Sell'
    },

    xAxis: {
        categories: <?= json_encode($tableDataCategorySelldates)?>
        },
    yAxis: {
        title: {
            text: 'Taka'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Total Sell',
        data: <?= json_encode($tableDataCategorySell)?>
    }]
});
   
Highcharts.chart('container_pair', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Monthly Average Pair sold'
    },

    xAxis: {
        categories: <?= json_encode($tableDataCategoryPairdates)?>
        },
    yAxis: {
        title: {
            text: 'Total'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Total Pair ',
        data: <?= json_encode($tableDataCategoryPair)?>
    }]
});




});
</script>



<div>

    <div class="single-search2" >

        <form method="get" action="">
            <input class="text_input date_picker"  value="<?=$today;?>" type="text" name="start">

            <span  class="input_label"> থেকে </span>

            <input class="text_input date_picker" type="text" value="<?=$today;?>" name="end">

            <span  class="input_label"> পর্যন্ত বিক্রী তথ্য </span>
            <input type="submit" name="all_stock"  class="button" value="দেখুন ">
        </form>
    </div>
</div>

<div class="graph">



    <div class="green" id="container_profit" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


    <div class="green" id="container_sell" style="min-width: 310px; height: 400px; margin: 0 auto"></div>




    <div  class="green" id="container_pair" style="min-width: 310px; height: 400px; margin: 0 auto"></div>




</div>



<style>
    .green{
        border-top:25px solid #ff5bd1;
    }
</style>





