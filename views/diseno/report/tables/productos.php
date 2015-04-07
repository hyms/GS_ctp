<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Ordenes de trabajo</strong>
    </div>
    <div class="panel-body" style="overflow: auto;">
        <?php

            $columns = array(
                array(
                    'header'=>'Formato',
                    'value'=>'$data->fkIdProductoStock->fkIdProducto->color',
                    'filter'=>CHtml::activeTextField($placas,'formato',array(),array('class'=>'form-control input-sm')),
                    //'filter'=>CHtml::activeDropDownList($placas,'formato',CHtml::listData(DetalleCTP::model()->findAll(),'formato','formato'),array('class'=>'form-control input-sm','empty'=>'')),
                ),
                array(
                    'header'=>'correlativo',
                    'value'=>'$data->fkIdServicioVenta->correlativo',
                    'filter'=>CHtml::activeTextField($placas,'correlativo',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'responsable',
                    'value'=>'$data->fkIdServicioVenta->responsable',
                    'filter'=>CHtml::activeTextField($placas,'responsable',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Cliente',
                    'value'=>'$data["fkIdServicioVenta"]["fkIdCliente"]["nombreNegocio"]',
                    'filter'=>CHtml::activeTextField($placas,'negocio',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Cant.',
                    'value'=>'$data->cantidad',
                    'filter'=>CHtml::activeTextField($placas,'cantidad',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Fecha',
                    'type'=>'raw',
                    'value'=>'$data->fkIdServicioVenta->fechaVenta',
                    'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name'=>'fecha',
                        'attribute'=>'fecha',
                        'language'=>'es',
                        'model'=>$placas,
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
                    'template'=>'{view}',
                    'buttons'=>array(
                        'view'=>
                            array(
                                'url'=>'array("report/orden","id"=>$data->fk_idServicioVenta)',
                                'options'=>array(
                                    'ajax'=>array(
                                        'type'=>'POST',
                                        'url'=>"js:$(this).attr('href')",
                                        'success'=>'function(data) { $("#viewModal .modal-body ").html(data); $("#viewModal").modal(); }'
                                    ),
                                ),
                            ),
                    ),
                ),
            );

            $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$placas->searchCliente('fechaGenerada Desc'),'filter'=>$placas));
        ?>
    </div>
    <?php
        $this->beginWidget(
            'booster.widgets.TbModal',
            array('id' => 'viewModal','size'=>'large')

        ); ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title text-center" id="myModalLabel"><strong>Orden de Trabajo</strong></h3>
    </div>
    <div class="modal-body" style="overflow:auto;">
    </div>
    <?php $this->endWidget(); ?>
</div>
