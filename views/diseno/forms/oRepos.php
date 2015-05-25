<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

?>
<?php $form = ActiveForm::begin(
    ['layout' => 'horizontal','id'=>'form','action'=>\yii\helpers\Url::to(['diseno/repociciones','tipo'=>$tipo])]
); ?>
<?= Html::hiddenInput('idParent',$idParent) ?>
<div class="row">
    <div class="col-xs-6">
        <?=
            $form->field($orden, 'tipoRepos', ['template' => '<div class="col-xs-6">{label}</div><div class="col-xs-6">{input}{error}{hint}</div>'])
                ->dropDownList(\app\components\SGOperation::tiposReposicion(),['prompt'=>'Seleccione el Error'])
                ->label("Tipo_Error")
        ?>
    </div>
    <div class="col-xs-6">
        <?= $form->field($orden, 'responsable',['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}{hint}</div>'])->textInput(['maxlength' => 50]) ?>
    </div>

</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Datos de Orden</strong>
    </div>
    <div style="overflow: auto">
        <?= $this->render('detalleOrden',['detalle'=>$detalle,'orden'=>$orden]);?>
    </div>
</div>
<?= $form->field($orden, 'observaciones')->textArea(); ?>
<div class="form-group">
    <div class="text-center">
        <div class="form-group">
            <div class="text-center">
                <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-default hidden-print','id'=>'reset')); ?>
                <?= Html::a('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar', "#", array('class' => 'btn btn-default hidden-print','id'=>'save')); ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?= $this->render('../scripts/save') ?>
<?= $this->render('../scripts/reset') ?>

