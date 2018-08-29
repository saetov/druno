<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AgentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контрагенты';
$this->params['breadcrumbs'][] = $this->title;
$this->params['order']=$order;
?>
<div class="agents-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Добавить контрагента', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<h3>Показаны агенты, подходящие условиям заказа</h3>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
				'attribute'=>'type',
				'value'=>function($data){
					return $data->type==0 ? "Стационарный" : "Мобильный";
				}
			],
            'xloc',
            'yloc',
            // 'last_time',
            //'options',
            'phone',
			'distance',
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{next}',
				'buttons' => [
					'next' => function ($url,$model) {
							return Html::a
							(Yii::t('app', 'Выбрать контрагента'), 
								[
								'orders/update',
								'id' => $this->params['order'],
								'agents'=>$model->id
								], 
							['class' => 'btn btn-success']);
					},
				],
			],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
