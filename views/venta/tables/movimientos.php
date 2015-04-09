<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title"><strong>Listado de Ventas</strong></span><?php echo "  ".CHtml::link('<span class="glyphicon glyphicon-export"></span>Reporte', CHtml::normalizeUrl(array("ctp/movimientos",'pdf'=>true)), array("class"=>"btn btn-default hidden-print",'title'=>'reporte de Movimientos')); ?>
    </div>
    <?php
        if(!empty($ventas->fechaVenta)) {
           $data             = $ventas->searchCliente('fechaVenta Desc', 'estado!=1');
           $data->pagination = false;
           $data             = $data->getData();
           $total            = 0;
           $monto            = 0;
           foreach ($data as $item) {
               $total = $total + $item->montoVenta;
               $monto = $monto + SGServicioVenta::montoPagado($item);
           }
       }

        $columns = array(
            array(
                'header'=>'Factura',
                'value'=>'($data->tipoVenta)?"S/Factura":"C/Factura"',
                'filter'=>CHtml::activeDropDownList($ventas, 'tipoVenta',array('Con Factura','Sin Factura'),array("class"=>"form-control input-sm",'empty'=>'')),
            ),
            array(
                'header'=>'Estado',
                'value'=>'($data->estado!=1)?(($data->estado==0)?"Cancelado":(($data->estado<0)?"Anulado":"Deuda")):""',
                'filter'=>CHtml::activeDropDownList($ventas, 'estado',array('Cancelado','2'=>'Deuda','-1'=>'Anulado'),array("class"=>"form-control input-sm",'empty'=>'')),
            ),
            array(
                'header'=>'Correlativo',
                'value'=>'$data->correlativo',
                'filter'=>CHtml::activeTextField($ventas, 'correlativo',array("class"=>"form-control input-sm")),
            ),
            array(
                'header'=>'Codigo',
                'value'=>'$data->codigoServicio',
                'filter'=>CHtml::activeTextField($ventas, 'codigoServicio',array("class"=>"form-control input-sm")),
            ),
            array(
                'header'=>'Cliente',
                'value'=>'$data->fkIdCliente["nombreNegocio"]',
                'filter'=>CHtml::activeTextField($ventas, 'cliente',array("class"=>"form-control input-sm")),
            ),
            array(
                'header'=>'Monto de la Venta',
                //'name'=>'montoVenta',
                'value'=>'$data->montoVenta',
                //'filter'=>CHtml::activeTextField($ventas, 'montoVenta',array("class"=>"form-control input-sm")),
            ),
            array(
                'header'=>'Monto Pagado',
                //'name'=>'montoPagado',
                'value'=>'SGServicioVenta::montoPagado($data)',
                //'filter'=>CHtml::activeTextField($ventas, 'montoPagado',array("class"=>"form-control input-sm")),
            ),
            array(
                'header'=>'fechaVenta',
                'value'=>'$data->fechaVenta',
                'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name'=>'fechaVenta',
                    'attribute'=>'fechaVenta',
                    'language'=>'es',
                    'model'=>$ventas,
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
                'template'=>'{print} {factura}',
                'buttons'=>array(
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
        /*$extended = array(
            'columns' => array(
                'montoVenta' => array('label'=>'Total de Venta', 'class'=>'TbSumOperation'),
                'montoPagado' => array('label'=>'Total Cancelado', 'class'=>'TbSumOperation')
            )
        );*/
        $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$ventas->searchCliente('fechaVenta Desc','estado!=1'),'filter'=>$ventas));
        if(!empty($ventas->fechaVenta)) {
            echo '<div class="well col-xs-3 col-xs-offset-9"><strong>Total: </strong>' . $total . '</br><strong>Cancelado: </strong>' . $monto . '</div>';
        }
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