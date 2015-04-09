<?php
    $columns = array(
        array(
            'header'=>'Formato',
            'value'=>'$data->fkIdProducto->color',
        ),
        array(
            'header'=>'Tamaño',
            'value'=>'$data->fkIdProducto->descripcion',
        ),
        array(
            'header'=>'Stock',
            'value'=>'$data->cantidad',
        ),
        array(
            'header'=>'',
            'class'=>'booster.widgets.TbButtonColumn',
            'template'=>'{price}',
            'buttons'=>array(
                'price'=>
                    array(
                        'label'=>'Revisar precios',
                        'icon'=>'usd',
                        'url'=>'array("ctp/precios","id"=>$data->idProductoStock)',
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
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <strong>Placas CTP</strong>
        </h4>
    </div>
    <div class="panel-body" style="overflow: auto;">
        <?php $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$productos->searchProducto()));?>
    </div>
</div>

<?php
    $this->beginWidget(
        'booster.widgets.TbModal',
        array('id' => 'viewModal','size'=>'large')

    ); ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title text-center" id="myModalLabel"><strong>Precios</strong></h3>
    </div>
    <div class="modal-body" style="overflow:auto;">
    </div>
    <div class="modal-footer">
       <?php $this->widget('booster.widgets.TbButton',
                            array(
                                'label'=>'Cancelar',
                                'url' => '#',
                                'htmlOptions' => array('data-dismiss' => 'modal'),
                            )
        ); ?>
    </div>
<?php $this->endWidget(); ?>