<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="producto">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($producto, 'codigo') ?>
    <?= $form->field($producto, 'codigoPersonalizado') ?>
    <?= $form->field($producto, 'material') ?>
    <?= $form->field($producto, 'familia') ?>
    <?= $form->field($producto, 'color') ?>
    <?= $form->field($producto, 'marca') ?>
    <?= $form->field($producto, 'nota') ?>
    <?= $form->field($producto, 'cantidadPaquete') ?>
    <?= $form->field($producto, 'descripcion') ?>

    <div class="form-group">
        <div class="text-center">
        <?= Html::resetButton('Cancel', ['class' => 'btn btn-danger']) ?>
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>