<?php

$this->pageTitle=Yii::app()->name;

$base_url= Yii::app()->request->baseUrl;
$mob=new  MobileDetect();
$is_mobile = false;
if($mob->isMobile()){
  $is_mobile = true;
}

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
$dokan_stuff='<option value="">-------</option>';
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




$vrc_q=" select * from daily_sell_information where DATE(date) ='$today'  order by category desc , id asc " ;
// die($vrc_q);
$vrc_res= Yii::app()->db->createCommand($vrc_q)->query();
//$vrc_res_all=$vrc_res->fetch_all(MYSQLI_ASSOC);

$categories = Generic::getCategoryDropdown(true);
$sells = [];
foreach($categories as $k=>$val){
  $sells[$val] = ['total_pair' =>0,'total_taka' =>0, 'list'=>[]];
}


if($vrc_res){
    while($val=$vrc_res->read()){

      
      $card = common_class::getCardDiv($val, $type='sell');

      $sells[$val['category']]['total_pair'] = $sells[$val['category']]['total_pair'] + 1;
      $sells[$val['category']]['total_taka'] = $sells[$val['category']]['total_taka'] + $val['price'];
      $sells[$val['category']]['list'][] = $card;

}
}


// sum of the $sells of total_pair key value
$total_all_sold =  array_reduce($sells, function($carry, $item) { return $carry + $item['total_pair']; }, 0); //($sells




///////////////////////// 'note_information.php';


$note_list='';
$noteCounter = '';
$note_q=" select * from remember_event where DATE(date) ='$today' " ;
//die($note_q);
$note_res_all= Yii::app()->db->createCommand($note_q)->queryAll();

if($note_res_all && count($note_res_all)>0){

  $noteCounter = count($note_res_all);
    foreach($note_res_all as $k=>$val){

        $note_list .='<a class="dropdown-item d-flex align-items-center" href="#">                 
                        <div class="font-weight-bold">
                            <div class="text-truncate1">
                            '.$val['notes'].'
                            </div>           
                        </div>
                    </a>';
    }

}


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
    $due_list .=common_class::getCardDiv($val,'due');


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
    $add_list .=common_class::getCardDiv($val,'add');
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
    $back_list .=common_class::getCardDiv($val,'back');
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
    $cost_list .=common_class::getCardDiv($val,'cost');

}

//-------------------------------for dsr-------------------------------------------


$dsr_cq=" select * from cost_items  order by  cost_name asc" ;
//die($dsr_q);
$cost_items= Yii::app()->db->createCommand($dsr_cq)->queryAll();
//$cost_items =$dsr_resc->fetch_all(MYSQLI_ASSOC);
$cost_items_all='<option value="">Select</option>';


foreach($cost_items as $k=>$val){
    $cost_items_all.='<option value="'.$val['cost_name'].'">'.($val['cost_name']).'</option>';
}


$lender_list='';
// $qc=" select * from lenders where amount > 0  order by name " ;
// //die($q);
// $resl=Yii::app()->db->createCommand($qc)->query();
// if($resl){
//     while( $row= $resl->read()){
//         $lender_list.='<option value="'.$row['name'].'">'.ucwords($row['name']).'</option>';
//     }


// }
///////////////////////////////////////////////////////////////////


