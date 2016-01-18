<?php

use yii\helpers\Html;
use \yii\widgets\ListView;
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

    <?php if (!Yii::$app->user->isGuest): ?>
    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif ?>

<?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => function ($post) {
            return $this->render('post-row',
                [
                    'post' => $post
                ]);
        }
    ]) ?>

</div>
