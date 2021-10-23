<?php
 class common_class   {
   public static  function  Convert($number){

       $bn_digits=array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
       $output = str_replace(range(0, 9),$bn_digits, $number);
       return $output;
   }
     public static  function  Convert_day($day){
        $en_day=array('Sat','Sun','Mon','Tue','Wed','Thu','Fri');
         $bn_digits=array('শনিবার','রবিবার','সোমবার','মঙ্গলবার','বুধবার','বৃহস্পতিবার','শুক্রবার');

         $str = str_replace( $en_day, $bn_digits, $day );

         return $str;
     }
     public static  function Get_Article_Details($article){

         $article = TRIM(strtoupper($article));
         $sql="select * from articles where article='$article' limit 1";
        //$res=$db->query($sql);
         $row=Yii::app()->db->createCommand($sql)->queryRow();
         //$row=$res->fetch_assoc();
         return $row;
     }

     public static function GetAllArticles($force_write=false){
	 
	 RETURN $all_article_lists = self::Get_articles();
         $blog_data_file='article_list.txt';
         if($force_write){

             $all_article_lists = self::Get_articles();

             $saved=@file_put_contents($blog_data_file, $all_article_lists);


         }else{


             $write=false;
             if(file_exists($blog_data_file)){
                 $file_time = filemtime($blog_data_file);
             }else{
                 $file_time = false;
             }

             if($file_time==false or ( time()-$file_time)>1*24*60*60){//check for file older than 1 days?
                 $write=true;
             }

             if($write){

                 $all_article_lists = self::Get_articles();
                 //Generic::_setTrace($all_article_lists);
                 //write locally the contents
                 $saved=@file_put_contents($blog_data_file, $all_article_lists);


             }else{
                 //die('dfgf');
                 $all_article_lists = @file_get_contents($blog_data_file);
             }


         }
         return $all_article_lists;

        }

     public static  function Get_articles(){
        global $db;
         $ar_q= "SELECT article,body_rate FROM articles group by  article ";
         $res_ar_q= Yii::app()->db->createCommand($ar_q)->query();

         $all_articles='';
         $article_rate=[];

         while($val=$res_ar_q->read()){

             $all_articles.='<option value="'.$val['article'].'">'.$val['article'].'</option>';
             $article_rate[$val['article']]=$val['body_rate'];
         }
            return ['dropdown_option'=>$all_articles,'price_list'=>$article_rate];

     }
 }