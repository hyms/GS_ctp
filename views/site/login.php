<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Login';
?>

<div class="col-md-4 col-md-offset-4 text-center">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Html::tag('strong',$this->title,['class'=>'panel-title']); ?>
        </div>
        <div class="panel-body">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
            ]); ?>

            <?= $form->field($model, 'username') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe', [
                'template' => "<div class=\"col-md-offset-1 col-md-3\">{input}</div>\n<div class=\"col-md-8\">{error}</div>",
            ])->checkbox() ?>

            <div class="form-group">
                <div class="col-md-offset-1 col-md-11">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>