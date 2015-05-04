<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$columns = [
    [
        'header'=>'Codigo',
        'value'=>function($model){
            return $model->fkIdProducto->codigo;
        },
    ],
    [
        'header'=>'Material',
        'value'=>function($model){
            return $model->fkIdProducto->material;
        },
    ],
    [
        'header'=>'Detalle Producto',
        'value'=>function($model){
            return $model->fkIdProducto->formato." ".$model->fkIdProducto->dimension;
        },
    ],
    [
        'header'=>'Cant.xPaqt.',
        'value'=>function($model){
            return $model->fkIdProducto->cantidadPaquete;
        },
    ],
    [
        'header'=>'',
        'format'=>'raw',
        'value'=>function($model,$idSucursal) {
            $producto = \app\models\ProductoStock::findOne([
                'fk_idProducto' => $model->fk_idProducto,
                'fk_idSucursal' => $idSucursal,
            ]);
            $detalle = $model->fkIdProducto->material . " " . $model->fkIdProducto->formato . " " . $model->fkIdProducto->dimension;
            print_r($producto);
            if (empty($producto))
                return Html::a("<span class=\"glyphicon glyphicon-ok\"></span>Añadir", array('producto/AlmacenAdd', "producto" => $model->fk_idProducto, "id" => $model->fk_idSucursal), array('class' => 'btn btn-success btn-sm', 'title' => 'Añadir Producto', 'onclick' => "return confirm('Desea añadir el producto " . $detalle . "?')"));
            else
                return Html::a("<span class=\"glyphicon glyphicon-remove\"></span>Eliminar", array("producto/productoDel", "producto" => $model->fk_idProducto, "id" => $model->fk_idSucursal), array('class' => 'btn btn-danger btn-sm', 'title' => 'Eliminar Producto', 'onclick' => "return confirm('Desea eliminar el producto " . $detalle . "?')"));
        },
    ]
];

echo GridView::widget([

    'dataProvider'=> $productos,
    'filterModel' => $search,
    'columns' => $columns,
    'toolbar' =>  [
        '{toggleData}',
    ],
    //'bordered' => true,
    'condensed' => true,
    'hover'=>true,
    'panel' => [
        'type' => GridView::TYPE_DEFAULT,
        'heading' => 'Lista de Productos - '.$nombre,
    ],
    'persistResize' => true,
]);
/*
if(!empty($productos)){
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Lista de Productos</strong> : <?php echo $nombre; ?>
    </div>
    <div class="panel-body" style="overflow: auto;">

    <?php

    $columns = array(
        array(
            'header'=>'',
            'type'=>'raw',
            'value'=>'$data->fkIdProducto->getLink($data->fk_idProducto,'.$idAlmacen.')',
        ),
    );
    $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$productos->searchProducto('codigo, material'),'filter'=>$productos))

    ?>
    </div>
</div>
<?php
}
*/