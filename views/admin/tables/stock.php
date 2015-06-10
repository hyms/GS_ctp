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
                                               'data-original-title' => 'Añadir a Stock',
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
                    return Html::a('<span class="glyphicon glyphicon-import"></span>', "#", $options);
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
