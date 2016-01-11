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
        ]
    ],
    'modules' => [
        'redactor' => 'yii\redactor\RedactorModule',
        'uploadDir' => '@webroot/uploads',
        'uploadUrl' => '@web/uploads',
        'imageAllowExtensions'=>['jpg','png','gif']
    ]
];
