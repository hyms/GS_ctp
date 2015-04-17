<?php
    $form = \yii\bootstrap\ActiveForm::begin(['id'=>'form']);
?>
    <?= $form->field($recibo,'observaciones',['label'=>'Detalle'])->textarea(); ?>
    <div class="row" >
        <div class="col-xs-4" >
            <?= $form->field($recibo,'monto'); ?>
        </div>
    </div>

<?= \yii\helpers\Html::submitButton('Submit', ['class'=>'btn btn-sm btn-primary']) ?>
<?php \yii\bootstrap\ActiveForm::end(); ?>