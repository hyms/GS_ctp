<?php
    use app\models\Sucursal;
    use kartik\grid\GridView;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use yii\helpers\Url;

?>
<?php
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
                                                            url  : '" . Url::to(['admin/cliente','id'=>$model->idCliente]) . "',
                                                            success  : function(data) {
                                                                if(data.length>0){
                                                                    $('#viewModal .modal-header').html('<h3 class=\"text-center\">Cliente: ".$model->nombreNegocio."</h3>');
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
                              'dataProvider'=> $clientes,
                              'filterModel' => $search,
                              'columns' => $columns,
                              'toolbar' =>  [
                                  [
                                      'content'=>
                                          Html::a('Nuevo Cliente', "#", [
                                              'class'=>'btn btn-default',
                                              'onclick'  => "
                    $.ajax({
                        type    :'POST',
                        cache   : false,
                        url     : '" . Url::to(['admin/cliente', 'op' => 'new']) . "',
                        success : function(data) {
                            if(data.length>0){
                                $('#viewModal .modal-header').html('<h3 class=\"text-center\">Nuevo Cliente</h3>');
                                $('#viewModal .modal-body').html(data);
                                $('#viewModal').modal();
                            }
                        }
                    });return false;"
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
?>
