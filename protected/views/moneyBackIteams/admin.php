<?php
/* @var $this MoneyBackIteamsController */
/* @var $model MoneyBackIteams */

$this->breadcrumbs=array(
	'Money Back Iteams'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MoneyBackIteams', 'url'=>array('index')),
	array('label'=>'Create MoneyBackIteams', 'url'=>array('create')),
);


?>

<h1>Manage Money Back Iteams</h1>

<div  class="single-page-header">

    <form action="" method="get">


        <div  class="claim_form">
           নাম
            <input   id="profit_article" name="article_name"  size="30">

            </select>
            তারিখ শুরু
            <?=Generic::AddDatePicker('date_start')?>
            <!--<input type="text"  size="10" class="date_picker" name="date_start" value="<?/*=date('Y-m-d')*/?>">
-->
            তারিখ শেষ
            <?=Generic::AddDatePicker('date_end')?>
            <!--<input type="text" size="10" class="date_picker" name="date_end" value="<?/*=date('Y-m').'-30'*/?>">
          -->
            <input type="submit"  class="button" name="article_info" value="দেখুন ">
        </div>
    </form>
</div>




<?php
if(@Yii::app()->session['user_type']==1){
    $template='{view}{update}{delete}';
}else{
    $template ='{view}';
}
$this->widget('MGridView', array(
	'id'=>'money-back-iteams-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'article',
		'amount',
		'manager',
		'date',
        array(
			'class'=>'CButtonColumn',
            'template' =>$template,
	),
)
)
);
?>
