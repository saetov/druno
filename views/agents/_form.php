<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Agents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agents-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'type')->dropDownList([
    '0' => 'Стационарный',
    '1' => 'Мобильный']); ?>

	
    <?= $form->field($model, 'xloc')->textInput() ?>

    <?= $form->field($model, 'yloc')->textInput() ?>

    <?= $form->field($model, 'options')->textInput() ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
