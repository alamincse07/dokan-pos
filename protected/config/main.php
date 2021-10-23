<?php

require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../config/Config.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../config/UrlRules.php';

#url rules
$UrlRules = new UrlRules();

#Config
$Config = new Config();

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>$Config->projectName,
    'defaultController'=>'site',

	// preloading 'log' component
	'preload'=>array('log'),

    'timeZone' => $Config->timeZone,

	// autoloading model and component classes
	'import'=>$Config->import(),

	'modules'=>$Config->modules(),

	// application components
	'components'=>array(
		'user'=>$Config->userComponent(),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>$UrlRules->getUrlRules(),

		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database

		'db'=>$Config->getDBConfig(),

        'assetManager' => $Config->getAssetManager(),

		'errorHandler'=>$Config->getErrorHandler(),
		'log'=>$Config->getLogSetup(),
        'widgetFactory'=>array(
            'widgets'=>array(
                'CLinkPager'=>array(
                    'maxButtonCount'=>5,
                ),
                'CGridView'=>array(
                   // 'cssFile' => '/css/style-gridviewcustom.css',
                ),
            ),
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>$Config->getParams(),
);