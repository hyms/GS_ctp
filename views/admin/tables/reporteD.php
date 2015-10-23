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
            'header'=>'Usuario',
            'value'=>function($model){
                if(empty($model->fkIdUserV))
                    return "";
                return $model->fkIdUserV->nombre;
            },
        ],
        [
            'header'=>'Correlativo',
            'value'=>'correlativo',
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
            'header'=>'Cliente',
            'value'=>function($model)
            {
                if(empty($model->fkIdCliente))
                    return "";
                return $model->fkIdCliente->nombreNegocio;
            },
            //'pageSummary'=>'Total',
        ],
        [
            'header'=>'CAT',
            'value'=>function($model)
            {
                if(empty($model->fkIdCliente))
                    return "C";
                return $model->fkIdCliente->codigoCliente;
            },
            //'pageSummary'=>'Total',
        ],
        [
            'header'=>'Responsable',
            'value'=>'responsable',
        ],
        [
            'header'=>'Trabajo',
            'format'=>'raw',
            'value'=>function($model){
                $trabajos = $model->ordenDetalles;
                $string ="";
                foreach($trabajos as $key=>$trabajo)
                {
                    $string =$string."<p>".$trabajo->trabajo."</p>";
                }
                return $string;
            },
        ],
        [
            'header'=>'Placa',
            'format'=>'raw',
            'value'=>function($model){
                $trabajos = $model->ordenDetalles;
                $string ="";
                foreach($trabajos as $key=>$trabajo)
                {
                    $string =$string."<p>".$trabajo->fkIdProductoStock->fkIdProducto->formato."</p>";
                }
                return $string;
            },
        ],
        [
            'header'=>'Cant',
            'format'=>'raw',
            'value'=>function($model){
                $trabajos = $model->ordenDetalles;
                $string ="";
                foreach($trabajos as $key=>$trabajo)
                {
                    $string =$string."<p>".$trabajo->cantidad."</p>";
                }
                return $string;
            },
        ],
        [
            'header'=>'Costo',
            'format'=>'raw',
            'value'=>function($model){
                $trabajos = $model->ordenDetalles;
                $string ="";
                foreach($trabajos as $key=>$trabajo)
                {
                    $string =$string."<p>".$trabajo->costo."</p>";
                }
                return $string;
            },
        ],
        [
            'header'=>'Q/Arm',
            'format'=>'raw',
            'value'=>function($model){
                $trabajos = $model->ordenDetalles;
                $string ="";
                foreach($trabajos as $key=>$trabajo)
                {
                    $string =$string."<p>".$trabajo->adicional."</p>";
                }
                return $string;
            },
        ],
        [
            'header'=>'Total',
            'format'=>'raw',
            'value'=>function($model){
                $trabajos = $model->ordenDetalles;
                $string ="";
                foreach($trabajos as $key=>$trabajo)
                {
                    $string =$string."<p>".$trabajo->total."</p>";
                }
                return $string;
            },
        ],
        [
            'header'=>'Desc',
            'value'=>function($model){
                return (empty($model->montoDescuento))?0:$model->montoDescuento;
            },
        ],
        [
            'header'=>'Cobrar',
            'value'=>'montoVenta',
            'pageSummary'=>true,
        ],
        [
            'header'=>'Cancelado',
            'value'=>function($model) use($fechaStart,$fechaEnd) {
                $pagos = \app\models\MovimientoCaja::find()
                    ->where(['idParent' => $model->fk_idMovimientoCaja])
                    ->andWhere(['tipoMovimiento' => 0])
                    ->andWhere(['<=', 'time', $fechaEnd . ' 23:59:59'])
                    ->andWhere(['not between', 'time', date("Y-m-d",strtotime($model->fechaCobro)) . ' 00:00:00', date("Y-m-d",strtotime($model->fechaCobro)) . ' 23:59:59'])
                    ->all();
                $total = 0;
                foreach ($pagos as $pago) {
                    $total += $pago->monto;
                }

                return $total;
            },
            'pageSummary'=>true,
        ],
        [
            'header'=>'Saldo',
            'value'=>function($model) use ($fechaStart,$fechaEnd){
                $pagos = \app\models\MovimientoCaja::find()
                    ->where(['idParent' => $model->fk_idMovimientoCaja])
                    ->andWhere(['<=', 'time', $fechaEnd . ' 23:59:59'])
                    ->andWhere(['tipoMovimiento' => 0])
                    ->all();
                $total = 0;
                foreach ($pagos as $pago) {
                    $total += $pago->monto;
                }
                return ($model->montoVenta-($model->fkIdMovimientoCaja->monto+$total));
            },
            'pageSummary'=>true,
        ],
        [
            'header'=>'Factura',
            'value'=>function($model){
                return (empty($model->factura))?"":$model->factura;
            },
        ],
        [
            'header'=>'Obs',
            'value'=>function($model) {
                return ($model->observacionesCaja);
            },
        ],
        [
            'header'=>'Fecha',
            'format'=>'raw',
            'value'=>function($model) use ($fechaStart,$fechaEnd){
                $pagos = \app\models\MovimientoCaja::find()
                    ->where(['idParent' => $model->fk_idMovimientoCaja])
                    ->andWhere(['tipoMovimiento' => 0])
                    ->andWhere(['<=', 'time', $fechaEnd . ' 23:59:59'])
                    ->andWhere(['not between', 'time', date("Y-m-d",strtotime($model->fkIdMovimientoCaja->time)) . ' 00:00:00', date("Y-m-d",strtotime($model->fkIdMovimientoCaja->time)) . ' 23:59:59'])
                    ->all();
                $fecha = "";
                foreach ($pagos as $pago) {
                    $fecha = $fecha . "<p>" .date("Y-m-d/H:i", strtotime($pago->time)) . "</p>";
                }
                return $fecha;
            },
        ],
        [
            'header'=>'Monto',
            'format'=>'raw',
            'value'=>function($model) use ($fechaStart,$fechaEnd){
                $pagos = \app\models\MovimientoCaja::find()
                    ->where(['idParent' => $model->fk_idMovimientoCaja])
                    ->andWhere(['tipoMovimiento' => 0])
                    ->andWhere(['<=', 'time',$fechaEnd . ' 23:59:59'])
                    ->andWhere(['not between', 'time', date("Y-m-d",strtotime($model->fkIdMovimientoCaja->time)) . ' 00:00:00', date("Y-m-d",strtotime($model->fkIdMovimientoCaja->time)) . ' 23:59:59'])
                    ->all();
                $fecha = "";
                foreach ($pagos as $pago) {
                    $fecha = $fecha . "<p>" . $pago->monto . "</p>";
                }
                return $fecha;
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
                              'rowOptions' => function ($model, $index, $widget, $grid){
                                  if($model->estado<0){
                                      return ['class' => GridView::TYPE_DANGER];
                                  }else{
                                      return [];
                                  }
                              },
                              // set your toolbar
                              'toolbar' =>  [
                                  $export,
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
                              'floatHeader'=>true,
                              'floatHeaderOptions'=>['scrollingTop'=>'0'],
                              'panel' => [
                                  'type' => GridView::TYPE_DEFAULT,
                                  'heading' => Html::tag('strong','Reporte de Ordenes'),
                              ],
                          ]);
    Pjax::end();
