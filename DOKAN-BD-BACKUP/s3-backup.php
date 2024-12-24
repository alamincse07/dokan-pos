<?php


 define('AWS_S3_REGION', 'us-west-2');
 define('AWS_S3_BUCKET', 'skalamin.com');
 define('AWS_S3_URL', 'http://s3.'.AWS_S3_REGION.'.amazonaws.com/'.AWS_S3_BUCKET.'/');


 $file = date('Y-m-d').'.sql';

 $tmpfile =  __DIR__."/../dokan-db-dump.sql";
 echo " file : ". $tmpfile;
if (defined('AWS_S3_URL')) {
  // Persist to AWS S3 and delete uploaded file
  require_once('S3.php');
  S3::setAuth(AWS_S3_KEY, AWS_S3_SECRET);
  S3::setRegion(AWS_S3_REGION);
  S3::setSignatureVersion('v4');
  S3::putObject(S3::inputFile($tmpfile), AWS_S3_BUCKET, 'dokan-backups/'.date('Y').'/'.date('M').'/'.$file, S3::ACL_PUBLIC_READ);
  // unlink($tmpfile);
  echo "s3 upload done";
} else {
 // Persist to disk
die(' skip s3');
}