<?php
/* @var $this ArticlesController */
/* @var $model Articles */
?>


<h1>

Search by Tags | 
<?php
if(isset($_GET['tags'])){
	echo "Total (".$_GET['tags'].") : <span class='text-info'> ". Articles::getTotalByTags($data, 'total_pair'). '</span>';
}
?>
</h1>


<!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script> -->

<div class="row-fluid">
  <div class="row">
<?php 
  echo $this->renderPartial('../elements/label-builder', ['action'=>'Search']);
?>
</div>
</div>

<?php 



 $this->widget('zii.widgets.grid.CGridView', array(
 // $this->widget('MGridView', array(
    'id'=>'tags-grid',
    'dataProvider'=>$data,
    //'filter'=>$model,
    'columns'=>array(
        'article',
        'total_pair',
		array(
            'name'=>'total_pair',
            // 'footer'=>Articles::getTotalByTags($data, 'total_pair'),

        ),
        'orginal_article'
    ),
)); 
?>



<script>
		function SetName(){
		  var name = $("#slogan-box").text();
		  var tags = (name.trim().replace(/×/g,  ',').trim());
		  window.location.href= '<?=Yii::app()->request->baseUrl?>/articles/SearchByTags?tags='+tags;
		}

</script>