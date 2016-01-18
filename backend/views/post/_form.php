<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */

/* @var $categories */
/* @var $id */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'categories_ids')->dropDownList($categories,
        ['multiple' => true, 'size' => 5]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->widget(\yii\redactor\widgets\Redactor::className()) ?>

    <?php if (isset($post_id)): ?>
        <?= $form->field($model, 'post_id')->hiddenInput(['value' => $post_id]) ?>
    <?php endif ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
