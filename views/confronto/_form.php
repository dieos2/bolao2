<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\Models\Confronto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="confronto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_grupo')->textInput() ?>

    <?= $form->field($model, 'id_time_casa')->textInput() ?>

    <?= $form->field($model, 'id_time_visitante')->textInput() ?>

    <?= $form->field($model, 'data')->textInput() ?>

    <?= $form->field($model, 'placar_casa')->textInput() ?>

    <?= $form->field($model, 'placar_visitante')->textInput() ?>

    <?= $form->field($model, 'vencedor')->textInput() ?>

    <?= $form->field($model, 'empate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
