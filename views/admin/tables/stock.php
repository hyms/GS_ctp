<?php
    use kartik\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\Url;

    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'header'=>'Codigo',
            'value'=>function($model){
                return $model->fkIdProducto->codigo;
            },
        ],
        [
            'header'=>'Material',
            'value'=>function($model){
                return $model->fkIdProducto->material;
            },
        ],
        [
            'header'=>'Detalle Producto',
            'value'=>function($model){
                return $model->fkIdProducto->formato." ".$model->fkIdProducto->dimension;
            },
        ],
        [
            'header'=>'Cant.xPaqt.',
            'value'=>function($model){
                return $model->fkIdProducto->cantidadPaquete;
            },
        ],
        [
            'header'=>'Stock Paquete',
            'value'=>function($model){
                return $model->cantidad;
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{update}',
            'buttons'=>[
                'update'=>function($url,$model) {
                    $options = array_merge([
                                               //'class'=>'btn btn-success',
                                               'data-original-title' => 'Modificar',
                                               'data-toggle'         => 'tooltip',
                                               'title'               => '',
                                               'onclick'             => "
                                                        $.ajax({
                                                            type     :'POST',
                                                            cache    : false,
                                                            url  : '" . Url::to(['admin/stock','op'=>'add','id'=>$model->idProductoStock]) . "',
                                                            success  : function(data) {
                                                                if(data.length>0){
                                                                    $('#viewModal .modal-header').html('<h3 class=\"text-center\">Stock ".((isset($model->fkIdSucursal))?$model->fkIdSucursal->nombre:'Deposito')."</h3>');
                                                                    $('#viewModal .modal-body').html(data);
                                                                    $('#viewModal').modal();
                                                                }
                                                            }
                                                        });return false;"
                                           ]);
                    $url     = "#";
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                },
            ]
        ],
    ];

    echo GridView::widget([

                              'dataProvider'=> $productos,
                              'filterModel' => $search,
                              'columns' => $columns,
                              'headerRowOptions'=>['class'=>'kartik-sheet-style'],
                              'filterRowOptions'=>['class'=>'kartik-sheet-style'],
                              'toolbar' =>  [
                                  '{export}',
                                  '{toggleData}',
                              ],
                              'export' => [
                                  'fontAwesome' => true
                              ],
                              //'bordered' => true,
                              'condensed' => true,
                              'hover'=>true,
                              'panel' => [
                                  'type' => GridView::TYPE_DEFAULT,
                                  'heading' => 'Stock '.$nombre,
                              ],
                              'persistResize' => true,
                              'exportConfig' => [
                                  GridView::EXCEL => [
                                      'label' => 'Excel',
                                      'filename' => 'Productos',
                                      'alertMsg' => 'El EXCEL se generara para la descarga.',
                                  ],
                                  GridView::PDF => [
                                      'label' => 'PDF',
                                      'filename' => 'Productos',
                                      'alertMsg' => 'El PDF se generara para la descarga.',
                                  ],
                              ]
                          ]);


/*
        $columns = array(
            array(
                'header'=>'',
                'class'=>'booster.widgets.TbButtonColumn',
                'template'=>'{import}',
                'buttons'=>array(
                    'import'=>
                        array(
                            'label'=>'Añadir a Stock',
                            'icon'=>'import',
                            'url'=>'array("stock/stockAdd","id"=>$data->idProductoStock,"almacen"=>$data->fk_idAlmacen)',
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
        $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$productos->searchProducto('material'),'filter'=>$productos))
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
    <h3 class="modal-title text-center" id="myModalLabel"><strong>Añadir/Mover Material</strong></h3>
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
',CClientScript::POS_HEAD);*/
