<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Orders;
use yii\bootstrap\Button;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать заказ', ['/clients/index/'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
 			[
				'attribute'=>'client',
				'value'=>'client0.lastname',
			],
			[
				'attribute'=>'manager',
				'value'=>'manager0.firstname',
			],
			[
				'attribute'=>'options',
				'value'=>'options0.title',
			],
			'xloc',
			'yloc',
			'type',
			[
				'attribute'=>'agents',
				'value'=>function ($data) {
						if ($data->agents==null){
							return Html::a('Выбрать контрагента',['/agents/index','order'=>$data->id,'opt'=>$data->options]);
						} else {
							return $data->agents0->name;
						}
					},
				'format' => 'raw',
			],
			'cost',
			[
				'attribute'=>'confirm',
				'value'=>function ($data) {
						switch ($data->confirm){
							case 1: 
							return Button::widget([
								'label' => 'Заказ оплачен',
								'options' => [
									'class' => 'disabled btn-success',
									'style' => 'margin:5px'
								]
							]);
							break;
							case 0: 
								return Button::widget([
									'label' => 'Заказ в работе',
									'options' => [
										'class' => 'disabled btn-primary',
										'style' => 'margin:5px'
									], // add a style to overide some default bootstrap css
									'tagName' => 'div'
								]);
								break;
							case -1: 
								return Button::widget([
									'label' => 'Заказ отменен',
									'options' => [
										'class' => 'disabled btn-danger',
										'style' => 'margin:5px'
									]
								]); 
								break;
						}
					},
				'format'=>'raw',
			],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
