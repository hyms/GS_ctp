<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\ArrayHelper;

?>
<div class="row">
    <?php $form = ActiveForm::begin(['id'=>'form']); ?>

    <div class="col-xs-6">
        <?= $form->field($model, 'codigoSucursal') ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'nombre') ?>
    </div>
    <div class="col-xs-12">
        <?= $form->field($model, 'descripcion')->textarea() ?>
    </div>
    <div class="col-xs-4">
        <?= $form->field($model, 'enable')->checkbox() ?>
    </div>
    <div class="col-xs-4">
        <?= $form->field($model, 'central')->checkbox() ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'fk_idParent')->dropDownList(ArrayHelper::map(($model->isNewRecord)?\app\models\Sucursal::find()->all():\app\models\Sucursal::find()->where(['!=','idSucursal',$model->idSucursal])->all(),'idSucursal','nombre'),['prompt'=>''])->label('Depende de'); ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'gmap') ?>
    </div>

    <?php ActiveForm::end(); ?>
</div><!-- sucursal -->
