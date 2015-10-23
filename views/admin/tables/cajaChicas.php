<?php
    use app\models\Sucursal;
    use kartik\export\ExportMenu;
    use kartik\grid\GridView;
    use kartik\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\widgets\Pjax;

    $columns = [
    [
        'header'=>'Sucursal',
        'attribute'=>'sucursal',
        //'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(Sucursal::find()->all(),'idSucursal','nombre'),
        //'filterWidgetOptions'=>[
        //    'pluginOptions'=>['allowClear'=>true],
        //],
        //'filterInputOptions'=>['placeholder'=>'Seleccionar'],
        'format'=>'raw',
        'value'=>function($model){
            return $model->fkIdCajaOrigen->fkIdSucursal->nombre;
        },
    ],
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
        },
        'pageSummary'=>'Total',
    ],
    [
        'header'=>'Monto',
        'attribute'=>'monto',
        'pageSummary'=>true,
    ],
    [
        'header'=>'Detalle',
        'attribute'=>'observaciones',
    ],
    [
        'header'=>'Fecha',
        'attribute'=>'time',
    ],
];

$export = ExportMenu::widget([
    'dataProvider' => $cajasChicas,
    'columns' => $columns,
    'fontAwesome' => true,
    //'hiddenColumns'=>[5], // SerialColumn, Color, & ActionColumn
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
    'showPageSummary' => true,
    'toolbar' => [
        $export,
    ],
    'panel' => [
        'heading'=>Html::tag('strong','Caja Chica',['class'=>'panel-title']),
        'type'=>GridView::TYPE_DEFAULT,
    ],
    'export' => [
        'fontAwesome' => true,
        'target'=>GridView::TARGET_BLANK,
    ],
]);
Pjax::end();
