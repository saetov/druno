<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Agents */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Контрагенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agents-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p> <? if (isset($model->user_id)==false){
		echo Html::encode("Не забудте привязать профиль сервиса с профилем реального человека.");
	}?>
    <p>    <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить контрагента?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'type',
            'xloc',
            'yloc',
            'last_time',
            'options',
            'phone',
        ],
    ]) ?>

</div>
