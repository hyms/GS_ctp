<?php
    use app\models\Sucursal;
    use kartik\grid\GridView;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use yii\helpers\Url;

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
            'registro'=>function($url,$model){
                $options = array_merge([
                    //'class'=>'btn btn-success',
                    'data-original-title'=>'Registro Diario',
                    'data-toggle'=>'tooltip',
                    'title'=>''
                ]);
                $url = Url::to(['admin/print','op'=>'registro','id'=>$model->idMovimientoCaja]);
                return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', $url, $options);
            },
        ]
    ],
];

echo GridView::widget([
    'dataProvider'=> $arqueos,
    'filterModel' => $search,
    'columns' => $columns,
    'toolbar' =>  [
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
    'showPageSummary' => true,
    'bordered'=>false,
    'panel' => [
        'type' => GridView::TYPE_DEFAULT,
        'heading' => 'Historial Arqueos',
        'footer'=>false,
    ],
    'exportConfig' => [
        GridView::EXCEL => [
            'label' => 'Excel',
            'filename' => 'Reporte Arqueos',
            'alertMsg' => 'El EXCEL se generara para la descarga.',
            'showPageSummary' => true,
        ],
        GridView::PDF => [
            'label' => 'PDF',
            'filename' => 'Reporte Arqueos',
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
