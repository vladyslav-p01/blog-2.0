<?php
return [
    'name' => 'Vladyslav',
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

        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'imageAllowExtensions'=>['jpg','png','gif']
        ],

        'commentModule' => [
            'class' => 'frontend\modules\commentModule',
        ],
    ]

];
