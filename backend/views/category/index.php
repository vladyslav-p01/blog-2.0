<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\widgets\Menu;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
\backend\assets\MenuAsset::register($this);
?>


<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'value' => function ($data) {
                    return $data->deleted == 1 ? $data->name . ' (deleted)' : $data->name;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
