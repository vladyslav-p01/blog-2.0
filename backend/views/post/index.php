<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel */
/* @var $categories */

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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id_post',
            [
                'attribute' => 'category_id',
                'format' => 'html',
                'value' => function ($data) {
                    $string = '<ul>';
                    foreach ($data->categories as $category) {
                        $string .= '<li>' . $category->name . '</li>';
                    }
                    $string .= '</ul>';
                    return $string;

                }
            ],
            [
                'attribute' => 'title',
                'value' => function($data) {
                    return $data->deleted == 1 ?
                        $data->title . ' (deleted)' : $data->title;
                }
            ],
            'body',
            [
                'attribute' => 'Changed',
                'format' => 'dateTime',
                'value' => function($data) {
                    return $data->updated_at === null ? $data->created_at : $data->updated_at;
                }

            ],
            [
                'attribute' => 'author',
                'value' => function($date) {
                    return $date->author->username;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
