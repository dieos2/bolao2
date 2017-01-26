<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\Models\Confronto */

$this->title = 'Create Confronto';
$this->params['breadcrumbs'][] = ['label' => 'Confrontos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="confronto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
