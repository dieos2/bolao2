<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\Models\Aposta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aposta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_confronto')->textInput() ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'data')->textInput() ?>

    <?= $form->field($model, 'placar_casa')->textInput() ?>

    <?= $form->field($model, 'placar_visitante')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
