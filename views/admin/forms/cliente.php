<?php
    use app\models\Sucursal;
    use kartik\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;

?>
<div class="row">
    <?php $form = ActiveForm::begin(['id'=>'form']); ?>
    <?= Html::tag('div',
        $form->field($model, 'nombreCompleto'),
        ['class'=>'col-md-6']);?>
    <?= Html::tag('div',
        $form->field($model, 'nombreNegocio'),
        ['class'=>'col-md-6']);?>
    <?= Html::tag('div',
        $form->field($model, 'nombreResponsable'),
        ['class'=>'col-md-6']);?>
    <?= Html::tag('div',
        $form->field($model, 'nitCi'),
        ['class'=>'col-md-6']);?>
    <?= Html::tag('div',
        $form->field($model, 'correo'),
        ['class'=>'col-md-6']);?>
    <?= Html::tag('div',
        $form->field($model, 'direccion'),
        ['class'=>'col-md-6']);?>
    <?= Html::tag('div',
        $form->field($model, 'telefono'),
        ['class'=>'col-md-4']);?>
    <?= Html::tag('div',
        $form->field($model, 'codigoCliente')->label('Categoria'),
        ['class'=>'col-md-4']);?>
    <?= Html::tag('div',
        $form->field($model, 'enable')->checkbox(),
        ['class'=>'col-md-4']);?>
    <?= Html::tag('div',
        $form->field($model, 'fk_idSucursal')
            ->dropDownList(ArrayHelper::map(Sucursal::find()->all(),'idSucursal','nombre'),['prompt'=>''])->label('Sucursal'),
        ['class'=>'col-md-4']);?>

    <?php ActiveForm::end(); ?>
</div>
