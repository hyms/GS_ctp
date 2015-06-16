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
                                  '{toggleData}',
                              ],
                              // set export properties
                              'export' => [
                                  'fontAwesome' => true
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
                              ],
                              'exportConfig' => [
                                  GridView::EXCEL => [
                                      'label' => 'Excel',
                                      'filename' => 'Reporte',
                                      'alertMsg' => 'El EXCEL se generara para la descarga.',
                                  ],
                                  GridView::PDF => [
                                      'label' => 'PDF',
                                      'filename' => 'Reporte',
                                      'alertMsg' => 'El PDF se generara para la descarga.',
                                  ],
                              ],
                          ]);
