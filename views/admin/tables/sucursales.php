<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title"Sucursales</strong>
    </div>
    <div class="panel-body" style="overflow: auto;">
    </div>
    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'header'=>'Nombre',
            'value'=>'nombre',
        ],
        [
            'header'=>'Nombre',
            'value'=>'nombre',
        ],
        [
            'header'=>'Descripcion',
            'value'=>'$data->descripcion',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{update}',
            'buttons'=>[
                'update'=>function($url,$model) {
                    $options = array_merge([
                        //'class'=>'btn btn-success',
                        'data-original-title' => 'Añadir a Stock',
                        'data-toggle'         => 'tooltip',
                        'title'               => '',
                        'onclick'             => "
                                                        $.ajax({
                                                            type     :'POST',
                                                            cache    : false,
                                                            url  : '" . Url::to(['admin/config','op'=>'add','id'=>$model->idProductoStock]) . "',
                                                            success  : function(data) {
                                                                if(data.length>0){
                                                                    $('#viewModal .modal-header').html('<h3 class=\"text-center\">Stock ".((isset($model->fkIdSucursal))?$model->fkIdSucursal->nombre:'Deposito')."</h3>');
                                                                    $('#viewModal .modal-body').html(data);
                                                                    $('#viewModal').modal();
                                                                }
                                                            }
                                                        });return false;"
                    ]);
                    return Html::a('<span class="glyphicon glyphicon-import"></span>', "#", $options);
                },
            ]
        ],
    ]
    /*array(
    array(
        'header'=>'Nombre',
        'value'=>'$data->nombre',
    ),
    /*array(
            'header'=>'Superior',
            'value'=>'$data->idProducto0->material',
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
                    'url'=>'array("configuration/sucursal","id"=>$data->idSucursal)',
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
$this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$sucursales->search()))*/
    ?>
</div>