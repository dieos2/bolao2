<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\Models\Pontos */

$this->title = 'Update Pontos: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pontos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pontos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
