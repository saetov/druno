<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

 
$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
	<h1><?= Html::encode($this->title) ?></h1>
	<p>Пожалуйста заполните форму для регистрации</p>
	<div class="row">
		<div class="col-lg-5">
 
			<?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
				<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
				<?= $form->field($model, 'email') ?>
				<?= $form->field($model, 'password')->passwordInput() ?>
				<?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className(),
					['siteKey' =>'6LcQ1xYUAAAAAGj3hbePLl75U-Yt0oUkLH38rT-z']) ?>
	
				<div class="form-group">
					<?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
				</div>
			<?php ActiveForm::end(); ?>
 
		</div>
	</div>
</div>