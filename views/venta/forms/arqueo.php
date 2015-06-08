<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$arqueo->time=$fecha;
if($dia!=date("d")) {
?>
<div class="panel panel-default hidden-print">
    <div class="panel-heading">
        <span class="panel-title"><strong>Arqueo</strong></span>
    </div>
    <div class="panel-body" style="overflow: auto;">
        <?php $form = ActiveForm::begin(['id'=>'form']); ?>
            <?= $form->field($arqueo, 'monto')->label('Monto a Entregar'); ?>
            <?= $form->field($arqueo, 'time')->hiddenInput()->label(false); ?>
            <?= Html::submitButton('Continuar', array('class' => 'btn btn-default col-xs-offset-1')); ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php } ?>