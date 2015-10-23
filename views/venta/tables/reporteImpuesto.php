<?php
    use kartik\export\ExportMenu;
    use kartik\grid\GridView;
    use kartik\helpers\Html;
    use yii\widgets\Pjax;

    $columns = [
        [
            'class' => '\kartik\grid\SerialColumn'
        ],
        [
            'header'=>'Codigo',
            'value'=>function($model){
                if(empty($model->codigoServicio))
                    return "";
                return $model->codigoServicio;
            },
        ],
        [
            'header'=>'Fecha',
            'value'=>function($model){
                return date("Y-m-d H:i",strtotime($model->fechaCobro));
            },
        ],
        [
            'header'=>'Responsable',
            'format'=>'raw',
            'value'=>function($model) {
                return '<span class="text-uppercase">' . $model->responsable . '</span>';
            }
        ],
        [
            'header'=>'Cobrar',
            'value'=>'montoVenta',
            'pageSummary'=>true,
        ],
        [
            'header'=>'Factura',
            'value'=>function($model){
                return (empty($model->factura))?"":$model->factura;
            },
        ],
    ];

    $export = ExportMenu::widget([
                                     'dataProvider' => $data,
                                     'columns' => $columns,
                                     'fontAwesome' => true,
                                     //'hiddenColumns'=>[20], // SerialColumn, Color, & ActionColumn
                                     //'noExportColumns'=>[6], // Status
                                     'dropdownOptions' => [
                                         'label' => 'Exportar',
                                         'class' => 'btn btn-default'
                                     ],
                                     'stream' => false, // this will automatically save the file to a folder on web server
                                     'streamAfterSave' => true, // this will stream the file to browser after its saved on the web folder
                                     'deleteAfterSave' => true, // this will delete the saved web file after it is streamed to browser,
                                     'target' => ExportMenu::TARGET_BLANK,
                                     'clearBuffers'=>true,
                                     'pjaxContainerId'=>'reporte',
                                     'exportConfig' => [
                                         ExportMenu::FORMAT_HTML =>false,
                                         ExportMenu::FORMAT_CSV =>false,
                                         ExportMenu::FORMAT_TEXT =>false,
                                         //ExportMenu::FORMAT_EXCEL =>false,

                                         ExportMenu::FORMAT_PDF => [
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

    Pjax::begin(['id'=>'reporte']);
    echo GridView::widget([
                              'dataProvider' => $data,
                              //'filterModel' => $search,
                              'columns' => $columns,
                              // set your toolbar
                              'rowOptions' => function ($model, $index, $widget, $grid){
                                  if($model->estado<0){
                                      return ['class' => GridView::TYPE_DANGER];
                                  }else{
                                      return [];
                                  }
                              },
                              'toolbar' =>  [
                                  $export,
                              ],
                              'containerOptions'=>['style'=>'overflow: auto'],
                              // set export properties
                              'export' => [
                                  'fontAwesome' => true,
                                  'target'=>GridView::TARGET_BLANK,
                              ],
                              // parameters from the demo form
                              'bordered' => true,
                              'condensed' => true,
                              'responsive'=> false,
                              'responsiveWrap'=> true,
                              'hover' => true,
                              'showPageSummary' => true,
                              'floatHeader'=>true,
                              'floatHeaderOptions'=>['scrollingTop'=>'0'],
                              'panel' => [
                                  'type' => GridView::TYPE_DEFAULT,
                                  'heading' => Html::tag('strong','Reporte de Ordenes'),
                              ],
                          ]);
    Pjax::end();