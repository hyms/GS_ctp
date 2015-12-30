<?php
use kartik\widgets\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Html::tag('strong','Reportes',['class'=>'panel-title']); ?>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(['id'=>'form','method' => 'get'])?>
            <?= Html::hiddenInput('tipo',null,['id'=>'tipo']); ?>
            <div class="form-group">
                <?= Html::label('De:','fechaStart',array('class'=>'control-label')); ?>
                <?= DatePicker::widget([
                                           'name' => 'fechaStart',
                                           'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                           'language'=>'es',
                                           'value' => $fechaStart,
                                           'pluginOptions' => [
                                               'autoclose'=>true,
                                               'format' => 'yyyy-mm-dd'
                                           ]
                                       ]); ?>
            </div>
            <?php /*<div class="form-group">
                <?= Html::label('A:','fechaEnd',array('class'=>'control-label')); ?>
                <?= DatePicker::widget([
                                           'name' => 'fechaEnd',
                                           'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                           'language'=>'es',
                                           'value' => $fechaEnd,
                                           'pluginOptions' => [
                                               'autoclose'=>true,
                                               'format' => 'yyyy-mm-dd'
                                           ]
                                       ]); ?>
            </div>*/ ?>
            <div class="form-group">
                <?= Html::label('Cliente:','clienteNegocio',array('class'=>'control-label')); ?>
                <?= Html::textInput('clienteNegocio',$clienteNegocio,array('class'=>'form-control')); ?>
            </div>
            <div class="form-group">
                <?= Html::label('Responsable:','clienteResponsable',array('class'=>'control-label')); ?>
                <?= Html::textInput('clienteResponsable',$clienteResponsable,array('class'=>'form-control')); ?>
            </div>
            <div class="form-group">
                <?= Html::label('Factura:','factura',array('class'=>'control-label')); ?>
                <?= Html::dropDownList('factura',$factura,['S/Factura','C/Factura'],array('class'=>'form-control','prompt'=>'')); ?>
            </div>
            <?php ActiveForm::end(); ?>
            <h3>Generadores</h3>
            <?= Html::a('Reporte de Ventas','#',array('class'=>'btn btn-default btn-block','onclick'=>'report("v")')); ?>
            <?= Html::a('Reporte de Deudores','#',array('class'=>'btn btn-default btn-block','onclick'=>'report("d")')); ?>
            <?= Html::a('Reporte de Pagos de Deudores','#',array('class'=>'btn btn-default btn-block','onclick'=>'report("pd")')); ?>
            <?= Html::a('Reporte Impuestos','#',array('class'=>'btn btn-default btn-block','onclick'=>'report("im")')); ?>
        </div>
    </div>

<?php
    $script = <<<JS
function report(tipo)
	{
	    $("#tipo").val(tipo);
	    $("#form").submit();
	}
JS;
    $this->registerJs($script, \yii\web\View::POS_HEAD);