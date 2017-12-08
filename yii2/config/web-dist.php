<?php
$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

return [
    'id' => 'aplicationsbasichandler',
    'language' => 'el', //Make the change in web.php too
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '7pxHdwfYrefgysiSxJu7AwRjVpc5XtLg',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => require(__DIR__ . '/log.php'),
        'db' => $db,
        'crypt' => [
            'class' => 'app\components\Crypt',
            'cryptKeyFile' => $params['crypt-key-file']
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => 'yourSiteKey',
            'secret' => 'yourSecretKey',
        ],
    /*
      'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
      ],
      ],
     */
    ],
    'params' => $params,
];
