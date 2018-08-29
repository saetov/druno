<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\bootstrap\Button;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Клиенты');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить нового клиента'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
				'attribute'=>'firstname',
				'label'=>'Фамилия'
			],
			[
				'attribute'=>'lastname',
				'label'=>'Имя'
			],
			[
				'attribute'=>'parentname',
				'label'=>'Отчество'
			],
            [
				'attribute'=>'phone',
				'label'=>'Телефон'
			],
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{next}',
				'buttons' => [
					'next' => function ($url,$model) {
						return Html::a(Yii::t('app', 'Создать заказ'), ['orders/create', 'client'=>$model->id], ['class' => 'btn btn-success']);
					},
				],
			],
			['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
