<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="producto">

    <?php $form = ActiveForm::begin(['id' => 'form']); ?>
    <div class="col-md-6"><?= $form->field($model, 'codigo')->textInput(['maxlength' => 50]) ?></div>
    <div class="col-md-6"><?= $form->field($model, 'codigoPersonalizado')->textInput(['maxlength' => 50]) ?></div>
    <div class="col-md-6"><?= $form->field($model, 'material')->textInput(['maxlength' => 50]) ?></div>
    <div class="col-md-6"><?= $form->field($model, 'formato')->textInput(['maxlength' => 50]) ?></div>
    <div class="col-md-6"><?= $form->field($model, 'dimension')->textInput(['maxlength' => 200]) ?></div>
    <div class="col-md-6"><?= $form->field($model, 'cantidadPaquete')->textInput() ?></div>
    <div class="form-group">
        <div class="text-center">
            <?= Html::resetButton('Cancel', ['class' => 'btn btn-danger']) ?>
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>