<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\Models\Time */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="time-form">

    <?php $form = ActiveForm::begin([
                'options' => ['enctype'=>'multipart/form-data']
            ]); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'escudo')->fileInput() ?>
  
    <?= $form->field($model, 'icon_mascote')->fileInput() ?>
 <?= $form->field($model, 'icon_mascote_i')->fileInput() ?>

    <?= $form->field($model, 'mascote')->fileInput() ?>

    <?= $form->field($model, 'cor_primaria')->textInput() ?>

    <?= $form->field($model, 'cor_secundaria')->textInput() ?>

   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
