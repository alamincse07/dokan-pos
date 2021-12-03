<?php
/**
 * Created by Sabbir.
 * To change this template use File | Settings | File Templates.
 */


Yii::import('zii.widgets.grid.CGridView');
class MGridView extends CGridView{
    function init(){
        //$pageSize=(!empty(Yii::app()->request->getParam('pageSize')))?Yii::app()->request->getParam('pageSize'):10;#Yii::app()->user()->hasState('page-size') ? user()->getState('page-size'):20;
       // $pageSize = (Yii::app()->request->getParam('pageSize')>0)?Yii::app()->request->getParam('pageSize'):5;
        $this->dataProvider->pagination->pageSize=10;


        //Generic::_setTrace($_GET);
       if(count($this->columns)){

            foreach($this->columns as $key=>$column){
                if(isset($column['class'])&& $column['class']==='CButtonColumn' && !isset($column['header'])){
                    $this->columns[$key]['header']=CHtml::dropDownList(
                        'page-size',
                        20,
                        array(10=>10,20=>20,50=>50,100=>100,500=>500,1000=>1000 ),
                        array('onchange'=>"$.fn.yiiGridView.update('".$this->getId()."',{ data:{pageSize: $(this).val() }})")
                    );
                }
            }
        }
        if(count($this->columns)){
            #Generic::_setTrace($this->columns);
           foreach($this->columns as $key=>$column){
               if(isset($column['class'])&& $column['class']==='CButtonColumn' /*&& !isset($column['header'])*/){
                   $this->columns[$key]['header']='Options';

                   if(@Yii::app()->session['user_type']==1){
                       $this->columns[$key]['template']='{update}{delete}';
                   }else{
                       $this->columns[$key]['template']='{view}';
                   }
                   $this->columns[$key]['buttons'] =array
                   (
                       'update' => array
                       (
                           'label'=>'পরিবর্তন -',
                           'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit.png',

                       ),
                       'delete' => array
                       (
                           'label'=>'-বাদ',
                           'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',


                       ),
                       'view' => array
                       (
                           'label'=>'দেখো',
                           'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',

                       ),
                   );
                   //Generic::_setTrace($this->columns);

               }
           }
       }

        return parent::init();
    }
}