<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\Models\Pontos */

$this->title = 'Create Pontos';
$this->params['breadcrumbs'][] = ['label' => 'Pontos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pontos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
