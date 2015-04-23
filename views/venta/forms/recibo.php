<h3 class="text-center"><?php echo ($recibo->tipoRecibo)?"Egreso":"Ingreso"; ?></h3>
<?php
    $form = \yii\bootstrap\ActiveForm::begin(['id'=>'form']);
?>
<div class="row" >
    <div class="col-xs-6">
        <?= $form->field($recibo,'nombre'); ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($recibo,'ciNit'); ?>
    </div>
</div>
<?= $form->field($recibo,'detalle')->textarea(); ?>
<div class="row" >
    <div class="col-xs-4" >
        <?= $form->field($recibo,'monto'); ?>
    </div>
    <div class="col-xs-4" >
        <?= $form->field($recibo,'acuenta'); ?>
    </div>
    <div class="col-xs-4" >
        <?= $form->field($recibo,'saldo'); ?>
    </div>
</div>

<?= \yii\helpers\Html::submitButton('Submit', ['class'=>'btn btn-sm btn-primary']) ?>
<?php \yii\bootstrap\ActiveForm::end(); ?>