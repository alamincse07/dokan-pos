<?php

if(isset($_SESSION['user_type']) && $_SESSION['user_type']==1){

$menus='


                      <li><a target="_blank"  href="http://localhost/dokan/options/article_add.php">স্টকে যোগ </a></li>
                      <li><a target="_blank" href="http://localhost/dokan/">মূল হিসাব </a></li>
                      <li><a target="_blank" href="http://localhost/dokan/options/index.php">স্টক</a></li>
                      <li><a target="_blank" href="http://localhost/dokan/options/dokan_stock.php"> তথ্য </a></li>
                      <li><a target="_blank" href="http://localhost/dokan/options/sell_information.php">বিক্রী </a></li>
                      <li><a target="_blank" href="http://localhost/dokan/options/cost_view.php">খরচ  </a></li>
                      <li><a target="_blank" href="http://localhost/dokan/options/add_view.php">জমা </a></li>
                      <li><a target="_blank" href="http://localhost/dokan/options/customer_transaction_view.php"> লেনদেন </a></li>

                      <li><a target="_blank" href="http://localhost/dokan/options/lenders_view.php">কর্জকারী </a></li>
                      <li><a target="_blank" href="http://localhost/dokan/options/due_customer_view.php">বাকী টাকা  </a></li>
                      <li><a target="_blank" href="http://localhost/dokan/options/member_view.php">সদস্য </a></li>

                      <li><a target="_blank" href="http://localhost/dokan/options/cost_items.php">খরচের খাত </a></li>
                      <li><a target="_blank" href="http://localhost/dokan/options/occupation.php">পেশা </a></li>
                      <li><a target="_blank" href="http://localhost/dokan/options/area_name.php">এলাকা </a></li>

';
}else{


    $menus='


                      <li><a target="_blank" href="http://localhost/dokan/">মূল হিসাব </a></li>
                      <li><a target="_blank" href="http://localhost/dokan/options/index.php">স্টক</a></li>
                      <li><a target="_blank" href="http://localhost/dokan/options/lenders_view.php">কর্জকারী </a></li>
                      <li><a target="_blank" href="http://localhost/dokan/options/due_customer_view.php">বাকী টাকা  </a></li>
                      <li><a target="_blank" href="http://localhost/dokan/options/member_view.php">সদস্য </a></li>

                      <li><a target="_blank" href="http://localhost/dokan/options/cost_items.php">খরচের খাত </a></li>
                      <li><a target="_blank" href="http://localhost/dokan/options/occupation.php">পেশা </a></li>
                      <li><a target="_blank" href="http://localhost/dokan/options/area_name.php">এলাকা </a></li>

';


}



