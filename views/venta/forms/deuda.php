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
                <th><?php echo "Nº Placas"; ?></th>
                <th><?php echo "Colores"; ?></th>
                <th><?php echo "Formato"; ?></th>
                <th><?php echo "Trabajo"; ?></th>
                <th><?php echo "Pinza"; ?></th>
                <th><?php echo "Resol."; ?></th>
                <th><?php echo "Costo"; ?></th>
                <th><?php echo "Adicional"; ?></th>
                <th><?php echo "Total"; ?></th>
            </tr></thead>

            <tbody>
            <?php $i=0; foreach ($orden->detalleServicios as $producto){ $i++;?>
                <tr>
                    <td>
                        <?php echo $i;?>
                    </td>
                    <td>
                        <?php echo $producto->cantidad; ?>
                    </td>
                    <td>
                        <?php echo (($producto->C)?"<strong>C </strong>":"").(($producto->M)?"<strong>M </strong>":"").(($producto->Y)?"<strong>Y </strong>":"").(($producto->K)?"<strong>K </strong>":"");?>
                    </td>
                    <td>
                        <?php echo $producto->fkIdProductoStock->fkIdProducto->color;?>
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

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <strong>Datos de Deuda</strong>
        </h4>
    </div>

    <div class="panel-body" style="overflow: auto;">

        <div class="col-xs-4">
            <div class="well well-sm col-xs-12">
                <h4>Deuda Hasta el momento</h4>
                <div class="col-xs-6"><strong>Cancelado: </strong><?php echo ($deuda->montoPagado); ?></div>
                <div class="col-xs-6"><strong>Saldo: </strong><?php echo $deuda->saldo; ?></div>
            </div>
        </div>
        <div class="col-xs-8">
            <?php
                $form = $this->beginWidget(
                    'booster.widgets.TbActiveForm',
                    array(
                        'id' => 'form',
                        'type' => 'horizontal',
                        'htmlOptions' => array('class' => 'well well-sm col-xs-12','onsubmit'=>"return checkSubmit();"), // for inset effect
                    )
                );
            ?>
            <h4>Cancelar</h4>
            <?php echo CHtml::hiddenField('montoVenta',$orden->montoVenta,array("id"=>"total")); ?>
            <?php echo CHtml::hiddenField('montoPagado',($deuda->montoPagado),array("id"=>"pagado")); ?>
                <div class="form-group col-xs-6">
                    <?php echo CHtml::activeLabelEx($model,"acuenta",array('class'=>'control-label col-xs-4'))?>
                    <div class="col-xs-8">
                        <?php echo CHtml::activeTextField($model,"acuenta",array('class'=>'form-control input-sm',"id"=>"acuenta")); ?>
                    </div>
                    <?php echo CHtml::error($model,"acuenta",array('class'=>'label label-danger')); ?>
                </div>
                <div class="form-group col-xs-6">
                    <?php echo CHtml::activeLabelEx($model,"saldo",array('class'=>'control-label col-xs-4'))?>
                    <div class="col-xs-8">
                        <?php echo CHtml::activeTextField($model,"saldo",array('class'=>'form-control input-sm','readonly'=>true,"id"=>"saldo")); ?>
                    </div>
                    <?php echo CHtml::error($model,"saldo",array('class'=>'label label-danger')); ?>
                </div>
            <div class="col-xs-12">
                <?php echo CHtml::link('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-default hidden-print','id'=>'reset')); ?>
                <?php echo CHtml::link('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar', "#", array('class' => 'btn btn-default hidden-print','id'=>'save')); ?>
            </div>
            <?php
                $this->endWidget();
                unset($form);
            ?>
        </div>

    </div>
</div>

<?php
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