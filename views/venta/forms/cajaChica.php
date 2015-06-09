<?php
$form = \yii\bootstrap\ActiveForm::begin(['id'=>'form']);
?>
<?= $form->field($cajaChica,'observaciones')->textarea()->label('Detalle');; ?>
    <div class="row" >
        <div class="col-xs-4" >
            <?= $form->field($cajaChica,'monto'); ?>
        </div>
    </div>
<?php \yii\bootstrap\ActiveForm::end(); ?>