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
    </div>
<?php \yii\bootstrap\ActiveForm::end(); ?>