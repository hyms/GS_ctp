<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Ordenes Reposiciones</strong>
    </div>
    <div class="panel-body" style="overflow: auto;">
        <?php
        $columns = array(
                array(
                    'header'=>'Codigo',
                    'value'=>'$data->codigo',
                    'filter'=>CHtml::activeTextField($ordenes,'codigo',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Responsable',
                    'value'=>'$data->responsable',
                    'filter'=>CHtml::activeTextField($ordenes,'responsable',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Fecha',
                    'value'=>'$data->fechaRegistro',
                    'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name'=>'fechaRegistro',
                                'attribute'=>'fechaRegistro',
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
                    'template'=>'{update} {print}',
                    'buttons'=>array(
                        'update'=>
                            array(
                                'url'=>'array(($data->fk_idServicioVenta=="" && $data->fk_idServicioVentaRI=="")?"repos/modificarI":"repos/modificarR","id"=>$data->idServicioVentaRI)',
                                'label'=>'Modificar Orden'
                            ),
                        'print'=>
                            array(
                                'url'=>'array("repos/print","id"=>$data->idServicioVentaRI,"i"=>($data->fk_idServicioVenta=="" && $data->fk_idServicioVentaRI=="")?true:false)',
                                'label'=>'Imprimir',
                                'icon'=>'print',
                            ),
                    ),
                ),
            );
            $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$ordenes->search($criterio,'fechaRegistro DESC'),'filter'=>$ordenes));
        ?>
    </div>
</div>
