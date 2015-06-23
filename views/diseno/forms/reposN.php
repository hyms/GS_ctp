<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

?>
<div class="col-xs-3">
    <div class="panel panel-default">
        <div class="panel-body">
            <?= $this->render('optionRepos',['tipo'=>$tipo]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <strong class="panel-title">Productos</strong>
        </div>
        <?= $this->render('../tables/producto',['producto'=>$producto,'tipo'=>2])?>
    </div>
</div>

<div class="col-xs-9">
    <div class="well well-sm">
        <h4 class="text-center"><strong>Nueva Reposicion</strong></h4>
        <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'form']); ?>
        <div class="row">
            <div class="col-xs-6">
                <?=
                $form->field($orden, 'tipoRepos', ['template' => '<div class="col-xs-6">{label}</div><div class="col-xs-6">{input}{error}{hint}</div>'])
                    ->dropDownList(\app\components\SGOperation::tiposReposicion(),['prompt'=>'Seleccione el Error'])
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
                <?= Html::a('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar', "#", array('class' => 'btn btn-default hidden-print','id'=>'save')); ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
$script = <<<JS
function select(val,url)
{
    if(val!="")
        document.location.href = url+'?'+'tipo='+val;
}
JS;
$this->registerJs($script, \yii\web\View::POS_HEAD);
?>
<?= $this->render('../scripts/save') ?>
<?= $this->render('../scripts/reset') ?>
