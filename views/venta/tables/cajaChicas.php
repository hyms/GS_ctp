<?php
    use kartik\grid\GridView;
    use kartik\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

    $columns = [
        [
            'header'=>'Usuario',
            'attribute'=>function($model)
            {
                return $model->fkIdUser->username;
            }
        ],
        [
            'header'=>'Nombre',
            'attribute'=>'nombreUsuario',
            'value'=>function($model)
            {
                return $model->fkIdUser->nombre." ".$model->fkIdUser->apellido;
            }
        ],
        [
            'header'=>'Monto',
            'attribute'=>'monto',
        ],
        [
            'header'=>'Detalle',
            'attribute'=>'observaciones',
        ],
        [
            'header'=>'Fecha',
            'attribute'=>'time',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{update}',
            'buttons'=>[
                'update'=>function($url,$model) {
                    if (!empty($model->fechaCierre))
                        return "";
                    return Html::a(Html::icon('pencil') . ' Modificar',
                                   "#",
                                   [
                                       'onclick'     => 'clickmodal("' . Url::to(['venta/chica', 'id' => $model->idMovimientoCaja, 'op' => 'mod']) . '","Caja Chica")',
                                       'data-toggle' => "modal",
                                       'data-target' => "#modal"
                                   ]);
                }   ,
            ]
        ],
    ];
    Pjax::begin(['id'=>'cajaChica']);
    echo GridView::widget([
                              'dataProvider'=> $cajasChicas,
                              'filterModel' => $search,
                              'columns' => $columns,
                              'toolbar' =>  [
                                  [
                                      'content'=>
                                          Html::button('Nuevo Transaccion',
                                                       [
                                                           'class'=>'btn btn-default',
                                                           'onclick' => 'clickmodal("' . Url::to(['venta/chica','op'=>'new']) . '","Caja Chica")',
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
                                  'heading' => 'Caja Chica',
                              ],
                              'exportConfig' => [
                                  GridView::EXCEL => [
                                      'label' => 'Excel',
                                      'filename' => 'Reporte Caja Chica',
                                      'alertMsg' => 'El EXCEL se generara para la descarga.',
                                      'showPageSummary' => true,
                                  ],
                                  GridView::PDF => [
                                      'label' => 'PDF',
                                      'filename' => 'Reporte Caja Chica',
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
