<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AgentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Контрагенты';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="agents-index">
<? 
$this->title = 'Контрагенты';
$this->params['breadcrumbs'][] = $this->title;

?>
	<h1>Текущие расположение агентов на карте</h1>
	<h3>Карта | <?= Html::a('Список', ['list']) ?> </h3>

 <?	
	echo $map->display();
	foreach($test as $k){
		echo $k->name;
	};
?>
</div>

