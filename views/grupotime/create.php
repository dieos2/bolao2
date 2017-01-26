<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\Models\GrupoTime */

$this->title = 'Create Grupo Time';
$this->params['breadcrumbs'][] = ['label' => 'Grupo Times', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-time-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
