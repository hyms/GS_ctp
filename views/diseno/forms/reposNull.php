<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

?>
<div class="col-xs-9">
    <div class="well well-sm">
        <h4 class="text-center"><strong>Reposicion</strong></h4>
        <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'form']); ?>
        <div class="row">
            <div class="col-xs-6">
                <?=
                $form->field($orden, 'tipoRepos', ['template' => '<div class="col-xs-6">{label}</div><div class="col-xs-6">{input}{error}{hint}</div>'])
                    ->dropDownList(\app\components\SGOperation::tiposReposicion(),['prompt'=>'Seleccione la Falla'])
                    ->label("Tipo_Falla")
                ?>
            </div>
            <div class="col-xs-6">
                <?= $form->field($orden, 'attribuible',['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}{hint}</div>'])->textInput(['maxlength' => 50])->label('Atribuible') ?>
            </div>
            <div class="col-xs-6">
                <?= $form->field($orden, 'responsable', ['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}{hint}</div>'])->textInput(['maxlength' => 50]) ?>
            </div>
            <div class="col-xs-6">
                <?= $form->field($orden, 'codDependiente', ['template' => '<div class="col-xs-6">{label}</div><div class="col-xs-6">{input}{error}{hint}</div>'])->label('Correlativo'); ?>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong class="panel-title">Detalle de Orden</strong>
            </div>
            <div style="overflow: auto">
                <?= $this->render('detalleOrden',array('detalle'=>$detalle,'orden'=>$orden));?>
            </div>
        </div>
        <?= $form->field($orden, 'observaciones')->textArea(); ?>
        <div class="form-group">
            <div class="text-center">
                <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-default hidden-print','id'=>'reset')); ?>
                <?= Html::a('<span class="glyphicon glyphicon-floppy-disk"></span> Anular', "#", array('class' => 'btn btn-danger hidden-print','id'=>'save')); ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?= $this->render('../scripts/save') ?>
<?= $this->render('../scripts/reset') ?>
