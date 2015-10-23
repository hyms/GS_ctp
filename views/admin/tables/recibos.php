<?php
    use app\models\Sucursal;
    use kartik\export\ExportMenu;
    use kartik\grid\GridView;
    use kartik\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Url;
    use yii\widgets\Pjax;


    $columns = [
    [
        'header'=>'Sucursal',
        'attribute'=>'fk_idSucursal',
        //'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(Sucursal::find()->all(),'idSucursal','nombre'),
        //'filterWidgetOptions'=>[
        //    'pluginOptions'=>['allowClear'=>true],
        //],
        //'filterInputOptions'=>['placeholder'=>'Seleccionar'],
        'format'=>'raw',
        'value'=>function($model){
            if(empty($model->fk_idSucursal))
                return "";
            return $model->fkIdSucursal->nombre;
        },
    ],
    [
        'header'=>'Tipo',
        //'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>["Egreso","Ingreso"],
        //'filterWidgetOptions'=>[
        //    'pluginOptions'=>['allowClear'=>true],
        //],
        //'filterInputOptions'=>['placeholder'=>'Seleccionar'],
        'format'=>'raw',
        'value'=>function($model) {
            return (($model->tipoRecibo)?"Ingreso":"Egreso");
        },
        'attribute'=>'tipoRecibo',
    ],

    /*[
        'header'=>'Codigo',
        'attribute'=>'codigo',
    ],*/
    [
        'header'=>'Nombre',
        'attribute'=>'nombre',
        'pageSummary'=>'Total',
    ],
    [
        'header'=>'Monto',
        'attribute'=>'monto',
        'pageSummary'=>true,
    ],
    [
        'header'=>'Detalle',
        'attribute'=>'detalle',
    ],
    [
        'header'=>'Fecha',
        'attribute'=>'fechaRegistro',
    ],
    [
        'class'=>'kartik\grid\ActionColumn',
        'template'=>'{update} {print}',
        'buttons'=>[
            'update'=>function($url,$model) {
                if(!empty($model->fkIdMovimientoCaja))
                    if(!empty($model->fkIdMovimientoCaja->fechaCierre))
                        return "";
                return Html::a(Html::icon('pencil') . ' Modificar',
                    "#",
                    [
                        'onclick'     => 'clickmodal("' .Url::to(['admin/recibos','op'=>'recibo','id'=>$model->idRecibo]) . '",".'.(($model->tipoRecibo)?"Ingreso":"Egreso").'")',
                        'data-toggle' => "modal",
                        'data-target' => "#modal"
                    ]);
            },
            'print'=>function($url,$model){
                $url = Url::to(['venta/print','op'=>'recibo','id'=>$model->idRecibo]);
                $options = array_merge([
                    //'class'=>'btn btn-success',
                    'data-toggle'=>'tooltip',
                    'data-target' => "#modalPage",
                    'title'=>'Imprimir',
                    'onClick'=>'printView("'.$url.'")'
                ]);
                return Html::a(Html::icon('print'), '#', $options);
            },
        ]
    ],
];

$export = ExportMenu::widget([
    'dataProvider' => $recibos,
    'columns' => $columns,
    'fontAwesome' => true,
    'hiddenColumns'=>[5], // ActionColumn
    'dropdownOptions' => [
        'label' => 'Exportar',
        'class' => 'btn btn-default'
    ],
    'stream' => false, // this will automatically save the file to a folder on web server
    'streamAfterSave' => true, // this will stream the file to browser after its saved on the web folder
    'deleteAfterSave' => true, // this will delete the saved web file after it is streamed to browser,
    'target' => ExportMenu::TARGET_BLANK,
    'clearBuffers'=>true,
    'pjaxContainerId'=>'recibo',
    'exportConfig' => [
        ExportMenu::FORMAT_HTML =>false,
        ExportMenu::FORMAT_CSV =>false,
        ExportMenu::FORMAT_TEXT =>false,
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

Pjax::begin(['id'=>'recibo']);
echo GridView::widget([
    'dataProvider'=> $recibos,
    'filterModel' => $search,
    'columns' => $columns,
    'responsive'=>true,
    'hover'=>true,
    'bordered'=>false,
    'showPageSummary' => true,
    'toolbar' =>  [
        [
            'content'=>
                Html::button('Recibo Ingreso',
                             [
                                 'class'=>'btn btn-default',
                                 'onclick' => 'clickmodal("' . Url::to(['admin/recibos', 'op' => 'i']) . '","Recibo de Ingreso")',
                                 'data-toggle' => "modal",
                                 'data-target' => "#modal"
                             ])
                ." ".
                Html::button('Recibo Egreso',
                             [
                                 'class'=>'btn btn-default',
                                 'onclick' => 'clickmodal("' . Url::to(['admin/recibos', 'op' => 'e']) . '","Recibo de Egreso")',
                                 'data-toggle' => "modal",
                                 'data-target' => "#modal"
                             ]),
            'options' => ['class' => 'btn-group']
        ],
        $export,
    ],
    'panel' => [
        'type' => GridView::TYPE_DEFAULT,
        'heading' =>Html::tag('strong','Recibos',['class'=>'panel-title']),
    ],
    'export' => [
        'fontAwesome' => true,
        'target'=>GridView::TARGET_BLANK,
    ],
]);

Pjax::end();
echo $this->render('@app/views/share/scripts/modalPage');
    echo $this->render('@app/views/share/scripts/modal',['nameTable'=>'recibo']);