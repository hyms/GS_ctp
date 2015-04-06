<?php
use kartik\grid\GridView;

$columns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'header'=>'Formato',
        'value'=>'color',
        'attribute'=>'color',
        //'filter'=>CHtml::activeTextField($producto, 'codigo',array("class"=>"form-control")),
    ],
    [
        'header'=>'Tamaño',
        'value'=>'descripcion',
        'attribute'=>'descripcion',
        //'filter'=>CHtml::activeTextField($producto, 'codigoPersonalizado',array("class"=>"form-control")),
    ],
    /*[
        'header'=>'Stock',
        'value'=>'cantidad',
        'attribute'=>'cantidad',
        //'filter'=>CHtml::activeDropDownList($producto,'material',CHtml::listData(Producto::model()->findAll(array('group'=>'material','select'=>'material')),'material','material'),array("class"=>"form-control",'empty'=>'')),
    ],*/
    //['class' => 'yii\grid\ActionColumn'],
];

echo GridView::widget([
    'dataProvider'=> $producto,
    'filterModel' => $search,
    'columns' => $columns,
    'condensed' => true,
    'hover'=>true,
]);
?>
<?php ///Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/addListCTP.js',CClientScript::POS_HEAD); ?>