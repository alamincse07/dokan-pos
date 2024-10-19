<?php
$actionName = isset($action)? $action : 'Set';
?>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />

<style>

    .flex{
        display:flex;
    }
    .label-builder{
        display:flex;
        background-color:#8298db;
    }
    .dropped-tag{
            margin-right:10px;
    }
   
    .word{
        color: #ffffff;
        background-color: transparent;
        font-size: 14px;
        font-weight: bold;
        cursor:pointer;
        border: 1px solid green;
        padding: 5px 8px;
        margin: 5px;
        background-color: #7c6d3b;
    }
    .box_generator{
        background-color:#35b39b;
    }


      #available-tags {
        margin: 2px;
        padding: 10px;
        border: 1px solid #ccc;
        width: 300px;
      }
      .tag {
        display: inline-block;
        padding: 7px 10px;
        background: #f0f0f0;
        margin: 5px;
		z-index: 5;
        border-radius: 5px;
        cursor: pointer;
      }
      #slogan-box {
        margin: 2px;
        padding: 5px;
        border: 2px dashed #ccc;
        min-height: 50px;
		z-index:2;
        width: 300px;
        background: #e5ff43;
      }
      .removable {
        color: red;
        cursor: pointer;
        margin-left: 5px;
      }
</style>



<div class="col-12 label-builder">
	
     <?=Generic::getTags() ?>
       

		<div class="col-4">	
			<div id="slogan-box" >
				
			</div>
			<button class="btn btn-danger" onClick="SetName()"> <?=$actionName ?> ➤ </button>
		     
    </div>
</div>




<script>
       $(document).ready(function(){
        // Make tags draggable
        $(".tag").draggable({
          helper: "clone",
          revert: "invalid",
        });

        // Make the slogan box droppable
        $("#slogan-box").droppable({
          accept: ".tag",
          drop: function (event, ui) {
            var tagText = $(ui.helper).text();
            var newTag = $("<span class='dropped-tag'>" + tagText + "<span class='removable'>&times;</span></span>");
            $(this).append(newTag);

            // Make the new tag removable
            $(".removable").click(function () {
              $(this).parent().remove();
            });
          },
        });

        // Remove tags on click of removable class
        $(document).on("click", ".removable", function () {
          $(this).parent().remove();
        });

		
      });

</script>


