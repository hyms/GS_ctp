<?php
use kartik\grid\GridView;

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
        '{export}',
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
        'type' => GridView::TYPE_PRIMARY,
        'heading' => 'ordenes',
        'footer'=>false,
    ],
    'exportConfig' => [
        GridView::EXCEL => [
            'label' => 'Excel',
            'filename' => 'Reporte Venta',
            'alertMsg' => 'El EXCEL se generara para la descarga.',
            'showPageSummary' => true,
        ],
        GridView::PDF => [
            'label' => 'PDF',
            'filename' => 'Reporte Venta',
            'alertMsg' => 'El PDF se generara para la descarga.',
            'config' => [
                'format' => 'Letter',
                'defaultFontSize'=>7,
                'marginTop' => 5,
                'marginBottom' => 5,
                'marginLeft' => 5,
                'marginRight' => 5,
                //'cssFile'      => '@webroot/css/bootstrap.min.readable.css',
            ]
        ],
    ],
]);
