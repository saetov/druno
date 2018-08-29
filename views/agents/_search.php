<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AgentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agents-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'xloc') ?>

    <?= $form->field($model, 'yloc') ?>

    <?php // echo $form->field($model, 'last_time') ?>

    <?php // echo $form->field($model, 'options') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
