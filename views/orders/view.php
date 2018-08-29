<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Orders;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить заказ', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить заказ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот заказ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
 			[
				'attribute'=>'client',
				'value'=>$model->client0->firstname.' '.$model->client0->lastname,
			],
			[
				'attribute'=>'manager',
				'value'=> (isset($model->manager0->firstname) ? $model->manager0->firstname : "Не назначен"),
			],
            [
				'attribute'=>'options',
				'value'=>(isset($model->options0->title) ? $model->options0->title : "Не выбрано"),
			],
            'xloc',
            'yloc',
            'type',
            [
				'attribute'=>'agents',
				'value'=> (isset($model->agents0->name) ? $model->agents0->name : "Не назначен"),
			],
            'cost',
            'confirm',
        ],
    ]) ?>

</div>
