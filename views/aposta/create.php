<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\Models\Aposta */

$this->title = 'Create Aposta';
$this->params['breadcrumbs'][] = ['label' => 'Apostas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aposta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
