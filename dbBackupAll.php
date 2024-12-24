<?php
   $dbhost = 'localhost:3306';
   $dbuser = 'u634993003_skalamin_dokan';
   $dbpass = 'u634993003_skalamin_dokanR8';
   $dbName= 'u634993003_skalamin_dokan';
   $link = mysqli_connect($dbhost, $dbuser, $dbpass);

   include_once(dirname(__FILE__) . '/mysqldump-php-master/src/Ifsnop/Mysqldump/Mysqldump.php');
   $dump = new Ifsnop\Mysqldump\Mysqldump("mysql:host=localhost;dbname=$dbName", "$dbuser", "$dbpass");
   $dump->start('dokan-db-dump.sql');
   echo " Dump done!";
?>