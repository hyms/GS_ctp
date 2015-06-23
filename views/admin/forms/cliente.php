<?php
    use app\models\Sucursal;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;

    $this->title = 'Crear Cliente';
?>

    <?php $form = ActiveForm::begin(['id'=>'form']); ?>
    <div class="row">
        <div class="col-xs-6"><?= $form->field($model, 'nombreCompleto')->textInput(['maxlength' => 100]) ?></div>
        <div class="col-xs-6"><?= $form->field($model, 'nombreNegocio')->textInput(['maxlength' => 100]) ?></div>
    </div>
    <div class="row">
        <div class="col-xs-6"><?= $form->field($model, 'nombreResponsable')->textInput(['maxlength' => 100]) ?></div>
        <div class="col-xs-6"><?= $form->field($model, 'nitCi')->textInput(['maxlength' => 20]) ?></div>
    </div>
    <div class="row">
        <div class="col-xs-6"><?= $form->field($model, 'correo')->textInput(['maxlength' => 150]) ?></div>
        <div class="col-xs-6"><?= $form->field($model, 'direccion')->textInput(['maxlength' => 150]) ?></div>
    </div>
    <div class="row">
        <div class="col-xs-4"><?= $form->field($model, 'telefono')->textInput(['maxlength' => 30]) ?></div>
        <div class="col-xs-4"><?= $form->field($model, 'codigoCliente')->textInput(['maxlength' => 45]) ?></div>
    </div>
    <div class="row">
        <div class="col-xs-4"><?= $form->field($model, 'enable')->checkbox() ?></div>
        <div class="col-xs-4"><?= $form->field($model, 'fk_idSucursal')
                ->dropDownList(ArrayHelper::map(Sucursal::find()->all(),'idSucursal','nombre'),['prompt'=>''])->label('Sucursal') ?></div>
    </div>
    <?php ActiveForm::end(); ?>

