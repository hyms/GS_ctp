<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Recibos</strong>
    </div>
    <div class="panel-body">
        <?php echo CHtml::ajaxLink('Caja Chica', CHtml::normalizeUrl(array("ctp/cajaChica")),array(
                'type'=>'POST',
                'url'=>"js:$(this).attr('href')",
                'success'=>'function(data) {if(data.length>0){ $("#viewModal .modal-body ").html(data); $("#viewModal").modal(); }}'
        ), array("class"=>"btn btn-default hidden-print",'title'=>'Nuevo Caja Chica')); ?>
        <?php echo CHtml::link('<span class="glyphicon glyphicon-export"></span>Reporte', CHtml::normalizeUrl(array("ctp/cajaChicas",'print'=>true)), array("class"=>"btn btn-default hidden-print",'title'=>'reporte de caja chica')); ?>
    </div>
    <?php
        $columns = array(
            array(
                'header'=>'Usuario',
                'value'=>'$data->fkIdUser->username',
                'filter'=>CHtml::activeTextField($cajasChicas,'user',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Nombre',
                'value'=>'$data->fkIdUser->nombre." ".$data->fkIdUser->apellido',
            ),
            array(
                'header'=>'Monto',
                'value'=>'$data->monto',
                'filter'=>CHtml::activeTextField($cajasChicas,'monto',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Detalle',
                'value'=>'$data->detalle',
                'filter'=>CHtml::activeTextField($cajasChicas,'detalle',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Nro. Factura',
                'value'=>'$data->obseraciones',
                'filter'=>CHtml::activeTextField($cajasChicas,'obseraciones',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Fecha',
                'value'=>'$data->fechaRegistro',
                'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name'=>'fechaRegistro',
                    'attribute'=>'fechaRegistro',
                    'language'=>'es',
                    'model'=>$cajasChicas,
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
                            'url'=>'array("ctp/cajaChica","id"=>$data->idCajaChica)',
                            'label'=>'Modificar',
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

        $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$cajasChicas->search("`t`.fechaRegistro Desc"),'filter'=>$cajasChicas))
    ?>
</div>

<?php
    $this->beginWidget(
        'booster.widgets.TbModal',
        array('id' => 'viewModal','size'=>'large')

    ); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h3 class="modal-title text-center" id="myModalLabel"><strong>Caja Chica</strong></h3>
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