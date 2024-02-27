<?php

$words='';
 foreach($wordList as $k=>$v){
    $words.='<label class="col-2 word" id="'.$v.'" style="font-size:25px;" draggable="true" ondragstart="drag(event)">'.$v.'</label>';
 }
 ?>
    <div class="box_generator hidden">
	
			
			<div>
                <?=$words ?>
           	</div>
			
            <div class="row p-4" >

                    <div class="col-3"><button class="btn btn-primary" onclick="reset();">Clear</button></div>
                    <div class="col-6 form-group">
                        <textarea class="form-control" id="input" style="font-size:30px; height:75px;  width:550px; resize:none;" ondrop="drop(event)" ondragover="dragOver(event)" readonly="readonly"/></textarea>
                    </div>
                    <div class="col-3"><button class="btn btn-info" onclick="submit();">Copy</button></div>
			</div>
			
	</div>


    <script>
        function dragOver(e) {
  e.preventDefault();
  console.log(document.getElementById("input").value);
}

function drop(e) {
  e.preventDefault();
  var data = e.dataTransfer.getData("data");

  document.getElementById("input").value += " "+data;
}

function drag(e) {
  e.dataTransfer.setData("data", e.target.id);
}

function reset() {
  document.getElementById("input").value = "";
}

function submit() {
  var copyText = document.getElementById("input");

// Select the text field
copyText.select();
copyText.setSelectionRange(0, 99999); // For mobile devices

 // Copy the text inside the text field
navigator.clipboard.writeText(copyText.value);

// Alert the copied text
alert("Copied the text: " + copyText.value);
}

    </script>    