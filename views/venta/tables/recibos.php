<?php
    use kartik\popover\PopoverX;
    use yii\helpers\Html;
    use yii\helpers\Url;

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Recibos</strong>
    </div>
    <div class="panel-body">
            <?php
                PopoverX::begin([
                                    'placement' => PopoverX::ALIGN_RIGHT,
                                    'size' => PopoverX::SIZE_LARGE,
                                    'toggleButton' => ['label'=>'Recibo Ingreso', 'class'=>'btn btn-default','onclick'=>"
                                            $.ajax({
                                            type     :'POST',
                                            cache    : false,
                                            url  : '".Url::to(['venta/recibos','op'=>'i'])."',
                                            success  : function(data) {
                                                if(data.length>0){
                                                $('#poper').html(data);
                                                }
                                            }
                                            });return false;"],
                                    'header' => '<i class="glyphicon glyphicon-lock"></i>',
                                    'footer'=>Html::submitButton('Submit', ['class'=>'btn btn-sm btn-primary']) .
                                        Html::resetButton('Reset', ['class'=>'btn btn-sm btn-default'])
                                ]);
                echo "<div id='poper'></div>";
                PopoverX::end();
            ?>
        <?php /*echo CHtml::ajaxLink('Recibo Ingreso', CHtml::normalizeUrl(array("ctp/recibo",'tipo'=>"0")),array(
                'type'=>'POST',
                'url'=>"js:$(this).attr('href')",
                'success'=>'function(data) {if(data.length>0){ $("#viewModal .modal-body ").html(data); $("#viewModal").modal(); }}'
        ), array("class"=>"btn btn-default hidden-print",'title'=>'Nuevo Recibo')); ?>
        <?php echo CHtml::ajaxLink('Recibo Egreso', CHtml::normalizeUrl(array("ctp/recibo",'tipo'=>"1")),array(
            'type'=>'POST',
            'url'=>"js:$(this).attr('href')",
            'success'=>'function(data) {if(data.length>0){ $("#viewModal .modal-body ").html(data); $("#viewModal").modal(); }}'
        ), array("class"=>"btn btn-default hidden-print",'title'=>'Nuevo Recibo'));*/ ?>
    </div>
<?php
    $columns = [
        [
            'header'=>'Codigo',
            'attribute'=>'codigo',
        ],
        [
            'header'=>'Nombre',
            'attribute'=>'nombre',
        ],
        [
            'header'=>'Monto',
            'attribute'=>'monto',
        ],
        [
            'header'=>'Fecha',
            'attribute'=>'fechaRegistro',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{update} {print}',
            'buttons'=>[
                'update'=>function($url,$model){
                    $options = array_merge([
                                               //'class'=>'btn btn-success',
                                               'data-original-title'=>'Modificar',
                                               'data-toggle'=>'tooltip',
                                               'title'=>''
                                           ]);
                    $url = Url::to(['venta/recibos','op'=>'recibo','id'=>$model->idOrdenCTP]);
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                },
                'print'=>function($url,$model){
                    $options = array_merge([
                                               //'class'=>'btn btn-success',
                                               'data-original-title'=>'Imprimir',
                                               'data-toggle'=>'tooltip',
                                               'title'=>''
                                           ]);
                    $url = Url::to(['venta/print','op'=>'recibo','id'=>$model->idOrdenCTP]);
                    return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, $options);
                },
            ]
        ],
    ];


    /*
        $columns = array(
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
?>*/
        ?>