<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

    /* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Login';
?>

<div class="col-xs-6 col-xs-offset-3 text-center">
    <div class="panel panel-default">
        <div class="panel-heading"><h1 class="panel-title"><?= Html::encode($this->title) ?></h1></div>
        <div class="panel-body">

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-xs-8\">{input}</div>\n<div class=\"col-xs-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-xs-4 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'rememberMe', [
        'template' => "<div class=\"col-xs-offset-2 col-xs-4\">{input}</div>\n<div class=\"col-xs-8\">{error}</div>",
    ])->checkbox() ?>

    <div class="form-group">
        <div class="col-xs-12 text-center">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>