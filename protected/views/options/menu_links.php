<?php

$base_url= Yii::app()->request->baseUrl;
if(isset($_SESSION['user_type']) && $_SESSION['user_type']==1){

$menus='


                      <li><a target="_blank"  href="'.$base_url.'/articles/add">স্টকে যোগ </a></li>
                       <li><a target="_blank" href="'.$base_url.'/articles/admin">স্টক</a></li>
                      <li><a target="_blank" href="'.$base_url.'/dailySellInformation/dokanStock"> তথ্য </a></li>
                      <li><a target="_blank" href="'.$base_url.'/dailySellInformation/admin">বিক্রী </a></li>
                      <li><a target="_blank" href="'.$base_url.'/dailyCostItems/admin">খরচ  </a></li>
                      <li><a target="_blank" href="'.$base_url.'/dailyAddAmount/admin">জমা </a></li>
                      <li><a target="_blank" href="'.$base_url.'/CustomerTransaction/admin"> লেনদেন </a></li>

                      <li><a target="_blank" href="'.$base_url.'/lenders/admin">কর্জকারী </a></li>
                      <li><a target="_blank" href="'.$base_url.'/CustomerDueInformation/admin">বাকী টাকা  </a></li>
                      <li><a target="_blank" href="'.$base_url.'/Kormocari/admin">সদস্য </a></li>
                      <li><a target="_blank" href="'.$base_url.'/MoneyBackIteams/admin"> ফেরত </a></li>
                      <li><a target="_blank" href="'.$base_url.'/CostItems/admin">খরচের খাত </a></li>
                      <li><a target="_blank" href="'.$base_url.'/CustomerOccupation/admin">পেশা </a></li>
                      <li><a target="_blank" href="'.$base_url.'/AreaNames/admin">এলাকা </a></li>
                      <li><a target="_blank" href="'.$base_url.'/lastAddedItems/admin">শেষে স্টকে থোলা </a></li>

';
}else{


    $menus='


                      <li><a target="_blank" href="'.$base_url.'/articles/admin">স্টক</a></li>

                      <li><a target="_blank" href="'.$base_url.'/dailySellInformation/admin">বিক্রী </a></li>
                      <li><a target="_blank" href="'.$base_url.'/dailyCostItems/admin">খরচ  </a></li>
                      <li><a target="_blank" href="'.$base_url.'/dailyAddAmount/admin">জমা </a></li>
                      <li><a target="_blank" href="'.$base_url.'/CustomerTransaction/admin"> লেনদেন </a></li>

                      <li><a target="_blank" href="'.$base_url.'/lenders/admin">কর্জকারী </a></li>
                      <li><a target="_blank" href="'.$base_url.'/CustomerDueInformation/admin">বাকী টাকা  </a></li>

                      <li><a target="_blank" href="'.$base_url.'/CostItems/admin">খরচের খাত </a></li>
                      <li><a target="_blank" href="'.$base_url.'/CustomerOccupation/admin">পেশা </a></li>
                      <li><a target="_blank" href="'.$base_url.'/AreaNames/admin">এলাকা </a></li>
                      <li><a target="_blank" href="'.$base_url.'/lastAddedItems/admin">শেষে স্টকে থোলা </a></li>



';
}

print $menus;