?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Modern Shoe</title>

    <!-- Custom fonts for this template-->
    <link href="../css/fontawesome-free-all.min.css" rel="stylesheet" type="text/css" />

    <link href="../css/sb-admin-2.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
   
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=$base_url?>">
          <div class="sidebar-brand-icon rotate-n-1">
            <!-- <i class="fas fa-laugh-wink"></i> -->
            <img src="../images/logo.png" height="35" width="35" title="Modern Shoe" alt="MS" />
            <!-- <i class="fab fa-shopware"></i> -->
          </div>
          <div class="sidebar-brand-text mx-2">Modern Shoe</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link js_main" href="#sale">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>বিক্রিত</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Heading -->
        <div class="sidebar-heading"></div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapseTwo"
            aria-expanded="true"
            aria-controls="collapseTwo"
          >
            <i class="fas fa-fw fa-cog"></i>
            <span>দৈনন্দিন </span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item bg-info"  href="#baki">বাকী</a>
              <a class="collapse-item" onclick="set_due_list()" href="#joma">জমা </a>
              <a class="collapse-item bg-info" href="#ferot">ফেরত</a>
              <a class="collapse-item" href="#cost">খরচ </a>
              <a class="collapse-item bg-info" data-toggle="modal" data-target="#leaveModal" href="#leaveModal"
                >ছুটি নিল
              </a>
              <a class="collapse-item" data-toggle="modal" data-target="#rememberModal" href="#rememberModal"
                >মনে করো
              </a>
              <a class="collapse-item bg-info" data-toggle="modal" data-target="#noteModal" href="#noteModal">নোট </a>
            </div>
          </div>
        </li>

        <hr class="sidebar-divider" />
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapsePages"
            aria-expanded="true"
            aria-controls="collapsePages"
          >
            <i class="fas fa-list-alt"></i>
            <span>বিক্রি লিষ্ট </span>
          </a>
          <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <?php foreach( $categories as $k => $val){?>
              <a class="collapse-item" href="#<?=$val?>Sale"><?=$val?> বিক্রী</a>
              <?php } ?>
              
            </div>
          </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Heading -->
        <div class="sidebar-heading"></div>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
          <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapseUtilities"
            aria-expanded="true"
            aria-controls="collapseUtilities"
          >
            <i class="fas fa-fw fa-wrench"></i>
            <span>বিস্তারিত </span>
          </a>
          <div
            id="collapseUtilities"
            class="collapse"
            aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar"
          >
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item bg-info" target="_blank" href="<?=$base_url?>/articles/admin">স্টক</a>

              <a class="collapse-item" target="_blank" href="<?=$base_url?>/dailySellInformation/admin">বিক্রী </a>
              <a class="collapse-item bg-info" target="_blank" href="<?=$base_url?>/dailyCostItems/admin">খরচ </a>
              <a class="collapse-item" target="_blank" href="<?=$base_url?>/dailyAddAmount/admin">জমা </a>
              <a class="collapse-item bg-info" target="_blank" href="<?=$base_url?>/CustomerTransaction/admin">
                লেনদেন
              </a>

              <a class="collapse-item" target="_blank" href="<?=$base_url?>/lenders/admin">কর্জকারী </a>
              <a class="collapse-item bg-info" target="_blank" href="<?=$base_url?>/CustomerDueInformation/admin"
                >বাকী টাকা
              </a>

              <a class="collapse-item" target="_blank" href="<?=$base_url?>/CostItems/admin">খরচের খাত </a>
              <a class="collapse-item bg-info" target="_blank" href="<?=$base_url?>/CustomerOccupation/admin">পেশা </a>
              <a class="collapse-item" target="_blank" href="<?=$base_url?>/AreaNames/admin">এলাকা </a>
              <a class="collapse-item bg-light" target="_blank" href="<?=$base_url?>/lastAddedItems/admin"
                >শেষে স্টকে থোলা
              </a>
            </div>
          </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider" />

        <!-- Nav Item - Charts -->
        <li class="nav-item">
          <a class="nav-link" id="finalClose" href="#final">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>হিসাব ক্লোজ </span></a
          >
        </li>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <form onsubmit="DoSearch(event,this)" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
              <div class="input-group">
                <select class="form-control bg-light border-1 small" name="searchOption" id="searchOption">
                  <option value="stock">Stock</option>
                  <option value="memo">Memo</option>
                  <option value="type">Type</option>
                 
                </select>

                <input
                  type="text"
                  id="searchFor"
                  name="searchFor"
                  class="form-control bg-light border-1 small"
                  placeholder="Search for..."
                  aria-label="Search"
                  aria-describedby="basic-addon2"
                />
                <div class="input-group-append">
                  <button class="btn btn-primary" onclick="DoSearch(event,this)" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>

               
              </div>
            </form>

            <div class="ml-auto d-sm-inline-block">
                <?php 
                  if(isset($_REQUEST['date'])){
                    echo "<h4 class='red text-danger'>".$_REQUEST['date']."</h4>";
                  }
                  ?>
            </div>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
              <!-- Nav Item - Search Dropdown (Visible Only XS) -->
              <li class="nav-item dropdown no-arrow d-sm-none">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="searchDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div
                  class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                  aria-labelledby="searchDropdown"
                >
                  <form class="form-inline mr-auto w-100 navbar-search" onsubmit="DoSearch(event,this)">
                    <div class="input-group">
                      <select class="form-control bg-light border-1 small" name="searchOption" id="searchOptionm">
                        <option value="stock">Stock</option>
                        <option value="memo">Memo</option>
                      </select>

                      <input
                        type="text"
                        id="searchForm"
                        name="searchFor"
                        class="form-control bg-light border-1 small"
                        placeholder="Search for..."
                        aria-label="Search"
                        aria-describedby="basic-addon2"
                      />
                      <div class="input-group-append">
                        <button class="btn btn-primary" onclick="DoSearch(event,this)"  type="button">
                          <i class="fas fa-search fa-sm"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>

              <li class="nav-item dropdown no-arrow mx-1">
                <a
                  class="nav-link dropdown-toggle text-primary"
                  href="#"
                  id="correctDropdown"
                  title="ভূল সংশোধন "
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                  onclick="Correct(this)"
                >
                  <i class="fas fa-trash fa-lg"></i>
                </a>
              </li>

              <!-- Nav Item - Alerts -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="alertsDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="fas fa-bell fa-fw fa-lg"></i>
                  <!-- Counter - Alerts -->
                  <span class="badge badge-primary badge-counter total_sold_counter"><?=$total_all_sold;?></span>
                </a>
                <!-- Dropdown - Alerts -->
                <div
                  class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in print"
                  aria-labelledby="alertsDropdown" id="js_sell_count"
                >
                  <h6 class="dropdown-header font-weight-bold text-primary">মোটজোড়া - <?=$total_all_sold;?> </h6>

                  <?php foreach($sells as $category=>$val){?>
                  
                    <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle badge-primary total_sold_<?= $category?>_counter"><?=$val['total_pair'];?></div>
                    </div>
                    <div><?= $category?></div>
                  </a>
                  <?php } ?>

                </div>
              </li>

              <!-- Nav Item - Messages -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="messagesDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="fas fa-envelope fa-fw fa-lg"></i>
                  <!-- Counter - Messages -->
                  <span class="badge badge-primary badge-counter rememberCounter"><?=$noteCounter?></span>
                </a>
                <!-- Dropdown - Messages -->
                <div
                  class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                  aria-labelledby="messagesDropdown"
                  id="remember_content"
                >
                  <h6 class="dropdown-header">Remember List</h6>
                  <?=$note_list;?>
                </div>
              </li>

              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="userDropdown"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$user_name?></span>
                  <img class="img-profile rounded-circle" src="../images/undraw_profile.svg" />
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  
                <?php
                   if(isset($_SESSION['user_type']) && $_SESSION['user_type']==1){ ?>
                  <a class="dropdown-item py-2" target="_blank" href="<?=$base_url?>/articles/add">
                    <i class="fas fa-layer-group"></i> স্টকে যোগ
                  </a>

                  <a
                    class="dropdown-item bg-info py-2"
                    target="_blank"
                    href="<?=$base_url?>/dailySellInformation/dokanStock"
                    ><i class="fas fa-info-circle"></i> তথ্য
                  </a>
                  <a class="dropdown-item py-2" target="_blank" href="<?=$base_url?>/Kormocari/admin">
                    <i class="fas fa-user-circle"></i> সদস্য
                  </a>
                  <a class="dropdown-item bg-info py-2" target="_blank" href="<?=$base_url?>/MoneyBackIteams/admin">
                    <i class="fas fa-money-check"></i> ফেরত
                  </a>
                  <?php } ?>
                  <a class="dropdown-item  py-2" data-toggle="modal" data-target="#oldViewModal" href="#oldViewModal">
                    <i class="fas fa-money-check"></i> পুরানো দিনের তথ্য
                  </a>

                  <a
                    class="dropdown-item py-2 bg-info"
                    target="_blank"
                    href="<?=$base_url?>/articles/SearchByTags"
                    ><i class="fas fa-info-circle"></i> মাল গণনা 
                  </a>


                  <a class="dropdown-item py-2" href="<?=$base_url?>/site/logout"  data-target="#loadingModal1">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                  </a>
                </div>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div id="sale" class="container-fluid content-tab non-print">
            <!-- Page Heading -->
            <!-- <h1 class="h3 mb-1">বিক্রি</h1> -->

            <!-- Content Row -->
            <div class="row">
              <div class="col-xl-6 col-lg-6">
                <!-- Area Chart -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">বিক্রিত জুতা যোগ করো</h6>
                  </div>
                  <div class="card-body">
                    <div class="chart-area">
                      <!-- <form class="userd common-sell" onsubmit="Common_add(event,this,'#common_price','common');"> -->
                        <div class="form-group">
                          <div class="custom-control custom-checkbox small">
                            <input
                              type="checkbox"
                              <?php if(!$is_mobile){echo 'checked'; } ?>
                              class="custom-control-input"
                              aria-describedby="isPrint"
                              id="isPrint"
                            />

                            <label class="custom-control-label text-danger" for="isPrint">
                              রিসিপ্ট প্রিন্ট <i class="fas fa-print"></i>
                            </label>
                          </div>
                        </div>
                        <div class="new-pos">
                        <form id="dynamic-form" >
                          <div class="col-auto1 d-flex justify-content-between mb-2">
                            <button type="button" class="btn btn-success mr-4" id="add-row">+</button>
                            <button type="button" class="btn btn-warning mr-4 mx-auto" id="hold-form">Hold</button>
                            <button type="button" class="btn btn-info" id="show-hold-list">Show Hold List</button>
                          </div>
                          <div id="form-rows">
                            <div class="form-row align-items-center mb-2">
                              <div class="col">
                                <input
                                  type="text"
                                  list="articles"
                                  onblur="setRowPrice(this)"
                                  class="form-control"
                                  required
                                  name="article[]"
                                  placeholder="Article"
                                />
                              </div>
                              <div class="col">
                                <input
                                  type="number"
                                  onblur="ShowTotal(this)"
                                  class="form-control"
                                  required
                                  name="price[]"
                                  placeholder="Price"
                                />
                              </div>
                            </div>
                          </div>
        
       
                          </div>


                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-default">সেলসম্যান </span>
                            </div>
                            <select
                              name="salesman"
                              id="salesman"
                              class="form-control"
                              aria-label="Default"
                              aria-describedby="inputGroup-sizing-default"
                            >
                            <?=$dokan_stuff;?>
                            </select>
                          </div>
                          <div id="total-rows">
                            <div class="form-row align-items-center mb-2">
                              <div class="col b1g-secondary text-right">Total:</div>
                              <div class="col ">
                                <input type="number" id="totalItemPrice" class="form-control" required name="total" readonly />
                              </div>
                            </div>
                          </div>

                          <input type="submit" name="sold" class="btn btn-primary btn-user btn-block" value=" যোগ করুন" />
                          <hr />

                          <div class="alert alert-danger text-center added_item">যোগের পূর্বে সঠিক তথ্য দিন</div>
                          <div class="alert alert-success text-center last_addedc" role="alert"></div>
                      </form>
                    </div>
                    <hr />
                  </div>
                </div>
              </div>

              <!-- Donut Chart -->
              <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header">
                    <div class="p-1 font-weight-bold text-primary float-left">পূর্বের বিক্রিত জুতা</div>

                    <button type="button" class="btn btn-info float-right" onclick="ClearMemo()">Clear List</button>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body mx-4">
                    <div class="chart-pie pt-0" id="memolist">


                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        
          <!-- Sell List Details -->
          <?php  foreach($sells as $category=>$val){ ?>
                  
            <!-- Begin Page Content -->
          <div id="<?=$category?>Sale" class="container-fluid content-tab">
            

            <!-- Content Row -->
            <div class="row">
              <!-- Bar Chart -->
              <div class="card shadow mb-1 col-12">
                <div class="card-header py-3">
                  <div class="row">
                    <div class="col-8 font-weight-bold text-primary"><?=$category?> বিক্রয় তালিকা</div>
                    <div class="col-4 font-weight-bold text-primary text-uppercase mb-1" id="total_<?=$category?>_taka"><?=$val['total_taka'];?> /= </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row chart-bar2 <?=$category?>_products_sold">
                      <?= implode('',$val['list']);?>
                  </div>
                  <hr />
                </div>
              </div>
            </div>
          </div>
          <?php  }  ?>

       
          

          <div id="joma" class="container-fluid content-tab">
            <div class="row mb-1">
              <!-- Dropdown Card Example -->
              <div class="card shadow mb-0 col-12">
                <!-- Card Header - Dropdown -->

                <div class="card-header py-1">
                  <div class="row">
                    <div class="col-8 font-weight-bold text-primary">আজকের মোট জমা</div>
                    <div class="col-4 font-weight-bold text-primary text-uppercase mb-1 total_add"><?=$total_add_today;?></div>
                  </div>
                </div>

                <!-- Card Body -->
                <div class="card-body py-3">
                  <div class="row add_items">
                     <?=$add_list;?>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-6">
                <!-- Default Card Example -->
                <div class="card mb-4">
                  <div class="card-header m-0 font-weight-bold text-primary">বাকী জমা</div>
                  <div class="card-body">
                    <form
                      class="user common-sell"
                      onsubmit="Insert_add_amount3(event,this,'#add_amount','.add_last_added');"
                    >
                      <div class="input-group mb-3 js_due_areas">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-defaultarea">এলাকা ‌‍</span>
                        </div>

                        <select
                          class="form-control"
                          onchange="get_due_occupation_name(this);"
                          id="add_area"
                          name="add_area"
                          size="1"
                        >
                            <?=$all_areas_due_name;?>
                        </select>
                      </div>

                      <div class="input-group mb-3 due_occupation_from_area">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-defaultpesa">পেশা</span>
                        </div>

                        <select
                          class="form-control"
                          onchange="GetDueNames(this);"
                          id="due_occupation"
                          name="due_occupation"
                          size="1"
                        >
                          <option value="">Select</option>

                        </select>
                      </div>

                      <div class="input-group mb-3 due_customer_names">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-default">নাম </span>
                        </div>
                        <select
                          class="form-control"
                          onchange="GetDueTaka(this);"
                          id="customer_name"
                          name="customer_name"
                          size="1"
                        >
                          <option value="">Select</option>
                        </select>
                      </div>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-default">টাকা </span>
                        </div>
                        <input type="hidden" class="input-field" name="customer_id" id="customer_id" value="0" />
                        <input
                          type="number"
                          class="input-field js_taka form-control"
                          name="add_amount"
                          id="add_amount"
                          value=""
                        />
                        <input
                          type="hidden"
                          class="input-field form-control"
                          name="customer_taka"
                          id="customer_taka"
                          value=""
                        />

                        <div class="input-group-prepend">
                          <span class="d-none" class="input-group-text" id="lenden">
                            <a id="c_transaction" target="_blank" href="#">লেনদেন </a>
                          </span>
                        </div>
                      </div>

                      <input
                        type="submit"
                        name="addSubmit"
                        class="btn btn-primary btn-user btn-block"
                        value=" যোগ করুন "
                      />
                      <hr />
                      <div class="alert alert-danger total add_last_added non-print" role="alert"></div>
                    </form>
                  </div>
                </div>

              </div>

              <div class="col-lg-6">
                <!-- Collapsable Card Example -->
                <div class="card shadow mb-4">
                  <div class="card-header m-0 font-weight-bold text-primary">অন্যান্য জমা</div>
                  <div class="card-body">
                    <form
                      class="user common-sell"
                      onsubmit="Insert_add_amount1(event,this,'#add_amount','.add_last_added');"
                    >
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-default">জমার নাম ‌‍</span>
                        </div>

                        <input
                          type="text"
                          required="true"
                          class="input-field form-control"
                          name="other_add_option"
                          id="other_add_option"
                          value=""
                        />
                      </div>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-default">টাকা </span>
                        </div>
                        <input type="text" class="form-control js_taka" name="amount" id="add_amount1" value="" />
                      </div>

                      <input
                        type="submit"
                        name="addSubmit"
                        class="btn btn-primary btn-user btn-block"
                        value=" যোগ করুন "
                      />
                      <hr />
                      <div class="alert alert-danger add_last_added" role="alert"></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div id="baki" class="container-fluid content-tab">
            <div class="row">
              <div class="col-lg-6">
                <!-- Default Card Example -->
                <div class="card mb-4">
                  <div class="card-header m-0 font-weight-bold text-primary">বাকী সম্পর্কিত তথ্য</div>
                  <div class="card-body">
                    <form class="user common-sell" onsubmit="Due_add(event,this,'#name','#due_amount');">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-default">এলাকা ‌‍</span>
                        </div>
                        <select id="due_area" class="form-control" name="due_area" size="1">
                         <?=$all_areas_name;?>
                        </select>
                      </div>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-default">পেশা</span>
                        </div>

                        <select
                          id="occupation"
                          class="form-control"
                          onchange="Build_customer_names(this,'#due_area')"
                          name="occupation"
                          size="1"
                        >
                             <?=$all_occupation;?>
                        </select>
                      </div>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-defaultduename">নাম </span>
                        </div>
                        <input
                          type="text"
                          name="name__sexyCombo"
                          id="name__sexyCombo"
                          list="dueCustomers"
                          class="form-control"
                          aria-label="Default"
                          autocomplete="off"
                          aria-describedby="inputGroup-sizing-default"
                        />
                      </div>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-default">আর্টিকেল </span>
                        </div>

                        <input
                          type="text"
                          list="articles"
                          name="due_article"
                          id="due_article"
                          class="form-control common_article"
                          aria-label="Default"
                          aria-describedby="inputGroup-sizing-default"
                        />
                      </div>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-default">নীট টাকা </span>
                        </div>
                        <input
                          type="number"
                          id="due_amount"
                          name="due_amount"
                          class="form-control"
                          aria-label="Default"
                          aria-describedby="inputGroup-sizing-default"
                        />
                      </div>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-default">এখন জমা </span>
                        </div>
                        <input
                          type="number"
                          name="partial_due_amount"
                          id="partial_due_amount"
                          class="form-control"
                          aria-label="Default"
                          aria-describedby="inputGroup-sizing-default"
                        />
                      </div>

                      <input
                        type="submit"
                        name="dueSubmit"
                        class="btn btn-primary btn-user btn-block"
                        value=" যোগ করুন "
                      />
                      <hr />
                      <div class="alert alert-danger due_last_added" role="alert"></div>
                    </form>
                  </div>
                </div>

                <!-- Basic Card Example -->
                <div class="card shadow mb-4"></div>
              </div>

              <div class="card shadow mb-1 col-lg-6" id="js_due_count">
                <!-- Card Header - Dropdown -->

                <div class="card-header py-1">
                  <div class="row">
                    <div class="col-8 font-weight-bold text-primary">আজকের মোট বাকী</div>
                    <div class="col-4 font-weight-bold text-primary text-uppercase mb-1 total_due"><?=$total_due_today;?></div>
                  </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                  <div class="row due_items">
                   <?=$due_list;?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div id="cost" class="container-fluid content-tab">
            <div class="row">
              <div class="card shadow mb-1 col-lg-6" id="js_cost_count">
                <!-- Card Header - Dropdown -->

                <div class="card-header py-1">
                  <div class="row">
                    <div class="col-8 font-weight-bold text-primary">আজকের মোট খরচ</div>
                    <div class="col-4 font-weight-bold text-primary text-uppercase mb-1 total_cost"><?=$total_cost_taka;?></div>
                  </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                  <div class="row costList">
                  <?=$cost_list;?>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <!-- Default Card Example -->
                <div class="card mb-4">
                  <div class="card-header m-0 font-weight-bold text-primary">খরচ তথ্য</div>
                  <div class="card-body">
                    <form class="user common-sell" onsubmit="cost_add(event,this,'#cost_amount','.cost_last_costed');">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-defaultcost">খরচের খাত ‌‍</span>
                        </div>

                        <input 
                          type="text"
                          name="cost_items_all"
                          id="cost_items_all"
                          class="form-control"
                          list="cost_items_list"
                          aria-label="Default"
                          aria-describedby="inputGroup-sizing-default"
                        />
                         
                        
                        <datalist id="cost_items_list">
                        <?=$cost_items_all;?>
                        </datalist>
                      </div>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-default">টাকা </span>
                        </div>
                        <input
                          type="number"
                          id="cost_amount"
                          name="cost_amount"
                          class="form-control"
                          aria-label="Default"
                          aria-describedby="inputGroup-sizing-default"
                        />
                      </div>

                      <input
                        type="submit"
                        name="dueSubmit"
                        class="btn btn-primary btn-user btn-block"
                        value=" যোগ করুন "
                      />
                      <hr />
                      <div class="alert alert-danger cost_last_costed" role="alert"></div>
                    </form>
                  </div>
                </div>

                <!-- Basic Card Example -->
                <div class="card shadow mb-4"></div>
              </div>
            </div>
          </div>

          <div id="ferot" class="container-fluid content-tab">
            <div class="row">
              <div class="card shadow mb-1 col-lg-6">
                <!-- Card Header - Dropdown -->

                <div class="card-header py-1">
                  <div class="row">
                    <div class="col-8 font-weight-bold text-primary">আজকের মোট ফেরত-</div>
                    <div class="col-4 font-weight-bold text-primary text-uppercase mb-1 total_back"><?=$total_back_taka;?></div>
                  </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                  <div class="row back_items">
                  <?=$back_list;?>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <!-- Default Card Example -->
                <div class="card mb-4">
                  <div class="card-header m-0 font-weight-bold text-primary">ফেরত তথ্য</div>
                  <div class="card-body">
                    <form
                      class="user common-sell"
                      onsubmit="Insert_back_amount(event,this,'#back_amount','.back_last_backed');"
                    >
                    <?php
                        if(isset($_SESSION['user_type']) && $_SESSION['user_type']==1){ ?>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-default">আর্টিকেল ‌‍</span>
                        </div>

                        <input
                          type="text"
                          list="articles"
                          name="back_article"
                          id="back_article"
                          class="form-control common_article"
                          aria-label="Default"
                          aria-describedby="inputGroup-sizing-default"
                        />
                      </div>

                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-default">টাকা </span>
                        </div>
                        <input
                          type="number"
                          id="back_amount"
                          name="back_amount"
                          class="form-control"
                          aria-label="Default"
                          aria-describedby="inputGroup-sizing-default"
                        />
                      </div>
                    <?php  } ?>

                      <div class="input-group mb-3 d-none hidden hide">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="inputGroup-sizing-default">মেমো নং ‌‍</span>
                        </div>
                        <input type="text" name="back_memo" id="back_memo" class="form-control" />
                      </div>

                      

                      <input
                        type="submit"
                        name="ferotSubmit"
                        class="btn btn-primary btn-user btn-block"
                        value=" যোগ করুন "
                      />
                      <hr />
                      <div class="alert alert-danger back_last_backed" role="alert"></div>
                    </form>
                  </div>
                </div>

                <!-- Basic Card Example -->
                <div class="card shadow mb-4"></div>
              </div>
            </div>
          </div>

          <div id="final" class="container-fluid content-tab mt-4">
            <div class="row">
              <div class="card shadow mb-1 col-4">
                <!-- Card Header - Dropdown -->

                <div class="card-header py-1 mx-auto">
                  <div class="row">
                    <div class="font-weight-bold text-primary"><?=$today?> ব্যবসার হিসাব </div>
                  </div>
                </div>

                <!-- Card Body -->
                <div class="card-body mx-auto">
                  <ul class="list-group border-bottom border-danger category-sales">

                  <?php foreach ( $categories as $val){ ?>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <?=$val?> বিক্রী
                      <span class="badge badge-light badge-pill mx-5 final_<?=$val?>">0</span>
                    </li>
                  <?php } ?>
                  </ul>

                  <ul class="list-group border-bottom border-danger category-sales">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      মোট বিক্রী
                      <span class="badge badge-light badge-pill mx-5 final_sell text-info">0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      ফেরত
                      <span class="badge badge-light badge-pill ml-5">-</span>
                      <span class="badge badge-light badge-pill mx-5 final_back text-danger">0</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      বাকী
                      <span class="badge badge-light badge-pill ml-5">-</span>
                      <span class="badge badge-light badge-pill mx-5 final_due text-danger">0</span>
                    </li>
                  </ul>

                  <ul class="list-group border-bottom border-danger category-sales">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      .....
                      <span class="badge badge-light badge-pill mx-5 final_operation1">0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      জমা

                      <span class="badge badge-light badge-pill mx-5 final_add">0</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      ক্যাশ

                      <span class="badge badge-light badge-pill mx-5 final_cash">0</span>
                    </li>
                  </ul>

                  <ul class="list-group border-bottom border-danger category-sales">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      মোট টাকা

                      <span class="badge badge-light badge-pill mx-5 final_operation2">0</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      খরচ
                      <span class="badge badge-light badge-pill ml-5">-</span>
                      <span class="badge badge-light badge-pill mx-5 final_cost text-danger">0</span>
                    </li>
                  </ul>

                  <ul class="list-group border-bottom border-danger category-sales">
                    <li class="list-group-item d-flex justify-content-between align-items-center text-success">
                      সর্বশেষ ক্যাশ

                      <span class="badge badge-light badge-pill text-success mx-5 final_result">0</span>
                    </li>
                  </ul>

                  <hr />
                </div>
              </div>

              <div class="card shadow mb-1 col-2 d-none d-md-block">
                 <div class="js_sell_count"> sell count:</div>

              </div>

              <div class="card shadow mb-1 col-3  d-none d-md-block">
                 <div class="js_due_count">Due Info</div>

              </div>

              <div class="card shadow mb-1 col-3  d-none d-md-block">
              <div class="js_cost_count"> Cost Info</div>

              </div>
             
            </div>
          </div>

          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

               <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; alamincse07@gmail.com</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal -->
    <div
      class="modal fade"
      id="leaveModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">ছুটির তথ্য</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="user common-sell" onsubmit="add_leave_event(this,event);">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">সেলসম্যান </span>
                </div>
                <select class="form-control" id="salesmans" name="name" size="1">
                  
                  <?=$dokan_stuff;?>
                </select>
                </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">ছুটির পরিমান (দিন)</span>
                </div>
                <input
                  type="text"
                  name="cuti"
                  class="form-control"
                  value="1"
                  aria-label="Default"
                  aria-describedby="inputGroup-sizing-default"
                />
              </div>

              <input type="submit" name="leaveSubmit" class="btn btn-primary btn-user btn-block" value=" যোগ করুন " />
              <hr />
              <div class="cuti-info text-success"></div>
            </form>
          </div>
        </div>
      </div>
    </div>




    <div
      class="modal fade"
      id="oldViewModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">পুরানো দিনের তথ্য </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="user common-sell" action="index">
              

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">দিন</span>
                </div>
                <input
                  type="date"
                  name="date"
                  class="form-control"
                  value="1"
                  aria-label="Default"
                  aria-describedby="inputGroup-sizing-default"
                />
              </div>

              <input type="submit" name="oldViewSubmit" class="btn btn-primary btn-user btn-block" value=" দেখুন  " />
              <hr />
              <div class="cuti-info text-success"></div>
            </form>
          </div>
        </div>
      </div>
    </div>










    <div
      class="modal fade"
      id="rememberModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">স্মরন</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="user common-sell" onsubmit="add_remember_event(event,'#note_text','#note_date');">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-defaultreme">মনে রাখ </span>
                </div>
                <input
                  type="text"
                  id="note_text"
                  name="note_text"
                  class="form-control"
                  aria-label="Default"
                  aria-describedby="inputGroup-sizing-default"
                />
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">তারিখ </span>
                </div>
                <input
                  type="date"
                  name="note_date"
                  value="<?=$today;?>"
                  id="note_date"
                  class="form-control"
                  aria-label="Default"
                  aria-describedby="inputGroup-sizing-default"
                />
              </div>

              <input type="submit" name="noteSubmit" class="btn btn-primary btn-user btn-block" value=" যোগ করুন " />
              <hr />
              <div class="note-info text-success"></div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="noteModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">গুরুত্বপূর্ণ তথ্য ব্যাংক/ঠিকানা</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="user common-sell">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">নাম </span>
                </div>
                <input
                  type="text"
                  class="form-control"
                  aria-label="Default"
                  aria-describedby="inputGroup-sizing-default"
                />
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">বিস্তারিত </span>
                </div>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>

              <input type="submit" name="dueSubmit" class="btn btn-primary btn-user btn-block" value=" যোগ করুন " />
              <hr />
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Loading Modal-->
    <div
      class="modal js_loader"
      id="loadingModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="text-center" id="inputGroup-sizing-defaultd">অপেক্ষা করুন .....</div>
          </div>
        </div>
      </div>
    </div>

    
    <div class="modal fade" id="holdListModal" tabindex="-1" aria-labelledby="holdListModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="holdListModalLabel">Held Forms</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <ul id="hold-list" class="list-group"></ul>
          </div>
        </div>
      </div>
    </div>

    <datalist id="dueCustomers">

    </datalist>

    <datalist id="articles">

    </datalist>
    <!-- Bootstrap core JavaScript-->
    <script src="../js/jquery-new.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->



    <script>
    var SITE_URL='<?=Yii::app()->request->baseUrl?>/';
    
    window.price_list=[];
    $(document).ready(function(){

        var time= new Date().valueOf();
        $.ajax({
            dataType:"json"

            ,url:SITE_URL+"SimpleAjax/ArticleInfo?all="+ time

            ,success: function(data) {
                if(data.status == 'success')
                {
                    $('#articles').html("<option value=''></option>"+data.all_articles);

                    if(window.price_list.length<1){
                        window.price_list=data.price_list;
                    }
                }
            }
        });



        $(".collapse-item").click((e) => {
        var div = e.target.getAttribute("href");

        
        if (div && div.indexOf("#") !== -1) {
          $(".content-tab").hide();
          $(div).show();
          $(".collapse").removeClass("show");
          <?php if($is_mobile){
              echo " $('#sidebarToggleTop').trigger('click');";
          }?>

        }
      });

      $(".js_main").click((e) => {
        $(".content-tab").hide();
        $("#sale").show();
        $(".collapse").removeClass("show");
        <?php if($is_mobile){
              echo " $('#sidebarToggleTop').trigger('click');";
          }?>
      });

      $("#finalClose").click((e) => {
        $(".content-tab").hide();
        get_cash_amount();
        $("#final").show();
        $(".collapse").removeClass("show");
        $('.js_sell_count').html($('#js_sell_count').html());
        $('.js_cost_count').html($('#js_cost_count').html());
        $('.js_due_count').html($('#js_due_count').html());
        <?php if($is_mobile){
              echo " $('#sidebarToggleTop').trigger('click');";
          }?>
      });


    });

    var Categories = <?php echo json_encode($categories); ?>

    </script>

  <script src="../js/sb-admin-2.min.js">  </script>
    <script src="../js/dokan-new-v2.js?v3"></script>
    <script src="../js/pos-script.js"></script>
  </body>
</html>
