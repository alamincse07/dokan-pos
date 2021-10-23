<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $this->beginContent('application.views.layouts.admin-panels.header');
    $this->endContent();
    ?>
</head>


<body>
<div class="container">
    <div id="mainmenu">
        <?php

        $this->widget('zii.widgets.CMenu', array(
            'items'=>$this->menu,
            'htmlOptions'=>array('class'=>'operations1'),
        ));

        ?>
    </div><!-- sidebar -->
   <!-- --><?php
/*    $this->beginContent('application.views.layouts.admin-panels.body-header');
    $this->endContent();
    */?>
</div>


<div class="wrapper">
    <div id="mainmenu">
        <?php

        $this->widget('zii.widgets.CMenu', array(
            'items'=>$this->menu,
            'htmlOptions'=>array('class'=>'operations1'),
        ));

        ?>
    </div><!-- sidebar -->
    <div class="page-content">
        <?php
/*        $this->beginContent('application.views.layouts.admin-panels.header-content');
        $this->endContent();*/

        echo $content; ?>
    </div>
</div>



</body>
</html>-