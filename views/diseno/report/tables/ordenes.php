<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Ordenes de trabajo</strong>
    </div>
    <div class="panel-body">
        <?php
        $columns = array(
            array(
                'header'=>'Correlativo',
                'value'=>'$data->correlativo',
                'filter'=>CHtml::activeTextField($ordenes,'correlativo',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Diseñador',
                'value'=>'$data["fkIdUserD"]["nombre"]',
                'filter'=>CHtml::activeTextField($ordenes,'disenador',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Cliente',
                'value'=>'$data->fkIdCliente["nombreNegocio"]',
                'filter'=>CHtml::activeTextField($ordenes,'negocio',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'responsable',
                'value'=>'$data->responsable',
                'filter'=>CHtml::activeTextField($ordenes,'responsable',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Estado',
                'value'=>'($data->estado!=1)?(($data->estado==0)?"Cancelado":(($data->estado<0)?"Anulado":"Deuda")):""',
                'filter'=>CHtml::activeDropDownList($ordenes, 'estado',array('Cancelado','2'=>'Deuda','-1'=>'Anulado'),array("class"=>"form-control input-sm",'empty'=>'')),
            ),
            array(
                'header'=>'Fecha',
                'type'=>'raw',
                'value'=>'$data->fechaGenerada',
                'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name'=>'fechaGenerada',
                    'attribute'=>'fechaGenerada',
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
                'template'=>'{view}',
                'buttons'=>array(
                    'view'=>
                        array(
                            'url'=>'array("report/orden","id"=>$data->idServicioVenta)',
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
        $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$ordenes->searchCliente('fechaGenerada Desc'),'filter'=>$ordenes));
        ?>
    </div>
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