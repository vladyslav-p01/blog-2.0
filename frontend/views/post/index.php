<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'body',
            [
                'attribute' => 'Changed',
                'format' => 'dateTime',
                'value' => function($data) {
                    return $data->updated_at === null ? $data->created_at : $data->updated_at;
                }

            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
