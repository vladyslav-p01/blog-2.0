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
            'id_post',
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


        ],
    ]) ?>

<p align="center"><b>Комментарии:</b></p>
    <?php

        $a = $model->comments;
    echo  Html::tag('div', ArrayToHtmlStr::convertWithActions(
        'div',
        'div',
        $model->comments
    )); ?>

</div>
