<?php
/* @var $this SavingsController */
/* @var $model Savings */

$this->breadcrumbs=array(
    'Savings'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'List Savings', 'url'=>array('index')),
    array('label'=>'Create Savings', 'url'=>array('create')),
);

?>
<style>
    .grid-view table.items th, .grid-view table.items td {
        border: 1px solid white;
        font-size: 1.2em;
        padding: 0.55em;
    }
</style>

<h1>Check Savings</h1>

<div class="form">

    <form action="" method="get">

        <div class="row">
            <span class="label">
                DATE
            </span>
            <input name="date" type="text" value="<?=$date?>">
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>

</div>

<div class="row">
    <label> Total Amount Can Be Taken : <?=$total?></label>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'savings-grid',
    'dataProvider'=>$data,
    //'filter'=>$model,
    'columns'=>array(
        'account_number',
        'opend_date',

        'owner',
        'amount',
        'term',
        'pull_date',
        'rate',
        'total',

    ),
)); ?>


