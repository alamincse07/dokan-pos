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


    $end= date('Y-m-d',strtotime($today.' -7 days'));
    $condition= " BETWEEN '".$_REQUEST['start']."' AND '".$_REQUEST['end']."' ";
    $label=$_REQUEST['start']." to  ".$_REQUEST['end'];
}else{
    $end= date('Y-m-d',strtotime($today.' -7 days'));
    $condition= " BETWEEN '$end' AND '$today' ";
    $label=' Last 7 days ';
}
//die($condition);
$dates=array();
$tableData=array();
$tableData2=array();
$tableData3=array();
$categories=['LOTTO','PEGA','APEX','DSR','ESR','STAR','CSS','BATA','VRC','INDIAN'];
//$con = new mysqli('localhost','root','','dokan');
//$con= new PDO('pgsql:host=localhost;dbname=dokan', 'postgres', 'root');
if (1){

    $pair=" SELECT DATE(date) as sdate,


 SUM(CASE WHEN t.category = 'VRC' THEN 1 ELSE 0 END) AS VRC,
 SUM(CASE WHEN t.category = 'BATA' THEN 1 ELSE 0 END) AS BATA,
 SUM(CASE WHEN t.category = 'APEX' THEN 1 ELSE 0 END) AS APEX,
SUM(CASE WHEN t.category = 'DSR' THEN 1 ELSE 0 END) AS DSR,
SUM(CASE WHEN t.category = 'ESR' THEN 1 ELSE 0 END) AS ESR,
SUM(CASE WHEN t.category = 'CSS' THEN 1 ELSE 0 END) AS CSS,
SUM(CASE WHEN t.category = 'STAR' THEN 1 ELSE 0 END) AS STAR,
SUM(CASE WHEN t.category = 'LOTTO' THEN 1 ELSE 0 END) AS LOTTO,
SUM(CASE WHEN t.category = 'INDIAN' THEN 1 ELSE 0 END) AS INDIAN,
SUM(CASE WHEN t.category = 'PEGA' THEN 1 ELSE 0 END) AS PEGA

FROM daily_sell_information t
GROUP BY sdate
HAVING sdate $condition
limit 7";

    //die($pair);
    $profit_sql=" SELECT DATE(date) as sdate,


 SUM(CASE WHEN t.category = 'VRC' THEN t.profit ELSE 0 END) AS VRC,
 SUM(CASE WHEN t.category = 'BATA' THEN t.profit ELSE 0 END) AS BATA,
 SUM(CASE WHEN t.category = 'APEX' THEN t.profit ELSE 0 END) AS APEX,
SUM(CASE WHEN t.category = 'DSR' THEN t.profit ELSE 0 END) AS DSR,
SUM(CASE WHEN t.category = 'ESR' THEN t.profit ELSE 0 END) AS ESR,
SUM(CASE WHEN t.category = 'CSS' THEN t.profit ELSE 0 END) AS CSS,
SUM(CASE WHEN t.category = 'STAR' THEN t.profit ELSE 0 END) AS STAR,
SUM(CASE WHEN t.category = 'LOTTO' THEN t.profit ELSE 0 END) AS LOTTO,
SUM(CASE WHEN t.category = 'INDIAN' THEN t.profit ELSE 0 END) AS INDIAN,

SUM(CASE WHEN t.category = 'PEGA' THEN t.profit ELSE 0 END) AS PEGA

FROM daily_sell_information t
GROUP BY sdate
HAVING sdate $condition
limit 7";

    $sell="  SELECT DATE(date) as sdate,


 SUM(CASE WHEN t.category = 'VRC' THEN t.price ELSE 0 END) AS VRC,
 SUM(CASE WHEN t.category = 'BATA' THEN t.price ELSE 0 END) AS BATA,
 SUM(CASE WHEN t.category = 'APEX' THEN t.price ELSE 0 END) AS APEX,
SUM(CASE WHEN t.category = 'DSR' THEN t.price ELSE 0 END) AS DSR,
SUM(CASE WHEN t.category = 'ESR' THEN t.price ELSE 0 END) AS ESR,
SUM(CASE WHEN t.category = 'CSS' THEN t.price ELSE 0 END) AS CSS,
SUM(CASE WHEN t.category = 'STAR' THEN t.price ELSE 0 END) AS STAR,
SUM(CASE WHEN t.category = 'LOTTO' THEN t.price ELSE 0 END) AS LOTTO,
SUM(CASE WHEN t.category = 'INDIAN' THEN t.price ELSE 0 END) AS INDIAN,
SUM(CASE WHEN t.category = 'PEGA' THEN t.price ELSE 0 END) AS PEGA

FROM daily_sell_information t

GROUP BY sdate
HAVING sdate $condition
limit 7";

    //$stock_pair="SELECT category,SUM(total_pair) as total FROM articles GROUP BY category";

    //$stock_taka=" SELECT category,SUM(total_taka) as total FROM articles GROUP BY category";


    $qr_res= Yii::app()->db->createCommand($sell)->query();

    $dokan_stuff='';
    while($res=$qr_res->read()){
        $date=$res['sdate'];
        $dates[]=$date;
        foreach($categories as $k=>$category)

            $tableData[$category][$date]= intval($res[$category]);
    }
/////////////////////////////pair ///////////////////////////////

    $qr_res= Yii::app()->db->createCommand($pair)->query();

    $dokan_stuff='';
    while($res=$qr_res->read()){
        $date=$res['sdate'];
        $dates[]=$date;
        foreach($categories as $k=>$category)

            $tableData2[$category][$date]=intval($res[$category]);
    }

/////////////////////////////pair ///////////////////////////////


    /////////////// profit///////////////////

    $qr_res= Yii::app()->db->createCommand($profit_sql)->query();

    $dokan_stuff='';
    while($res=$qr_res->read()){
        $date=$res['sdate'];
        $dates[]=$date;
        foreach($categories as $k=>$category)

            $tableData3[$category][$date]=intval($res[$category]);
    }
    /////////////// profit///////////////////
    //print '<pre>';
//print_r($categories);
//print_r($dates);
//print_r($tableData);
//print_r($tableData2);
//print_r($tableData3);
    //die;
}



