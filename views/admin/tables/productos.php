<?php
use kartik\grid\GridView;


$columns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        //'header'=>'Codigo',
        'value'=>'codigo',
        'attribute'=>'codigo',
        //'filter'=>CHtml::activeTextField($producto, 'codigo',array("class"=>"form-control")),
    ],
    [
        'header'=>'Cod Pers.',
        'value'=>'codigoPersonalizado',
        //'filter'=>CHtml::activeTextField($producto, 'codigoPersonalizado',array("class"=>"form-control")),
    ],
    [
        'header'=>'Material',
        'value'=>'material',
        //'filter'=>CHtml::activeDropDownList($producto,'material',CHtml::listData(Producto::model()->findAll(array('group'=>'material','select'=>'material')),'material','material'),array("class"=>"form-control",'empty'=>'')),
    ],
    [
        'header'=>'Detalle Producto',
        'value'=>function ($model) {
            return $model->color . ' ' . $model->descripcion.' '.$model->marca;
        },
        //'filter'=>CHtml::activeTextField($producto, 'descripcion',array("class"=>"form-control")),
    ],
    [
        'header'=>'Industria',
        'value'=>'nota',
        //'filter'=>CHtml::activeDropDownList($producto,'nota',CHtml::listData(Producto::model()->with('productoStocks')->findAll(array('group'=>'nota','select'=>'nota','condition'=>'fk_idAlmacen=1')),'nota','nota'),array("class"=>"form-control",'empty'=>'')),
    ],
    //['class' => 'yii\grid\ActionColumn'],
];

echo GridView::widget([

    'dataProvider'=> $producto,
    'filterModel' => $search,
    'columns' => $columns,
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'toolbar' =>  [
        '{export}',
        '{toggleData}',
    ],
    'export' => [
        'fontAwesome' => true
    ],
    //'bordered' => true,
    'condensed' => true,
    'hover'=>true,
    'panel' => [
        'type' => GridView::TYPE_DEFAULT,
        'heading' => 'Productos',
    ],
    'persistResize' => true,
    'exportConfig' => [
        GridView::EXCEL => [
            'label' => 'Excel',
            'filename' => 'Productos',
            'alertMsg' => 'El EXCEL se generara para la descarga.',
        ],
        GridView::PDF => [
            'label' => 'PDF',
            'filename' => 'Productos',
            'alertMsg' => 'El PDF se generara para la descarga.',
        ],
        ]
]);
