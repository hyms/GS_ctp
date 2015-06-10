<?php
    use kartik\widgets\DatePicker;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Reportes de Venta</strong></h3>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(['id'=>'form'])?>
            <?= Html::hiddenInput('tipo',null,['id'=>'tipo']); ?>
            <div class="form-group">
                <?= Html::label('Sucursal:','sucursal',array('class'=>'control-label')); ?>
                <?= Html::dropDownList(
                    'sucursal',
                    $sucursal,
                    \yii\helpers\ArrayHelper::map(\app\models\Sucursal::find()->all(),'idSucursal','nombre'),
                    array('class'=>'form-control','prompt'=>'Selecciona Sucursal')
                );
                ?>
            </div>
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
            <div class="form-group">
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
            </div>
            <div class="form-group">
                <?= Html::label('Formato:','formato',array('class'=>'control-label')); ?>
                <?= Html::dropDownList(
                    'formato',
                    $formato,
                    \yii\helpers\ArrayHelper::map(\app\models\Producto::find()->where(['toSell'=>true])->all(),'idProducto','formato'),
                    array('class'=>'form-control','prompt'=>'Selecciona formato')
                );
                ?>
            </div>
            <?php ActiveForm::end(); ?>
            <h3>Generadores</h3>
            <?= Html::a('Movimiento de Placas','#',array('class'=>'list-group-item','onclick'=>'report("a")')); ?>
            <?= Html::a('Movimiento por Formato','#',array('class'=>'list-group-item','onclick'=>'report("f")')); ?>
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