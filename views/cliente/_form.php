<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    /* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_idTipoCliente')->textInput() ?>

    <?= $form->field($model, 'nombreCompleto')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'nombreNegocio')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'nombreResponsable')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'correo')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'fechaRegistro')->textInput() ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'nitCi')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'codigoCliente')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'enable')->textInput() ?>

    <?= $form->field($model, 'fk_idSucursal')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
