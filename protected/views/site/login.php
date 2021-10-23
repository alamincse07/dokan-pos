<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
/**
 * @var $L Language
 */
$L = $this::$L;
$this->pageTitle=Yii::app()->name . '-Login';
$this->breadcrumbs=array(
	$L->g('Login'),
);
$baseUrl = Yii::app()->request->baseUrl;
?>

<form method="post" action="<?=$baseUrl?>/site/login" id="login-form">

<div class="login-content">
    <div style="padding-bottom:0;" class="widget-content">
        <div class="popup_form_row">
            <div style="display:none" class="errorSummary" id="login-form_es_"><p>Please fix the following input errors:</p>
                <ul><li>dummy</li></ul></div>                <div class="clear">
            </div>
        </div>

        <h3 class="form-title">Login to your account</h3>

        <fieldset>
            <div class="form-group no-margin">
                <label for="LoginForm_email">Name</label>
                <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <i class="icon-user"></i>
                                </span>
                    <input type="text" id="LoginForm_username" name="LoginForm[username]" placeholder="Your name" class="form-control input-lg username" span="txt_box">                        </div>

            </div>

            <div class="form-group">
                <label class="required" for="LoginForm_password">Password <span class="required">*</span></label>
                <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <i class="icon-lock"></i>
                                </span>
                    <input type="password" id="LoginForm_password" name="LoginForm[password]" placeholder="Your Password" class="form-control input-lg password" span="txt_box">                        </div>

            </div>
        </fieldset>
        <div class="form-actions">
            <label class="checkbox">
                <div class="checker"><span><input style="display: none" type="checkbox" class="remember" name="remember" value="1"></span></div>

            </label>
            <button type="submit" onclick="sweetCore.SetRememberMeInBackOfficeLogin()" class="btn btn-warning pull-right login_button">
                Login <i class="m-icon-swapright m-icon-white"></i>
            </button>
            <!--<div class=""><a href="javascript:void(0);" class="forgot"><?/*=$L->g("Forgot Username or Password?")*/?></a></div>-->
        </div>





    </div>
</div>

</form>