<?php
    use kartik\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\Url;

    $columns = [
        [
            'header'=>'Usuario',
            'attribute'=>'nombreUsuario',
            'value'=>function($model){
                return $model->fkIdUser->nombre." ".$model->fkIdUser->apellido;
            },
        ],
        [
            'header'=>'Monto',
            'value'=>'monto',
        ],
        [
            'header'=>'Fecha de Arqueo',
            'attribute'=>'time',
        ],
        [
            'header'=>'Correlativo',
            'attribute'=>'correlativoCierre',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{print} {registro}',
            'buttons'=>[
                'print'=>function($url,$model){
                    $options = array_merge([
                                               //'class'=>'btn btn-success',
                                               'data-original-title'=>'Imprimir',
                                               'data-toggle'=>'tooltip',
                                               'title'=>''
                                           ]);
                    $url = Url::to(['venta/print','op'=>'arqueo','id'=>$model->idMovimientoCaja]);
                    return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, $options);
                },
                'registro'=>function($url,$model){
                    $options = array_merge([
                                               //'class'=>'btn btn-success',
                                               'data-original-title'=>'Registro',
                                               'data-toggle'=>'tooltip',
                                               'title'=>''
                                           ]);
                    $url = Url::to(['venta/print','op'=>'registro','id'=>$model->idMovimientoCaja]);
                    return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', $url, $options);
                },
            ]
        ],
    ];

    echo GridView::widget([
                              'dataProvider'=> $arqueos,
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
                                  'heading' => 'Historial Arqueos',
                              ],
                              'exportConfig' => [
                                  GridView::EXCEL => [
                                      'label' => 'Excel',
                                      'filename' => 'Arqueos',
                                      'alertMsg' => 'El EXCEL se generara para la descarga.',
                                  ],
                                  GridView::PDF => [
                                      'label' => 'PDF',
                                      'filename' => 'Arqueos',
                                      'alertMsg' => 'El PDF se generara para la descarga.',
                                  ],
                              ],
                          ]);
?>
