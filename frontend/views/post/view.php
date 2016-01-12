<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use common\components\ArrayToHtmlStr;
use frontend\assets\ViewPostAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_post], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_post], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Add a comment', ['comment/create', 'id' => $model->id_post], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
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
//            [
//                'attribute' => 'comments',
//                'format' => 'html',
//                'value' =>
//                // TODO add buttons for delete and update
//                    '<div><div style="border:1px solid red; /*width:100%*/ >" ' .
//                        implode(
//                            '</div><div>',
//                            ArrayHelper::getColumn($model->comments, 'body')
//                        ) .
//                    ' </div> </div>',
//            ]
            [
                'attribute' => 'comments',
                'format' => 'html',
                'value' => Html::tag('ul', ArrayToHtmlStr::convert(
                        'li',
                        ArrayHelper::map($model->comments, 'id_comment', 'body')
                    )),
            ]
        ],
    ]) ?>

</div>
