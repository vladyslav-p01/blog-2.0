<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => true

        ],


        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ]
    ],
    'modules' => [

//        'redactor' => [
//            'class' => 'yii\redactor\RedactorModule',
//            'uploadDir' => '@webroot/uploads',
//            'uploadUrl' => '@web/uploads',
//            'imageAllowExtensions'=>['jpg','png','gif']
//        ],

        'commentModule' => [
            'class' => 'frontend\modules\commentModule',
        ],
    ]

];
