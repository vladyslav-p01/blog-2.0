<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $dataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (Yii::$app->user->can('updatePost')): ?>
            <?= Html::a('Update', ['update', 'id' => $model->id_post], ['class' => 'btn btn-primary']) ?>
        <?php endif ?>
        <?php if (Yii::$app->user->can('deletePost')): ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id_post], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('Undo deleting', ['undo-delete', 'id' => $model->id_post], ['class' => 'btn btn-primary']) ?>
        <?php endif ?>
        <?= Html::a('Add a comment', ['comment/create', 'id' => $model->id_post], ['class' => 'btn btn-success']) ?>
        <?php if (Yii::$app->user->can('deleteHardPost')): ?>
        <?= Html::a('Delete hard', ['delete-hard', 'id' => $model->id_post], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php endif ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_post',
            [
                'attribute' => 'title',
                'value' => $model->deleted ? $model->title . ' (deleted)' : $model->title,
            ],
            'body:html',
            [
                'attribute' => 'changed',
                'format' => 'datetime',
                'value' => $model->updated_at ? $model->updated_at : $model->created_at,
            ],
            [
                'attribute' => 'author',
                'value' => $model->author->username,
            ],
            [
                'attribute' => 'categories',
                'format' => 'html',
                'value' => '<ul><li>' . implode(
                    '</li><li>',
                    ArrayHelper::getColumn($model->categories, 'name')
                ) . '</li></ul>',
            ],


        ],
    ]) ?>

    <p align="center"><b>Комментарии:</b></p>

    <?php if (count($dataProvider->getModels()) != 0): ?>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => function ($comment) {
                return $this->render('comment-row',
                    [
                        'comment' => $comment,
                    ]);
            }
        ]) ?>
    <?php else: echo 'No comments yet'?>
    <?php endif ?>

</div>
