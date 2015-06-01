<?php

    use yii\widgets\ActiveForm;

    /* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = 'Crear Cliente';
?>
<div class="row">

    <?php $form = ActiveForm::begin(['id'=>'form']); ?>
    <div class="col-xs-6"><?= $form->field($model, 'nombreCompleto')->textInput(['maxlength' => 100]) ?></div>
    <div class="col-xs-6"><?= $form->field($model, 'nombreNegocio')->textInput(['maxlength' => 100]) ?></div>
    <div class="col-xs-6"><?= $form->field($model, 'nombreResponsable')->textInput(['maxlength' => 100]) ?></div>
    <div class="col-xs-6"><?= $form->field($model, 'nitCi')->textInput(['maxlength' => 20]) ?></div>
    <div class="col-xs-6"><?= $form->field($model, 'correo')->textInput(['maxlength' => 150]) ?></div>
    <div class="col-xs-6"><?= $form->field($model, 'direccion')->textInput(['maxlength' => 150]) ?></div>
    <div class="col-xs-4"><?= $form->field($model, 'telefono')->textInput(['maxlength' => 30]) ?></div>
    <div class="col-xs-4"><?= $form->field($model, 'codigoCliente')->textInput(['maxlength' => 45]) ?></div>
    <?php ActiveForm::end(); ?>

</div>
