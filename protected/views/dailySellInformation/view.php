<?php
/* @var $this DailySellInformationController */
/* @var $model DailySellInformation */

$this->breadcrumbs=array(
	'Daily Sell Informations'=>array('index'),
	$model->id,
);

$url = Yii::app()->request->baseUrl.'/memo.php?'.http_build_query($model->attributes);
$this->menu=array(
	array('label'=>'List DailySellInformation', 'url'=>array('index')),
	array('label'=>'Create DailySellInformation', 'url'=>array('create')),
	array('label'=>'Update DailySellInformation', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DailySellInformation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DailySellInformation', 'url'=>array('admin')),
);
?>

<h1>View DailySellInformation #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category',
		'date',
		'article',
		'size',
		'color',
		'manager',
		'sells_man',
		'price',
        array(
            'name'=>'profit',
            'value'=>'$data->profit',
            'visible'=>false,
            /*'header'=>false,
            'filter'=>false,
            'htmlOptions'=>array('style'=>'display:none'),*/
        ),
	),
)); 




if(isset($_REQUEST['print'])){ ?>


<script>

window.location.href= '<?php echo $url; ?>';
</script>
<?php } ?>