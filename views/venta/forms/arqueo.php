<?php
    use kartik\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $arqueo->time=$fecha;
?>
    <div class="panel panel-default hidden-print">
        <div class="panel-heading">
            <span class="panel-title"><strong>Arqueo</strong></span>
        </div>
        <div class="panel-body" style="overflow: auto;">
            <?php $form = ActiveForm::begin(['id' => 'form']); ?>
            <?= $form->field($arqueo, 'monto')->label('Monto a Entregar'); ?>
            <?= $form->field($arqueo, 'observaciones')->label('Concepto')->textarea(); ?>
            <?= $form->field($arqueo, 'time')->hiddenInput()->label(false); ?>
            <div class="form-group">
                <div class="text-center">
                    <?= Html::a( Html::icon('floppy-disk').' Guardar', "#", ['class' => 'btn btn-success','onClick'=>'save()']); ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

<?php
    echo $this->render('@app/views/share/scripts/save');
    echo $this->render('@app/views/share/scripts/reset');