<?php

// print_r($_REQUEST);
// die;

$COLOR='red';
?>


<!DOCTYPE html>
<html>
<head>

 <style type="text/css">
        @media screen {
            p.bodyText {
                font-family: verdana, arial, sans-serif;
            }
        }


        @media print {

            body {
                width: 21cm;
                height: 29.7cm;
                margin: 0mm 1mm 0mm 5mm;
                /* margin-left:auto; margin-right:auto;  */
                /* change the margins as you want them to be. */

                /*  3508 x 2480 */
            }


        }

        @media screen, print {

           
            /* table {page-break-inside: avoid;}*/
            /* td {  page-break-inside: avoid;}  */
            tr {  page-break-inside: avoid;}

              td {
                    padding: .7mm 0mm;
                }
            td {

                width: 52mm;
                height: 20mm;
                /* padding: .3mm .1mm; */

                color: red
                    /* width: 50px; */
            }
        }

        
        	/* You can only change the size, margins, orphans, widows and page breaks here */


    </style>


</head>
<body>




<div class="container">

			<?php

            $images = $_REQUEST['images'];
			$print_cp=[];
			// $img= '<IMG class="displayed" src="/barcodes/'.createSlug($text).'.png" alt="...">';
            echo " <script> var printable=0;</script>";
             foreach($images as $img_source=>$count){


               	if($count*1 > 0){
                        echo " <script>  printable=1;</script>";


                    for($i=0;$i<$count;$i++){

                        $print_cp[]=$img_source;
                    
                    }
			    }
             }
			//print $count;

			//print(count($print_cp));die;



			?>
           



		  	 <table id=table1>
                <?php 
                $per_row=(isset($_REQUEST['per_row']) && is_numeric($_REQUEST['per_row']))?$_REQUEST['per_row']:4;
                foreach (array_chunk($print_cp, $per_row) as $row) { ?>
					<tr>
					<?php foreach ($row as $img) { ?>
						<td><?php echo '<IMG class="displayed" src="/'.$img.'" >'; ?></td>
					<?php } ?>
					</tr>
				<?php } ?>
			 </table>
                  
        </div>

        
        <script>
         if(printable >0){
            window.print();
         }else{
             window.close();

         }
            
        </script>
</body>
</html>