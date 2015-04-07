<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Ordenes de trabajo</strong>
    </div>
    <div class="panel-body">
        <?php
            $columns = array(
                array(
                    'header'=>'Codigo',
                    'value'=>'$data->codigo',
                    'filter'=>CHtml::activeTextField($ordenes,'codigo',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'responsable',
                    'value'=>'$data->responsable',
                    'filter'=>CHtml::activeTextField($ordenes,'responsable',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Tipo',
                    'value'=>'($data->tipoRI!="")?ServicioVentaRI::getTipo($data->tipoRI):""',
                    'filter'=>CHtml::activeDropDownList($ordenes,'tipoRI',ServicioVentaRI::getTipo(),array('class'=>'form-control input-sm','empty'=>'')),
                ),
                array(
                    'header'=>'Fecha',
                    'type'=>'raw',
                    'value'=>'$data->fechaRegistro',
                    'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker',
                                            array(
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
                    'template'=>'{update}',
                    'buttons'=>array(
                        'update'=>
                            array(
                                'url'=>'array("repos/repOrden","id"=>$data->idServicioVentaRI,"o"=>false)',
                                'label'=>'Reponer',
                            ),
                    ),
                ),
            );
                $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$ordenes->search($condicion,'fechaRegistro DESC'),'filter'=>$ordenes));
        ?>
    </div>
</div>
