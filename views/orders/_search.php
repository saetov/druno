<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'client') ?>

    <?= $form->field($model, 'manager') ?>

    <?= $form->field($model, 'options') ?>

    <?= $form->field($model, 'xloc') ?>

    <?php // echo $form->field($model, 'yloc') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'agents') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'confirm') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
