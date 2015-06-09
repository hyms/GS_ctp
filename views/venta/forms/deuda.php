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
                <div class="col-xs-6"><strong>Cliente:</strong> <?= $orden->fkIdCliente->nombreNegocio; ?></div>
                <div class="col-xs-6"><strong>NitCi:</strong> <?= $orden->fkIdCliente->nitCi; ?></div>
                <div class="col-xs-6"><strong>Responsable:</strong> <?= $orden->responsable; ?></div>
                <div class="col-xs-6"><strong>Telefono:</strong> <?= $orden->telefono; ?></div>

                <table class="table table-hover table-condensed" style="text-align: right;">
                    <thead><tr>
                        <th><?= "Nº"; ?></th>
                        <th><?= "Formato"; ?></th>
                        <th><?= "Cant."; ?></th>
                        <th><?= "Colores"; ?></th>
                        <th><?= "Trabajo"; ?></th>
                        <th><?= "Pinza"; ?></th>
                        <th><?= "Resol."; ?></th>
                        <th><?= "Costo"; ?></th>
                        <th><?= "Adicional"; ?></th>
                        <th><?= "Total"; ?></th>
                    </tr></thead>

                    <tbody>
                    <?php $i=0; foreach ($orden->ordenDetalles as $producto){ $i++;?>
                        <tr>
                            <td>
                                <?= $i;?>
                            </td>
                            <td>
                                <?= $producto->fkIdProductoStock->fkIdProducto->formato;?>
                            </td>
                            <td>
                                <?= $producto->cantidad; ?>
                            </td>
                            <td>
                                <?= (($producto->C)?"<strong>C </strong>":"").(($producto->M)?"<strong>M </strong>":"").(($producto->Y)?"<strong>Y </strong>":"").(($producto->K)?"<strong>K </strong>":"");?>
                            </td>
                            <td>
                                <?= $producto->trabajo;?>
                            </td>
                            <td>
                                <?= $producto->pinza;?>
                            </td>
                            <td>
                                <?= $producto->resolucion;?>
                            </td>
                            <td>
                                <?= $producto->costo;?>
                            </td>
                            <td>
                                <?= $producto->adicional;?>
                            </td>
                            <td>
                                <?= $producto->total;?>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
                <div class="well well-sm col-xs-2 col-xs-offset-10"><strong>Total: </strong><?= $orden->montoVenta; ?></div>
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
                    <div class="col-xs-6"><strong>Cancelado: </strong><?= ($deuda); ?></div>
                    <div class="col-xs-6"><strong>Saldo: </strong><?= ($orden->montoVenta-$deuda); ?></div>
                </div>

                <div class="well well-sm row">

                    <?php $form = ActiveForm::begin(['id'=>'form']);?>
                    <?= Html::hiddenInput('montoVenta',$orden->montoVenta,['id'=>'total']); ?>
                    <?= Html::hiddenInput('montoPagado',$deuda,['id'=>'pagado']); ?>
                    <h4>A Cancelar</h4>
                    <div class="col-xs-6">
                        <?= $form->field($model,'monto')->textInput(['id'=>'acuenta']); ?>
                    </div>
                    <div class="col-xs-6">
                        <?= Html::label('Saldo','saldo'); ?>
                        <?= Html::textInput('saldo',null,['class'=>'form-control','id'=>'saldo']); ?>
                    </div>
                    <div class="col-xs-12 text-center">
                        <?= Html::a('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-danger hidden-print','id'=>'reset')); ?>
                        <?= Html::a('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar', "#", array('class' => 'btn btn-success hidden-print','id'=>'save')); ?>
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
