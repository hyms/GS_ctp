<?php
    use yii\bootstrap\ActiveForm;

    $form = ActiveForm::begin(['id'=>'form']);
?>
<?= $form->field($cajaChica,'observaciones')->textarea()->label('Detalle');; ?>
    <div class="row" >
        <div class="col-md-4" >
            <?= $form->field($cajaChica,'monto'); ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>