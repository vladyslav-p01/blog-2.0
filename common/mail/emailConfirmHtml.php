<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $userModel */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['site/confirm-email', 'confirmKey' => $userModel->confirm_key]);
?>
<div>
    <p>Hello <?= Html::encode($userModel->username) ?>,</p>

    <p>Follow the link below to confirm your email:</p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
</div>