$base_url= Yii::app()->request->baseUrl;
?>
<link rel="stylesheet" href="<?=$base_url?>/css/style.css"/>
<link href="<?=$base_url?>/css/sexy.css" rel="stylesheet" type="text/css" />
<link href="<?=$base_url?>/css/sexy-combo.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$base_url?>/js/jquery.sexy-combo.js"></script>
<link rel="stylesheet"  href="<?=$base_url?>/js/themes/dot-luv/jquery-ui.custom.css"/>

<script type="text/javascript" src="<?=$base_url?>/js/highcharts.js"></script>



<script type="application/javascript">


var labels = <?= json_encode($categories)?>;

var dates=<?= json_encode($dates)?>;
var sale_db_data=<?= json_encode($tableData)?>;
var pair_db_data=<?= json_encode($tableData2)?>;
var profit_db_data=<?= json_encode($tableData3)?>;
var title ='<?=$label?>';
//   console.log(labels);
//console.log(db_data);
var sell_build_data = Array();
var pair_build_data = Array();
var profit_build_data = Array();
var D_categories = labels;

function initialize(){
    for(var i=0 ;i<labels.length;i++){

        var label_name=labels[i];

        var single_data={};
        single_data.name = label_name;
        single_data.data = getArrayData(label_name,sale_db_data[label_name]);

        sell_build_data.push(single_data);
    }
    for(var i=0 ;i<labels.length;i++){

        var label_name=labels[i];

        var single_data={};
        single_data.name = label_name;
        single_data.data = getArrayData(label_name,pair_db_data[label_name]);

        pair_build_data.push(single_data);
    }
    for(var i=0 ;i<labels.length;i++){

        var label_name=labels[i];

        var single_data={};
        single_data.name = label_name;
        single_data.data = getArrayData(label_name,profit_db_data[label_name]);

        profit_build_data.push(single_data);
    }

}
function getArrayData(label_name,labels_date_wise_data){
     //console.log(labels_date_wise_data);
    var data_arr=[];
    if(labels_date_wise_data){
        $.each(labels_date_wise_data, function(key,v) {
            //console.log(v);
            data_arr.push(v);
        });
    }


    return data_arr;
}


$(function () {

    $('.date_picker').datepicker({ dateFormat: 'yy-mm-dd' });

    initialize();
    //console.log(db_data);
    $('#container_sell').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: title +'  sale information'
        },
        xAxis: {
            categories: dates

        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total sale'
            },
            stackLabels: {
                enabled: true,

                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'red'
                }
            }
        },
        legend: {
            align: 'center',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 4,
            shadow: false
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    formatter: function() {
                        if (this.y === 0) {
                            return null;
                        }
                        return this.y;
                    },
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                }
            }
        },
        series: sell_build_data
    });
    $('#container_pair').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: title + '  pair information'
        },
        fillColor:'red',
        xAxis: {
            categories: dates

        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total pair'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'red'
                }
            }
        },
        legend: {
            align: 'center',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 4,
            shadow: false
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    formatter: function() {
                        if (this.y === 0) {
                            return null;
                        }
                        return this.y;
                    },
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                }
            }
        },
        series: pair_build_data
    });
    $('#container_profit').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: title + '  profit information'
        },
        xAxis: {
            categories: dates

        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total profit'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'red'
                }
            }
        },
        legend: {
            align: 'center',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 4,
            shadow: false
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    formatter: function() {
                        if (this.y === 0) {
                            return null;
                        }
                        return this.y;
                    },
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    style: {
                        textShadow: '0 0 3px black'
                    }
                }
            }
        },
        series: profit_build_data
    });
});
</script>



<div>

    <div class="single-search2" >

        <form method="post" action="">
            <input class="text_input date_picker"  value="<?=$today;?>" type="text" name="start">

            <span  class="input_label"> থেকে </span>

            <input class="text_input date_picker" type="text" value="<?=$today;?>" name="end">

            <span  class="input_label"> পর্যন্ত বিক্রী তথ্য </span>
            <input type="submit" name="all_stock"  class="button" value="দেখুন ">
        </form>
    </div>
</div>

<div class="graph">


    <div class="green" id="container_sell" style="min-width: 310px; height: 400px; margin: 0 auto"></div>




    <div  class="green" id="container_pair" style="min-width: 310px; height: 400px; margin: 0 auto"></div>




    <div class="green" id="container_profit" style="min-width: 310px; height: 400px; margin: 0 auto"></div>



</div>



<style>
    .green{
        border-top:25px solid #ff5bd1;
    }
</style>





