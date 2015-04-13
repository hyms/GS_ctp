<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

?>
<div class="col-xs-7">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <strong>Orden de Trabajo</strong>
            </h4>
        </div>
        <div class="panel-body" style="overflow: auto;">
            <div class="col-xs-6"><strong>Cliente: </strong><?php echo $orden->fkIdCliente->nombreNegocio; ?></div>
            <div class="col-xs-6"><strong>NitCi: </strong><?php echo $orden->fkIdCliente->nitCi; ?></div>
            <div class="col-xs-6"><strong>Responsable: </strong><?php echo $orden->responsable; ?></div>
            <div class="col-xs-6"><strong>Telefono: </strong><?php echo $orden->telefono; ?></div>

            <table class="table table-hover table-condensed" style="text-align: right;">
                <thead><tr>
                    <th><?php echo "Nº"; ?></th>
                    <th><?php echo "Formato"; ?></th>
                    <th><?php echo "Cant."; ?></th>
                    <th><?php echo "Colores"; ?></th>
                    <th><?php echo "Trabajo"; ?></th>
                    <th><?php echo "Pinza"; ?></th>
                    <th><?php echo "Resol."; ?></th>
                    <th><?php echo "Costo"; ?></th>
                    <th><?php echo "Adicional"; ?></th>
                    <th><?php echo "Total"; ?></th>
                </tr></thead>

                <tbody>
                <?php $i=0; foreach ($orden->ordenDetalles as $producto){ $i++;?>
                    <tr>
                        <td>
                            <?php echo $i;?>
                        </td>
                        <td>
                            <?php echo $producto->fkIdProductoStock->fkIdProducto->formato;?>
                        </td>
                        <td>
                            <?php echo $producto->cantidad; ?>
                        </td>
                        <td>
                            <?php echo (($producto->C)?"<strong>C </strong>":"").(($producto->M)?"<strong>M </strong>":"").(($producto->Y)?"<strong>Y </strong>":"").(($producto->K)?"<strong>K </strong>":"");?>
                        </td>
                        <td>
                            <?php echo $producto->trabajo;?>
                        </td>
                        <td>
                            <?php echo $producto->pinza;?>
                        </td>
                        <td>
                            <?php echo $producto->resolucion;?>
                        </td>
                        <td>
                            <?php echo $producto->costo;?>
                        </td>
                        <td>
                            <?php echo $producto->adicional;?>
                        </td>
                        <td>
                            <?php echo $producto->total;?>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
            <div class="well well-sm col-xs-2 col-xs-offset-10"><strong>Total: </strong><?php echo $orden->montoVenta; ?></div>
        </div>
    </div>
</div>
<div class="col-xs-5">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <strong>Datos de Deuda</strong>
            </h4>
        </div>

        <div class="panel-body" style="overflow: auto;">
            <div class="well well-sm row">
                <h4>Deuda Hasta el momento</h4>
                <div class="col-xs-6"><strong>Cancelado: </strong><?php echo ($deuda); ?></div>
                <div class="col-xs-6"><strong>Saldo: </strong><?php echo ($orden->montoVenta-$deuda); ?></div>
            </div>

            <div class="well well-sm row">

                <?php $form = ActiveForm::begin(['id'=>'form']);?>
                <?php echo Html::hiddenInput('montoVenta',$orden->montoVenta,['id'=>'total']); ?>
                <?php echo Html::hiddenInput('montoPagado',$deuda,['id'=>'pagado']); ?>
                <h4>A Cancelar</h4>
                <div class="col-xs-6">
                    <?= $form->field($model,'monto')->textInput(['id'=>'acuenta']); ?>
                </div>
                <div class="col-xs-6">
                    <?= Html::label('Saldo','saldo'); ?>
                    <?= Html::textInput('saldo',null,['class'=>'form-control','id'=>'saldo']); ?>
                </div>
                <div class="col-xs-12 text-center">
                    <?php echo Html::a('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-danger hidden-print','id'=>'reset')); ?>
                    <?php echo Html::a('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar', "#", array('class' => 'btn btn-success hidden-print','id'=>'save')); ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<?php
    $script = <<<JS
    $('#acuenta').keydown(function(e) {
        if (e.keyCode == 13 || e.keyCode == 9) {
            $('#saldo').val(resta($('#total').val(), suma($('#acuenta').val(),$('#pagado').val())));
        }
    });
    $('#acuenta').blur(function(e) {
        $('#saldo').val(resta($('#total').val(), suma($('#acuenta').val(),$('#pagado').val())));
    })
JS;

    $this->registerJs($script, \yii\web\View::POS_READY);
    echo $this->render('../scripts/operaciones');
    echo $this->render('../scripts/save');
    echo $this->render('../scripts/reset');

/*
    Yii::app()->getClientScript()->registerScript("ajax_deuda","
    $('#acuenta').keydown(function(e) {
        if (e.keyCode == 13 || e.keyCode == 9) {
            $('#saldo').val(resta($('#total').val(), suma($('#acuenta').val(),$('#pagado').val())));
        }
    });
    $('#acuenta').blur(function(e) {
        $('#saldo').val(resta($('#total').val(), suma($('#acuenta').val(),$('#pagado').val())));
    })
",CClientScript::POS_READY);

$this->renderPartial('/scripts/operaciones');
$this->renderPartial('/scripts/sendBlock');