<?php
    use kartik\export\ExportMenu;
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
            },
        ]
    ],
];

$export = ExportMenu::widget([
    'dataProvider' => $cajasChicas,
    'columns' => $columns,
    'fontAwesome' => true,
    'hiddenColumns'=>[5], // SerialColumn, Color, & ActionColumn
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
    'pjaxContainerId'=>'cajaChica',
    'exportConfig' => [
        ExportMenu::FORMAT_HTML =>false,
        ExportMenu::FORMAT_CSV =>false,
        ExportMenu::FORMAT_TEXT =>false,
        //ExportMenu::FORMAT_EXCEL =>false,

        /*ExportMenu::FORMAT_EXCEL_X => [
            'label' => 'Excel',
            'filename' => 'Reporte Clientes',
            'alertMsg' => 'El EXCEL se generara para la descarga.',
            //'showPageSummary' => true,
        ],*/
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

Pjax::begin(['id'=>'cajaChica']);
echo GridView::widget([
    'dataProvider'=> $cajasChicas,
    'filterModel' => $search,
    'columns' => $columns,
    'responsive'=>true,
    'hover'=>true,
    'bordered'=>false,
    'toolbar' => [
        [
            'content'=>
                Html::button('Nuevo Transaccion',
                    [
                        'class'=>'btn btn-default',
                        'onclick' => 'clickmodal("' . Url::to(['venta/chica','op'=>'new']) . '","Caja Chica")',
                        'data-toggle' => "modal",
                        'data-target' => "#modal"
                    ])
        ],
        ' '.
        $export,
    ],
    'panel' => [
        'heading'=>Html::tag('strong','Caja Chica'),
        'type'=>GridView::TYPE_DEFAULT,
    ],
    'export' => [
        'fontAwesome' => true,
        'target'=>GridView::TARGET_BLANK,
    ],
]);
Pjax::end();

