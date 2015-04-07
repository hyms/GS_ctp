<?php

    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

    /* @var $this yii\web\View */
/* @var $model app\models\Sucursal */
/* @var $form ActiveForm */
?>
<div class="sucursal">
<div class="well well-sm">
    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

        <?= $form->field($model, 'codigoSucursal') ?>
        <?= $form->field($model, 'nombre') ?>
        <?= $form->field($model, 'descripcion') ?>
        <?= $form->field($model, 'enable') ?>
        <?= $form->field($model, 'central') ?>
        <?= $form->field($model, 'fk_idParent') ?>
        <?= $form->field($model, 'independiente') ?>
        <?= $form->field($model, 'gmap') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
</div><!-- sucursal -->
