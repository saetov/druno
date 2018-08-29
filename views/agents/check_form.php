<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Options;

/* @var $this yii\web\View */
/* @var $model app\models\Agents */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Перечень предоставляемых услуг';
$this->params['breadcrumbs'][] = $this->title;
?>

  
<div class="check-form">
  <h1><?= Html::encode($this->title.": ") ?><u><?= Html::encode($model->name)?></u></h1>
  
    <?php 
	$form = ActiveForm::begin([
	'options' => [
                'class' => 'form-horizontal',
             ]
	]);	
	//$a='o1';
	//print $model->{$a};
	
	$list=[];
	$separator='----';
	foreach(Options::getRootsList() as $root){
		echo '<div class="col-xs-2">';
		if($root->children){
			echo "<h3><u>".$root->title."</u></h3>";
			foreach($root->children as $one){
				if($one->children){
					echo "<p><b>".$one->title."</b>";
					$list=[];
					foreach($one->children as $two){
						echo $form->field($model,'o'.$two->id,['options'=>['style'=>'margin-bottom:0px;']])->checkbox([
							'label' => $two->title,
							'labelOptions' => [
								'style' => 'padding-left:20px; margin-bottom:0px;'
							]
						]);
					}
				} else {
					echo $form->field($model,'o'.$one->id)->checkbox([
						'label' => $one->title,
						'labelOptions' => [
								'style' => 'padding-left:20px;'
							]
					]);
				}
				echo "<hr/>";
			}
		} else {
			echo $form->field($model,'o'.$root->id)->checkbox([
				'label' => $root->title,
				'labelOptions' => [
								'style' => 'padding-left:0px;'
							]
			]);
		}
		echo "</div>";
	} 


	
	?>

    <div class="form-group">
		<div class="col-xs-10">
        <?= Html::submitButton('Обновить', ['class' =>  'btn btn-success']) ?>
		</div>
    </div>

    <?php ActiveForm::end(); ?>
	<?
	//echo $form->field($model, 'options')->checkboxList($list,['separator'=>'<br>']);
	var_dump($items);
	echo "<br>";
	//var_dump($model);
	//echo "<br>".unserialize($model->options);
	?>
</div>
