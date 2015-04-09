<?php
    $columns = array(
        array(
            'header'=>'Correlativo',
            'value'=>'$data->correlativo',
            'filter'=>CHtml::activeTextField($ordenes,'correlativo',array('class'=>'form-control input-sm')),
        ),
        array(
            'header'=>'Codigo',
            'value'=>'$data->codigoServicio',
            'filter'=>CHtml::activeTextField($ordenes,'codigoServicio',array('class'=>'form-control input-sm')),
        ),
        array(
            'header'=>'Cliente',
            'value'=>'(isset($data->fkIdCliente->nombreNegocio))?$data->fkIdCliente->nombreNegocio:""',
            'filter'=>CHtml::activeTextField($ordenes,'negocio',array('class'=>'form-control input-sm')),
        ),
        array(
            'header'=>'responsable',
            'value'=>'$data->responsable',
            'filter'=>CHtml::activeTextField($ordenes,'responsable',array('class'=>'form-control input-sm')),
        ),
        array(
            'header'=>'Saldo',
            'value'=>'$data->montoVenta-$data->montoPagado',
        ),
        array(
            'header'=>'Fecha Venta',
            'value'=>'$data->fechaVenta',
            'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name'=>'fechaVenta',
                'attribute'=>'fechaVenta',
                'language'=>'es',
                'model'=>$ordenes,
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'yy-mm-dd',
                ),
                'htmlOptions'=>array(
                    'class'=>'form-control input-sm',
                ),
            ),
                                    true),
        ),
        array(
            'header'=>'',
            'class'=>'booster.widgets.TbButtonColumn',
            'template'=>'{update} {cancel} {print}',
            'buttons'=>array(
                'update'=>
                    array(
                        'url'=>'array("ctp/modificar","id"=>$data->idServicioVenta)',
                        'label'=>'Modificar',
                    ),
                'cancel'=>
                    array(
                        'url'=>'array("ctp/pagoDeuda","id"=>$data->idServicioVenta)',
                        'label'=>'Cancelar Deuda',
                        'icon'=>'usd',
                    ),
                'print'=>
                    array(
                        'url'=>'array("ctp/preview","id"=>$data->idServicioVenta)',
                        'label'=>'imprimir',
                        'icon'=>'print',
                    ),
            ),
        ),
    );
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <strong>Deudores</strong>
        </h4>
    </div>
    <?php
        $condicion = 'estado=2';
        $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$ordenes->searchCliente('fechaVenta Desc',$condicion),'filter'=>$ordenes))
    ?>
</div>

