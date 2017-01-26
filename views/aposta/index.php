<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Apostas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aposta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Aposta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_confronto',
            'id_user',
            'data',
            'placar_casa',
            // 'placar_visitante',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
