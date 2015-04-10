<?php
    use kartik\widgets\DatePicker;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    use yii\helpers\Url;

?>

<div class="row">
    <div class="col-xs-5">
        <div class="panel panel-default">
            <div class="panel-heading"><strong class="panel-title">Clientes</strong></div>
            <?= $this->render('cliente',['cliente'=>$clientes,'search'=>$search,'idOrdenCTP'=>$orden->idOrdenCTP]) ?>
        </div>

    </div>
    <div class="col-xs-7">
        <div class="well well-sm">
            <div class = "row">
                <h4 class="col-xs-4"><strong>Orden de Trabajo</strong></h4>
                <h4 class="col-xs-4 text-center"><strong><?php echo $orden->correlativo;?></strong></h4>
                <h4 class="col-xs-4 text-right"><strong><?php echo date("d/m/Y",strtotime($orden->fechaCobro));?></strong></h4>
            </div>


            <?php
            $form = ActiveForm::begin(['id'=>'form']);
            ?>
            <div class="row">
                <div class="col-xs-8">
                    <?= Html::label('Cliente','cliente')?>
                    <?= Html::input('','cliente',null,['class'=>'form-control','id'=>'cliente']) ?>
                    <?= Html::hiddenInput('tipoCliente',null,['class'=>'form-control','id'=>'tipoCliente']) ?>
                </div>
                <div class="col-xs-4">
                    <?= $form->field($orden,'tipoPago')->radioList(['Con Factura','Sin Factura'],['onchange'=>'radio();']); ?>
                </div>

            </div>

            <div class="row">
                <?= $form->field($orden,'fk_idCliente')->hiddenInput(['id'=>'idCliente'])->label(false); ?>
                <div class="col-xs-6">
                    <?= $form->field($orden, 'responsable')->textInput(['maxlength' => 50]) ?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($orden, 'telefono')->textInput(['maxlength' => 50]) ?>
                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong class="panel-title">Datos de Orden</strong>
                </div>
                <?= $this->render('detalleOrden',['detalle'=>$detalle]); ?>
            </div>

            <div class="row">
                <div class="col-xs-7">
                    <?= $form->field($orden, 'observaciones')->textarea(); ?>
                    <?= $form->field($orden, 'observacionesCaja')->textarea(); ?>
                </div>

                <div class="col-xs-5">
                    <?= $form->field($orden,'montoVenta')->textInput(['disabled'=>true,'id'=>'total']); ?>
                    <div class="form-group">
                        <?= Html::label("Monto Pagado","monto")?>
                        <?= Html::textInput("monto","",array('class'=>'form-control',"id"=>"pagado")); ?>
                    </div>
                    <div class="form-group">
                        <?= Html::label("Monto Cambio","montoCambio")?>
                        <?= Html::textInput("montoCambio","",array('class'=>'form-control','readonly'=>true,"id"=>"cambio")); ?>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-xs-4"><?= '<label class="control-label">Fecha Plazo</label>'; ?>
                    <?= DatePicker::widget([
                        'model' => $orden,
                        'attribute' => 'fechaPlazo',
                        'type' => DatePicker::TYPE_INPUT,
                        'options' => ['placeholder' => 'Ingresa fecha plazo','id'=>'fechaPlazo','disabled'=>true],
                        'pluginOptions' => [
                            'autoclose'=>true
                        ]
                    ]); ?>
                </div>
                <div class="col-xs-4">
                    <?= $form->field($orden,'montoDescuento')->textInput(['id'=>'descuento'])?>
                </div>
            </div>

            <div class="form-group">
                <div class="text-center">
                    <?php echo Html::a('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-default hidden-print','id'=>'reset')); ?>
                    <?php echo Html::a('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar', "#", array('class' => 'btn btn-success hidden-print','id'=>'save')); ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?= $this->render('../scripts/operaciones') ?>
<?= $this->render('../scripts/totalVenta') ?>
<?= $this->render('../scripts/detalleVenta') ?>
<?= $this->render('../scripts/save') ?>
<?= $this->render('../scripts/reset') ?>
<?= $this->render('../scripts/factura') ?>
<?= $this->render('../scripts/condicionesVenta') ?>
<?php
    $js  ="
    function radio()
    {
    var val = $('input:radio[name=\"OrdenCTP[tipoPago]\"]:checked').val();
    //alert(val);
    cliente = $('#idCliente').val();
    if($('#idCliente').val().length>0)
        factura(val,'".Url::to(['venta/ajaxfactura'])."',".$orden->idOrdenCTP.",$('#tipoCliente').val());
    else
        alert(\"Debe selecciona un Cliente\");
    }";
    $this->registerJs($js, \yii\web\View::POS_HEAD);
?>