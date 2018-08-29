<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Managers;
use app\models\Clients;
use app\models\Options;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">
    <?php $form = ActiveForm::begin(); ?>
	
    <? if (isset($cl)==1){?>
	<label class="control-label">Клиент</label>
	<div class="help-block"></div>
	<? echo $cl;} ?>
	<?= $form->field($model, 'client')->hiddenInput()->label(false);	?>

    <?php $managers = Managers::find()->all();
		// формируем массив, с ключем равным полю 'id' и значением равным полю 'name' 
		$items = ArrayHelper::map($managers,'id','firstname');
		$params = [
			'prompt' => 'Укажите кто принял звонок'
		];
		echo $form->field($model, 'manager')->dropDownList($items,$params);
	?>
	
	<?php
		$items=Options::getDropDown();
		$params = [
			'prompt' => 'Выберите тип проблемы'
		];
		echo $form->field($model, 'options')->dropDownList($items,$params);
	?>

    <!--$form->field($model, 'options')->textInput()-->

    <?= $form->field($model, 'xloc')->textInput() ?>

    <?= $form->field($model, 'yloc')->textInput() ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cost')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
