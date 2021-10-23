<?php
/**
 * @var $this Controller
 */
$L=$this::$L;
$baseUrl = Yii::app()->request->baseUrl;
$adminAssetsUrl = $baseUrl."/admin-asset";
$advisor_id = $this->getUserId();
//Generic::_setTrace($advisor_id);
$tasks_data= array();
$message_data=array();
$now_date = date('Y-m-d H:i:s');

$super_admin=true;
if($this->getAdvisorRole()!=1){
    $super_admin=false;
}
?>
<div class="top-navbar header b-b"> <a data-original-title="Toggle navigation" class="toggle-side-nav pull-left" href="javascript:void(0);"><i class="icon-reorder"></i> </a>
    <div class="brand pull-left">
        <a href="<?=$this->createUrl("/admin/")?>">
            <img src="<?=$baseUrl?>/images/logo/admin-logo.jpg" height="33">
        </a>
    </div>
    <div class="breadcrumbs-box pull-left">
        <?php

        if(isset($this->breadcrumbs)):
            $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>$this->breadcrumbs,
                'separator'=>' / ',
                'homeLink' => CHtml::link ('Dashboard',array('/admin')),
            ));//<!-- breadcrumbs -->
        endif;
        ?>
    </div>
    <ul class="nav navbar-nav navbar-right  hidden-xs">
        <li class="dropdown js-task-box">

        </li>

        <li class="dropdown js-message-box">


        </li>

        <li class="dropdown user  hidden-xs"> <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);"> <i class="icon-male"></i> <span class="username"><?php echo $this->getUserFullName(); ?></span> <i class="icon-caret-down small"></i> </a>
            <ul class="dropdown-menu">
                <?php

                if(!$super_admin){

                 echo '<li><a href="'.$this->createUrl('clientAdvisors/view/'.$advisor_id).'"><i class="icon-user"></i>'.$L->g('My Profile').' </a></li>';
                }
               ?>
                <li><a href="<?=$this->createUrl('clientTasks/admin/')?>"><i class="icon-tasks"></i><?=$L->g('My Tasks')?> </a></li>
                <?php  if(!$super_admin){?>
                <li><a href="<?=$this->createUrl('clientAdvisors/advisorsettings/'.$advisor_id)?>"><i class="icon-wrench "></i><?=$L->g('Settings')?> </a></li>
                <?php }?>
                <?php if($super_admin){?>
                    <li><a href="<?=$this->createUrl('user/superAdminSettings/'.$advisor_id)?>"><i class="icon-wrench "></i><?=$L->g('Settings')?> </a></li>
                <?php }?>
                <li class="divider"></li>
                <li> <?=CHtml::link(
                        '<i class="icon-key"></i>'.$L->g("Log Out"),
                        $this->createUrl('site/logout'));?>
                </li>
            </ul>
        </li>
    </ul>
</div>

<script>
        (function ($) {
            var base_url = $('#base_url').val();
            var SITE_URL = base_url + '/';


            try {
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: SITE_URL + "simpleAjax/getTotalMessage",
                    data: {id: '<?=$advisor_id?>'},
                    success: function (data) {
                        if (data.status == 'success') {
                            $('.js-message-box').html(data.message_data);
                            if(data.count>0){
                                $('#left_nav_message').html('<strong><span class="notify">'+data.count+'</span></strong>');
                            }
                        }
                    },
                    error: function (e) {
                        console.log('ajax error');
                    }
                });
            } catch (E) {
                sweetCore._setTrace(E);
            }
        })(jQuery);



        (function ($) {
            var base_url = $('#base_url').val();
            var SITE_URL = base_url + '/';


            try {
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: SITE_URL + "simpleAjax/getTotalTasks",
                    data: {id: '<?=$advisor_id?>'},
                    success: function (data) {
                        if (data.status == 'success') {
                            $('.js-task-box').html(data.task_data);
                           // $('.left_nav_task').val(data.count);
                            if(data.count>0){
                                $('#left_nav_tasks').html('<strong><span class="notify">'+ data.count +'</span></strong>');
                            }
                        }
                    },
                    error: function (e) {
                        console.log('ajax error');
                    }
                });
            } catch (E) {
                sweetCore._setTrace(E);
            }
        })(jQuery);







</script>
