<?php
/**
 * Author: Sabbir
 * Script: UrlRules.php
 */

class UrlRules {

    public function getUrlRules(){
        return array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
            'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'transaction'=>'customerTransaction/admin'
            ),
        );
    }

} 