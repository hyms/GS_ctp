<?php
    use kartik\grid\GridView;
    use kartik\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

    $columns=[
        [
            'header'=>'Categoria',
            'attribute'=>'codigoCliente',
        ],
        [
            'header'=>'Nit/Ci',
            'attribute'=>'nitCi',
        ],
        [
            'header' => 'Negocio',
            'attribute'=>'nombreNegocio',
        ],
        [
            'header' => 'Dueño',
            'attribute'=>'nombreCompleto',
        ],
        [
            'header' => 'Responsable',
            'attribute'=>'nombreResponsable',
        ],
        [
            'header' => 'Telefono',
            'attribute'=>'telefono',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{update}',
            'buttons'=>[
                'update'=>function($url,$model) {
                    return Html::a(Html::icon('pencil') . ' Modificar',
                                   "#",
                                   [
                                       'onclick'     => 'clickmodal("' . Url::to(['venta/cliente','id'=>$model->idCliente]) . '","Cliente: '.$model->nombreNegocio.'")',
                                       'data-toggle' => "modal",
                                       'data-target' => "#modal"
                                   ]);
                },
            ]
        ],
    ];

    Pjax::begin(['id'=>'cliente']);
    echo GridView::widget([
                              'dataProvider'=> $clientes,
                              'filterModel' => $search,
                              'columns' => $columns,
                              'toolbar' =>  [
                                  [
                                      'content'=>
                                          Html::button('Nuevo Cliente',
                                                       [
                                                           'class'=>'btn btn-default',
                                                           'onclick' => 'clickmodal("' . Url::to(['venta/cliente', 'op' => 'new']) . '","Nuevo Cliente")',
                                                           'data-toggle' => "modal",
                                                           'data-target' => "#modal"
                                                       ]),
                                      'options' => ['class' => 'btn-group']
                                  ],
                                  '{export}',
                                  '{toggleData}',
                              ],
                              // set export properties
                              'export' => [
                                  'fontAwesome' => true,
                                  'target'=>GridView::TARGET_BLANK,
                              ],
                              'responsive'=>true,
                              'hover'=>true,
                              'bordered'=>false,
                              'panel' => [
                                  'type' => GridView::TYPE_DEFAULT,
                                  'heading' => 'Clientes',
                              ],
                              'exportConfig' => [
                                  GridView::EXCEL => [
                                      'label' => 'Excel',
                                      'filename' => 'Reporte Clientes',
                                      'alertMsg' => 'El EXCEL se generara para la descarga.',
                                      'showPageSummary' => true,
                                  ],
                                  GridView::PDF => [
                                      'label' => 'PDF',
                                      'filename' => 'Reporte Clientes',
                                      'alertMsg' => 'El PDF se generara para la descarga.',
                                      'config' => [
                                          'format' => 'Letter-L',
                                          'marginTop' => 5,
                                          'marginBottom' => 5,
                                          'marginLeft' => 5,
                                          'marginRight' => 5,
                                      ]
                                  ],
                              ],
                          ]);
    Pjax::end();