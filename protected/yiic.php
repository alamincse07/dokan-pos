<?php

// change the following paths if necessary
$yiic=dirname(__FILE__).'/../../framework/yiic.php';
$config=dirname(__FILE__).'/config/console.php';

require_once($yiic);

class Yii extends YiiBase
{
    /**
     * @static
     * @return CWebApplication
     */
    public static function app()
    {
        return parent::app();
    }
}