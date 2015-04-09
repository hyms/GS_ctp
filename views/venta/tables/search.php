<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Ordenes de trabajo Transaccionadas</strong>
    </div>
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
                    'header'=>'Fecha Generada',
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
                    'template'=>'{update} {aviso} {print} {factura}',
                    'buttons'=>array(
                        'update'=>
                            array(
                                'url'=>'array("ctp/modificar","id"=>$data->idServicioVenta)',
                                'label'=>'Modificar',
                                'visible'=>'$data->estado >= 0',
                            ),
                        'aviso'=>
                            array(
                                'url'=>'"#"',
                                'label'=>'Anulado',
                                'icon'=>"pencil",
                                'visible'=>'$data->estado < 0',
                                'options'=>array('onclick'=>'alert("ANULADO")'),
                            ),
                        'print'=>
                            array(
                                'url'=>'array("ctp/preview","id"=>$data->idServicioVenta)',
                                'label'=>'imprimir',
                                'icon'=>'print',
                            ),
                        'factura'=>
                            array(
                                'label'=>'Introducir Nro de Factura',
                                'icon'=>'edit',
                                'url'=>'array("ctp/addFactura","id"=>$data->idServicioVenta)',
                                'visible'=>'$data->tipoVenta == 0',
                                'options'=>array(
                                    'ajax'=>array(
                                        'type'=>'POST',
                                        'url'=>"js:$(this).attr('href')",
                                        'success'=>'function(data) {if(data.length>0){ $("#viewModal .modal-body ").html(data); $("#viewModal").modal(); }}'
                                    ),
                                ),
                            ),
                    ),
                ),
            );

            $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$ordenes->searchCliente('fechaVenta Desc',$condicion),'filter'=>$ordenes))
        ?>
</div>

<?php
    $this->beginWidget(
        'booster.widgets.TbModal',
        array('id' => 'viewModal','size'=>'small')

    ); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h3 class="modal-title text-center" id="myModalLabel"><strong>Añadir Nº Factura</strong></h3>
</div>
<div class="modal-body" style="overflow:auto;">
</div>
<div class="modal-footer">
    <?php $this->widget('booster.widgets.TbButton',
                        array(
                            'context' => 'primary',
                            'buttonType' => 'ajaxLink',
                            'label'=>'Guardar',
                            'url' => '#',
                            'htmlOptions'=>array('onclick' => 'formSubmit();'),
                        )
    ); ?>
    <?php $this->widget('booster.widgets.TbButton',
                        array(
                            'label'=>'Cancelar',
                            'url' => '#',
                            'htmlOptions' => array('data-dismiss' => 'modal'),
                        )
    ); ?>
</div>
<?php $this->endWidget(); ?>

<?php Yii::app()->clientScript->registerScript("modalSubmit",'
	function formSubmit()
	{
	    data=$("#form").serialize();
        $.ajax({
        type: "POST",
        data:data,
        url: $("#form").attr("action"),
        success: function(data){
        if(data=="done")
            location.reload();
        else
            $("#viewModal .modal-body ").html(data);
        }
        });
	}
',CClientScript::POS_HEAD);
?>