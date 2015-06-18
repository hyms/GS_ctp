<?php
    use kartik\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\Url;

?>
<?=
    Html::a('Recibo Ingreso', "#", [
        'class'=>'btn btn-default',
        'onclick'  => "
                    $.ajax({
                        type    :'POST',
                        cache   : false,
                        url     : '" . Url::to(['venta/recibos', 'op' => 'i']) . "',
                        success : function(data) {
                            if(data.length>0){
                                $('#viewModal .modal-header').html('<h3 class=\"text-center\">Ingreso</h3>');
                                $('#viewModal .modal-body').html(data);
                                $('#viewModal').modal();
                            }
                        }
                    });return false;"
    ]);
?>
<?=
    Html::a('Recibo Egreso', "#", [
        'class'=>'btn btn-default',
        'onclick'  => "
                    $.ajax({
                        type    :'POST',
                        cache   : false,
                        url     : '" . Url::to(['venta/recibos', 'op' => 'e']) . "',
                        success : function(data) {
                            if(data.length>0){
                                $('#viewModal .modal-header').html('<h3 class=\"text-center\">Egreso</h3>');
                                $('#viewModal .modal-body').html(data);
                                $('#viewModal').modal();
                            }
                        }
                    });return false;"
    ]);
?>
<?php
    $columns = [
        [
            'header'=>'Tipo',
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>["Ingreso","Egreso"],
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Seleccionar'],
            'format'=>'raw',
            'value'=>function($model) {
                return (($model->tipoRecibo)?"Egreso":"Ingreso");
            },
            'attribute'=>'tipoRecibo',
        ],

        /*[
            'header'=>'Codigo',
            'attribute'=>'codigo',
        ],*/
        [
            'header'=>'Nombre',
            'attribute'=>'nombre',
        ],
        [
            'header'=>'Monto',
            'attribute'=>'monto',
        ],
        [
            'header'=>'Detalle',
            'attribute'=>'detalle',
        ],
        [
            'header'=>'Fecha',
            'attribute'=>'fechaRegistro',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{update} {print}',
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
                                                            url  : '" . Url::to(['venta/recibos','op'=>'recibo','id'=>$model->idRecibo]) . "',
                                                            success  : function(data) {
                                                                if(data.length>0){
                                                                    $('#viewModal .modal-header').html('<h3 class=\"text-center\">".(($model->tipoRecibo)?'Egreso':'Ingreso')."</h3>');
                                                                    $('#viewModal .modal-body').html(data);
                                                                    $('#viewModal').modal();
                                                                }
                                                            }
                                                        });return false;"
                                           ]);
                    $url     = "#";
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                },
                'print'=>function($url,$model){
                    $options = array_merge([
                                               //'class'=>'btn btn-success',
                                               'data-original-title'=>'Imprimir',
                                               'data-toggle'=>'tooltip',
                                               'title'=>''
                                           ]);
                    $url = Url::to(['venta/print','op'=>'recibo','id'=>$model->idRecibo]);
                    return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, $options);
                },
            ]
        ],
    ];

    echo GridView::widget([
                              'dataProvider'=> $recibos,
                              'filterModel' => $search,
                              'columns' => $columns,
                              'toolbar' =>  [
                                  '{export}',
                                  '{toggleData}',
                              ],
                              // set export properties
                              'export' => [
                                  'fontAwesome' => true
                              ],
                              'responsive'=>true,
                              'hover'=>true,
                              'bordered'=>false,
                              'panel' => [
                                  'type' => GridView::TYPE_DEFAULT,
                                  'heading' => 'Recibos',
                              ],
                              'exportConfig' => [
                                  GridView::EXCEL => [
                                      'label' => 'Excel',
                                      'filename' => 'Recibos',
                                      'alertMsg' => 'El EXCEL se generara para la descarga.',
                                  ],
                                  GridView::PDF => [
                                      'label' => 'PDF',
                                      'filename' => 'Recibos',
                                      'alertMsg' => 'El PDF se generara para la descarga.',
                                  ],
                              ],
                          ]);
?>
