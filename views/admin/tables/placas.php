<?php
    use app\models\ProductoStock;
    use kartik\grid\GridView;

    $columns = [
        [
            'header'=>'Fecha',
            'attribute'=>'fecha',
        ],
        [
            'header'=>'Orden',
            'attribute'=>'orden',
            'pageSummary'=>'Total',
        ]
    ];
    $placas = ProductoStock::find()
        ->joinWith('fkIdProducto')
        ->andWhere(['fk_idSucursal' => $sucursal])
        ->orderBy(['formato'=>SORT_ASC,'dimension'=>SORT_ASC])
        ->all();
    foreach($placas as $placa) {
        array_push($columns, [
            'attribute' => $placa->fkIdProducto->formato,
            'pageSummary'=>true,
        ]);
    }
    array_push($columns,[
        'header'=>'Observaciones',
        'format'=>'raw',
        'attribute'=>'observaciones',
    ]);

    echo GridView::widget([
                              'dataProvider' => $data,
                              //'filterModel' => $search,
                              'columns' => $columns,
                              // set your toolbar
                              'toolbar' =>  [
                                  '{export}',
                              ],
                              // set export properties
                              'export' => [
                                  'fontAwesome' => true,
                                  'target'=>GridView::TARGET_BLANK,
                              ],
                              // parameters from the demo form
                              'bordered' => true,
                              'condensed' => true,
                              'responsive' => true,
                              'hover' => true,
                              'showPageSummary' => true,
                              'panel' => [
                                  'type' => GridView::TYPE_PRIMARY,
                                  'heading' => 'ordenes',
                                  'after'=>'<h3 class="text-right"><span class="label label-default">Total Placas: <strong>'.$total.'</strong></span></h3>',
                                  'footer'=>false,
                              ],
                              'exportConfig' => [
                                  GridView::EXCEL => [
                                      'label' => 'Excel',
                                      'filename' => 'Reporte Placas',
                                      'alertMsg' => 'El EXCEL se generara para la descarga.',
                                      'showPageSummary' => true,
                                  ],
                                  GridView::PDF => [
                                      'label' => 'PDF',
                                      'filename' => 'Reporte Placas',
                                      'alertMsg' => 'El PDF se generara para la descarga.',
                                      'config' => [
                                          'format' => 'Letter',
                                          'marginTop' => 5,
                                          'marginBottom' => 5,
                                          'marginLeft' => 5,
                                          'marginRight' => 5,
                                      ]
                                  ],
                              ],
                          ]);
