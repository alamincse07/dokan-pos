<?php
/**
 * Created by sunny.
 * User: Computer Source
 * Date: 7/18/14
 * Time: 10:27 AM
 * @var $this Controller
 * @var $L Language
 */
$this->pageTitle=Yii::app()->name . '- Back Office Login';

$L = $this::$L;

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'login-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

<div class="widget">

    <div class="login-content">
        <div class="widget-content" style="padding-bottom:0;">
            <div class="popup_form_row">
                <?php echo $form->errorSummary($model); ?>
                <div class="clear">
                </div>
            </div>
            <form method="get" action="index.html" class="no-margin">
                <h3 class="form-title"><?=$L->g("Login to your account")?></h3>

                <fieldset>
                    <div class="form-group no-margin">
                        <?php echo $form->labelEx($model,'email'); ?>

                        <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <i class="icon-user"></i>
                                </span>
                            <?php echo $form->textField($model,'username',array('span'=>'txt_box','class'=>'form-control input-lg username','placeholder'=>$L->g("Your Email"))); ?>
                        </div>

                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'password'); ?>

                        <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <i class="icon-lock"></i>
                                </span>
                            <?php echo $form->passwordField($model,'password',array('span'=>'txt_box','class'=>'form-control input-lg password','placeholder'=>$L->g("Your Password")))?>
                        </div>

                    </div>
                </fieldset>
                <div class="form-actions">
                    <label class="checkbox">
                        <div class="checker"><span><input type="checkbox" value="1" name="remember" class="remember"></span></div> Remember me next time
                    </label>
                    <button class="btn btn-warning pull-right login_button" onclick="sweetCore.SetRememberMeInBackOfficeLogin()" type="submit">
                        Login <i class="m-icon-swapright m-icon-white"></i>
                    </button>
                    <!--<div class=""><a href="javascript:void(0);" class="forgot"><?/*=$L->g("Forgot Username or Password?")*/?></a></div>-->
                </div>


            </form>


        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
<script>
    jQuery(document).ready(function(){
        sweetCore.GetRememberMeInBackOfficeLogin();
    });
</script>



