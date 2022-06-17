<?php
   $dbhost = 'localhost:3306';
   $dbuser = 'root';
   $dbpass = '';
  // $dbName= 'skalamin_dokan';
   $dbName= 'dokan';
   $link = mysqli_connect($dbhost, $dbuser, $dbpass);
   
   if(! $link ) {
      die('Could not connect: ' . mysqli_error());
   }
	
   $db_tbl_nm = "member";
   $final_result_orignal_recovery_file  = "/$db_tbl_nm.sql";
   $sql_QQ = "SELECT * INTO OUTFILE '$final_result_orignal_recovery_file' FROM $db_tbl_nm";
   
   mysqli_select_db($link,$dbName);
   $all_contents = mysqli_query( $link,  $sql_QQ );
   
   if(! $all_contents ) {
      die('Could not take data backup: ' . mysqli_error($link));
   }
   
   echo "Backedup  data successfully\n";
   
   mysqli_close($link);
?>