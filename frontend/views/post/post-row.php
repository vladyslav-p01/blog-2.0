<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.01.16
 * Time: 12:55
 */
/* @var $post common\models\Post*/
use yii\helpers\Html;
?>

<div>
    <p align="center"><b><?= Html::a($post->title, ['view', 'id' => $post->id_post])  ?></b></p>
    <div><?= $post->body ?></div>
    <div>
        <b>Categories:</b>
        <ul style="list-style-type: none">
            <?php foreach ($post->categories as $postCategory): ?>
            <li><?= $postCategory->name ?></li>
            <?php endforeach ?>
        </ul>
    </div>
    <p> <?= $post->attributeLabels()['author']. ': ' . $post->author->username ?></p>
</div>