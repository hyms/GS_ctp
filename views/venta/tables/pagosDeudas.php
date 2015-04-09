<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Historial de Pagos de Deudas</strong>
    </div>
    <?php
        $columns = array(
            array(
                'header'=>'Orden',
                'value'=>'$data->fkIdServicioVenta->correlativo',
                'filter'=>CHtml::activeTextField($pagos,'correlativo',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Cliente',
                'value'=>'$data->fkIdServicioVenta->fkIdCliente->nombreNegocio',
                'filter'=>CHtml::activeTextField($pagos,'cliente',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Responsable',
                'value'=>'$data->fkIdServicioVenta->responsable',
                'filter'=>CHtml::activeTextField($pagos,'responsable',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Pagado',
                'value'=>'$data->montoPagado',
                'filter'=>CHtml::activeTextField($pagos,'montoPagado',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'A/C',
                'value'=>'$data->acuenta',
                'filter'=>CHtml::activeTextField($pagos,'acuenta',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Saldo',
                'value'=>'$data->saldo',
                'filter'=>CHtml::activeTextField($pagos,'saldo',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Fecha Generada',
                'value'=>'$data->fecha',
                'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name'=>'fecha',
                    'attribute'=>'fecha',
                    'language'=>'es',
                    'model'=>$pagos,
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
                'template'=>'{update} {print}',
                'buttons'=>array(
                    'update'=>
                        array(
                            'url'=>'array("ctp/pagoDeuda","deuda"=>$data->idDeudaServicioVenta,"id"=>$data->fk_idServicioVenta)',
                            'label'=>'Modificar',
                        ),
                    'print'=>
                        array(
                            'url'=>'array("ctp/deudaPrint","id"=>$data->idDeudaServicioVenta)',
                            'label'=>'imprimir',
                            'icon'=>'print',
                        ),
                ),
            ),
        );
    ?>
    <div class="panel-body">
            <?php echo CHtml::link('<span class="glyphicon glyphicon-export"></span>', CHtml::normalizeUrl(array("ctp/pagosDeudas",'pdf'=>true)), array("class"=>"btn btn-default hidden-print",'title'=>'Reporte de Pagos')); ?>
    </div>
    <?php
        $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$pagos->search(null,null,'fecha DESC'),'filter'=>$pagos))
    ?>
</div>