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
        'attribute'=>'nombreUsuario',
        'value'=>function($model){
            return $model->fkIdUser->nombre." ".$model->fkIdUser->apellido;
        },
        'pageSummary'=>'Total',
    ],
    [
        'header'=>'Monto',
        'value'=>'monto',
        'pageSummary'=>true,
    ],
    [
        'header'=>'Fecha de Arqueo',
        'attribute'=>'time',
    ],
    [
        'header'=>'Correlativo',
        'attribute'=>'correlativoCierre',
    ],
    [
        'class'=>'kartik\grid\ActionColumn',
        'template'=>'{print} {registro}',
        'buttons'=>[
            'print'=>function($url,$model){
                $url = Url::to(['admin/print','op'=>'registro','id'=>$model->idMovimientoCaja]);
                $options = array_merge([
                    //'class'=>'btn btn-success',
                    'data-toggle'=>'tooltip',
                    'data-target' => "#modalPage",
                    'title'=>'Comprobante',
                    'onClick'=>'printView("'.$url.'")'
                ]);
                return Html::a(Html::icon('print'), '#', $options);
            },

        ]
    ],
];

$export = ExportMenu::widget([
    'dataProvider' => $arqueos,
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
    'pjaxContainerId'=>'arqueos',
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

Pjax::begin(['id'=>'arqueos']);
echo GridView::widget([
    'dataProvider'=> $arqueos,
    'filterModel' => $search,
    'columns' => $columns,
    'toolbar' =>  [
        $export,
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
        'heading' => 'Historial Arqueos',
    ],
]);
Pjax::end();
echo $this->render('@app/views/share/scripts/modalPage');
