<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    $this->title = 'Crear Cliente';
?>
<div class="row">

    <?php $form = ActiveForm::begin(['id'=>'form']); ?>
    <?= Html::tag('div',
                  $form->field($model, 'nombreCompleto')->textInput(['maxlength' => 100]),
                  ['class'=>'col-md-6']); ?>
    <?= Html::tag('div',
                  $form->field($model, 'nombreNegocio')->textInput(['maxlength' => 100]),
                  ['class'=>'col-md-6']); ?>
    <?= Html::tag('div',
                  $form->field($model, 'nombreResponsable')->textInput(['maxlength' => 100]),
                  ['class'=>'col-md-6']); ?>
    <?= Html::tag('div',
                  $form->field($model, 'nitCi')->textInput(['maxlength' => 20]),
                  ['class'=>'col-md-6']); ?>
    <?= Html::tag('div',
                  $form->field($model, 'correo')->textInput(['maxlength' => 150]),
                  ['class'=>'col-md-6']); ?>
    <?= Html::tag('div',
                  $form->field($model, 'direccion')->textInput(['maxlength' => 150]),
                  ['class'=>'col-md-6']); ?>
    <?= Html::tag('div',
                  $form->field($model, 'telefono')->textInput(['maxlength' => 30]),
                  ['class'=>'col-md-4']); ?>
    <?= Html::tag('div',
                  $form->field($model, 'codigoCliente')->textInput(['maxlength' => 45]),
                  ['class'=>'col-md-4']); ?>
    <?php ActiveForm::end(); ?>

</div>
