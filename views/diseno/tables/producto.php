<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$columns = [
    [
        'header'=>Html::tag('span','PLACAS',['class'=>'panel-title']),
        'value'=>function($model) {
            return $model->fkIdProducto->formato . " " . $model->fkIdProducto->dimension;
        }
    ]
];

echo GridView::widget([
    'dataProvider'=> $producto,
    'columns' => $columns,
    'responsive'=>true,
    'hover'=>true,
    'layout'=>'{items}',
    'rowOptions' => function ($model, $index, $widget, $grid) use ($tipo){
        return [
            'onClick'=>'newRow('.$model->idProductoStock.',"'. Url::toRoute('add_detalle').'",'.$tipo.');return false;',
            'data-toggle'=>'tooltip',
            'title'=>'Añadir'];
    },
]);
echo $this->render('../scripts/addList');

