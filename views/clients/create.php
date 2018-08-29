<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Clients */

$this->title = Yii::t('app', 'Добавить клиента');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Клиенты'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
