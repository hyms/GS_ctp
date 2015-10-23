<?php
use kartik\export\ExportMenu;
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
$export = ExportMenu::widget([
    'dataProvider' => $clientes,
    'columns' => $columns,
    'fontAwesome' => true,
    'hiddenColumns'=>[6], // SerialColumn, Color, & ActionColumn
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
    'pjaxContainerId'=>'cliente',
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
        ' '.
        $export,
    ],
    // set export properties
    'responsive'=>true,
    'hover'=>true,
    'bordered'=>false,
    'panel' => [
        'type' => GridView::TYPE_DEFAULT,
        'heading' =>Html::tag('strong','Clientes',['class'=>'panel-title']),
    ],
    'export' => [
        'fontAwesome' => true,
        'target'=>GridView::TARGET_BLANK,
    ],
]);
Pjax::end();