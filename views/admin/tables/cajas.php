<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Lista de Productos</strong>
    </div>
    <div class="panel-body" style="overflow: auto;">
        <?php
            $columns =array(
                array(
                    'header'=>'Nro',
                    'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),

                array(
                    'header'=>'Nombre',
                    'value'=>'$data->nombre',
                ),
                array(
                    'header'=>'Monto',
                    'value'=>'$data->monto',
                ),
                array(
                    'header'=>'Descripcion',
                    'value'=>'$data->descripcion',
                ),
                array(
                    'header'=>'',
                    'class'=>'booster.widgets.TbButtonColumn',
                    'template'=>'{update}',
                    'buttons'=>array(
                        'update'=>
                            array(
                                'url'=>'array("configuration/caja","id"=>$data->idCaja)',
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
            $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$cajas->search()))
        ?>
        <?php echo CHtml::ajaxLink('<span class="glyphicon glyphicon-floppy-disk"></span> Añadir',array("configuration/caja"),array(
            'type'=>'POST',
            'url'=>"js:$(this).attr('href')",
            'success'=>'function(data) {if(data.length>0){ $("#viewModal .modal-body ").html(data); $("#viewModal").modal(); }}'
        ),array("class" => "openDlg divDialog", "title"=>"Añadir Datos")); ?>

    </div>
</div>
<?php
    $this->beginWidget(
        'booster.widgets.TbModal',
        //        array('id' => 'viewModal','size'=>'large')
        array('id' => 'viewModal')

    ); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h3 class="modal-title text-center" id="myModalLabel"><strong>Caja</strong></h3>
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