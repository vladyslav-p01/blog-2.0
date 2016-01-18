<?php

/* @var $this yii\web\View */
/* @var $userModel common\models\User */
$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['site/confirm-email', 'confirmKey' => $userModel->confirm_key]);
?>
Hello <?= $userModel->username ?>,

Follow the link below to reset your password:

<?= $confirmLink ?>
