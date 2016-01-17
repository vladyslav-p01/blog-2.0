<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'username',
                'value' => function ($data) {
                    return $data->status === User::STATUS_DELETED ? $data->username . ' (deleted)' : $data->username;
                }
            ],
             'email:email',
             [
                 'attribute' => 'status',
                 'value' => function($data) {
                     return User::$textOfStatus[$data->status];
                 }
             ],
             'created_at:datetime',
             'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
