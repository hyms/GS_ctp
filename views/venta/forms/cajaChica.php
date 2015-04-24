<?php
    $form = \yii\bootstrap\ActiveForm::begin(['id'=>'form']);
?>
    <?= $form->field($cajaChica,'observaciones',['label'=>'Detalle'])->textarea(); ?>
    <div class="row" >
        <div class="col-xs-4" >
            <?= $form->field($cajaChica,'monto'); ?>
        </div>
    </div>

<?= \yii\helpers\Html::submitButton('Submit', ['class'=>'btn btn-sm btn-primary']) ?>
<?php \yii\bootstrap\ActiveForm::end(); ?>