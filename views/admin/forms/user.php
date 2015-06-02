<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\ArrayHelper;

    /* @var $this yii\web\View */
    /* @var $model app\models\Sucursal */
    /* @var $form ActiveForm */
?>
<div class="row">
    <?php $form = ActiveForm::begin(['id'=>'form']); ?>
    <div class="col-xs-6">
        <?= $form->field($model, 'username') ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'password')->passwordInput() ?>
    </div>
    <div class="col-xs-4">
        <?= $form->field($model, 'enable')->checkbox() ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'role')->dropDownList($model->getRole(),['prompt'=>''])->label('Rol'); ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'nombre') ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'apellido') ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'CI') ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'telefono') ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'salario') ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'email') ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($model, 'fk_idSucursal')->dropDownList(ArrayHelper::map(\app\models\Sucursal::find()->all(),'idSucursal','nombre'),['prompt'=>''])->label('Sucursal'); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>


