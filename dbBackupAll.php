<?php
   $dbhost = 'localhost:3306';
   $dbuser = 'root';
   $dbpass = '';
   $dbName= 'skalamin_dokan';
   $link = mysqli_connect($dbhost, $dbuser, $dbpass);

   include_once(dirname(__FILE__) . '/mysqldump-php-master/src/Ifsnop/Mysqldump/Mysqldump.php');
   $dump = new Ifsnop\Mysqldump\Mysqldump("mysql:host=localhost;dbname=$dbName", "$dbuser", "$dbpass");
   $dump->start('db-dump.sql');
?>