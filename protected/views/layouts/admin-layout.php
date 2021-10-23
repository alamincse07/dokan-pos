<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    //Generic::_setTrace($_GET);
    $this->beginContent('application.views.layouts.admin-panels.header');
    $this->endContent();
    ?>

</head>


<body>
<div class="container">
    <?php
    $this->beginContent('application.views.layouts.admin-panels.body-header');
    $this->endContent();
    ?>


</div>


<div class="wrapper">
    <?php
    $this->beginContent('application.views.layouts.admin-panels.left-nav');
    $this->endContent();
    ?>
    <div class="page-content">
      <div class="content container">
        <?php
        if (Yii::app()->user->hasFlash('success'))
        {
            echo' <div class="col-lg-12">
                     <div class="alert alert-success alert-block fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert"> <i class="icon-remove"></i> </button>
                        <h4> <i class="icon-ok-sign"></i> Success! </h4>
                        <p>'. Yii::app()->user->getFlash('success').'</p>
                      </div>

                  </div>';

        }
        /*$this->beginContent('application.views.layouts.admin-panels.header-content');
        $this->endContent();*/
       /*if(isset($this->breadcrumbs)):
           $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>$this->breadcrumbs,
            ));//<!-- breadcrumbs -->
     endif;*/
        echo $content; ?>
      </div>
    </div>
</div>


<!--<div class="bottom-nav footer"> 2014 &copy; Thin Admin by Riaxe Systems. </div>-->



</body>
</html>