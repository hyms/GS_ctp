<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Recibos</strong>
    </div>
    <div class="panel-body">
        <?php echo CHtml::ajaxLink('Recibo Ingreso', CHtml::normalizeUrl(array("ctp/recibo",'tipo'=>"0")),array(
                'type'=>'POST',
                'url'=>"js:$(this).attr('href')",
                'success'=>'function(data) {if(data.length>0){ $("#viewModal .modal-body ").html(data); $("#viewModal").modal(); }}'
        ), array("class"=>"btn btn-default hidden-print",'title'=>'Nuevo Recibo')); ?>
        <?php echo CHtml::ajaxLink('Recibo Egreso', CHtml::normalizeUrl(array("ctp/recibo",'tipo'=>"1")),array(
            'type'=>'POST',
            'url'=>"js:$(this).attr('href')",
            'success'=>'function(data) {if(data.length>0){ $("#viewModal .modal-body ").html(data); $("#viewModal").modal(); }}'
        ), array("class"=>"btn btn-default hidden-print",'title'=>'Nuevo Recibo')); ?>
    </div>
    <?php
        $columns = array(
            array(
                'header'=>'Codigo',
                'value'=>'$data->codigo',
                'filter'=>CHtml::activeTextField($recibos,'codigo',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Nombre',
                'value'=>'$data->nombre',
                'filter'=>CHtml::activeTextField($recibos,'nombre',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Monto',
                'value'=>'$data->monto',
                'filter'=>CHtml::activeTextField($recibos,'monto',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Fecha',
                'value'=>'$data->fechaRegistro',
                'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name'=>'fechaRegistro',
                    'attribute'=>'fechaRegistro',
                    'language'=>'es',
                    'model'=>$recibos,
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
                            'url'=>'array("ctp/recibo","id"=>$data->idRecibo,"tipo"=>$data->tipoRecibo)',
                            'label'=>'Modificar',
                            'options'=>array(
                                'ajax'=>array(
                                    'type'=>'POST',
                                    'url'=>"js:$(this).attr('href')",
                                    'success'=>'function(data) {if(data.length>0){ $("#viewModal .modal-body ").html(data); $("#viewModal").modal(); }}'
                                ),
                            ),
                        ),
                    'print'=>
                        array(
                            'url'=>'array("ctp/recibo","print"=>$data->idRecibo)',
                            'label'=>'imprimir',
                            'icon'=>'print',
                        ),
                ),
            ),
        );

        $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$recibos->search('fechaRegistro DESC'),'filter'=>$recibos))
    ?>
</div>

<?php
    $this->beginWidget(
        'booster.widgets.TbModal',
        array('id' => 'viewModal','size'=>'large')

    ); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h3 class="modal-title text-center" id="myModalLabel"><strong>Recibo</strong></h3>
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