<?php
use app\models\Sucursal;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$columns=[
        [
            'header'=>'Sucursal',
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Sucursal::find()->all(),'idSucursal','nombre'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Seleccionar'],
            'format'=>'raw',
            'value'=>function($model)
            {
                return $model->fkIdSucursal->nombre;
            },
            'attribute'=>'fk_idSucursal',
        ],
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
            'class' => 'kartik\grid\ActionColumn',
            'template'=>'{update}',
            'buttons'=>[
                    'update'=>function($url,$model) {
                        return Html::a(Html::icon('pencil') . ' Modificar',
                                       "#",
                                       [
                                           'onclick'     => 'clickmodal("' . Url::to(['admin/cliente','id'=>$model->idCliente]) . '","Cliente: '.$model->nombreNegocio.'")',
                                           'data-toggle' => "modal",
                                           'data-target' => "#modal"
                                       ]);
                },
            ]
        ],
    ];
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
                                                           'onclick' => 'clickmodal("' .  Url::to(['admin/cliente', 'op' => 'new'])  . '","Nuevo Cliente")',
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
    echo $this->render('@app/views/share/scripts/modal',['nameTable'=>'Clientes']);