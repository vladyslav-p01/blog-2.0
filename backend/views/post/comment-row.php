<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.01.16
 * Time: 13:21
 */
use yii\helpers\Html;

/* @var $comment \common\models\Comment*/
?>

<div class="comment-block">
    <div class="comment-body"><?= $comment->body ?></div>
    <?= $comment->attributeLabels()['author'] . ': ' . $comment->author->username ?>
    <?php if (Yii::$app->user->id === $comment->author_id): ?>
        <?= Html::a('edit', ['comment/update', 'id' => $comment->id_comment]) ?>
        <?= Html::a('delete', ['comment/delete', 'id' => $comment->id_comment]) ?>
    <?php endif ?>
<div>
