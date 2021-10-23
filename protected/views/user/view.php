<?php
/* @var $this UserController */
/* @var $L Language */
/* @var $model User */
//FOR LANGUAGE
$L = $this::$L;
$this->breadcrumbs=array(
    $L->g('Users')=>array('index'),
	$model->id,
);



$this->menu=array(
	array('label'=>$L->g("List User"), 'url'=>array('index')),
	array('label'=>$L->g('Create User'), 'url'=>array('create')),
	array('label'=>$L->g('Update User'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>$L->g('Delete User'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>$L->g('Are you sure you want to delete this item?'))),
	array('label'=>$L->g('Manage User'), 'url'=>array('admin')),
);
?>
<div class="mws-panel grid_7">
<h2><?php echo $L->g('View User') ?> #<?php echo $model->id; ?></h2>
    <div class="mws-panel-header"></div>
    <div class="mws-panel-body" style="height: auto">
        <?php
        $avatar = ($model->avatar!="")?CHtml::image($model->avatar):null;

        ?>


        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                'id',
                'username',
                //array('name'=>$model->getAttributeLabel('avatar'),'type'=>'raw','value'=>Yii::app()->getBaseUrl(true).$avatar,),
                array('type'=>'raw','value'=>CHtml::image(Yii::app()->baseUrl."/uploaded/profile-images/".$model->avatar)
                ),
                'full_name',
                'email',
                'create_date',
                'update_date',
                array('name'=>'action', 'value'=>$model->getActiveText($model)),
            ),
        )); ?>
        <div class="clear"></div>
    </div>

    <div style="background-color: #606060; text-align: center;">
        <?php echo CHtml::link('<button class="btn btn-primary">Edit</button>',array('user/update/'.$model->id)); ?>
    </div>
</div>