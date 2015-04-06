<?php
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
            'header'=>'Codigo',
            'value'=>'$data->fkIdProducto->codigo',
            'filter'=>CHtml::activeTextField($productos, 'codigo',array("class"=>"form-control")),
        ),
        array(
            'header'=>'Material',
            'value'=>'$data->fkIdProducto->material',
            'filter'=>CHtml::activeDropDownList($productos,'material',CHtml::listData(Producto::model()->with('productoStocks')->findAll(array('group'=>'material','select'=>'material','condition'=>'fk_idAlmacen=1')),'material','material'),array("class"=>"form-control ",'empty'=>'')),
        ),
        array(
            'header'=>'Detalle Producto',
            'value'=>'$data->fkIdProducto->color." ".$data->fkIdProducto->descripcion." ".$data->fkIdProducto->marca',
            'filter'=>CHtml::activeTextField($productos, 'detalle',array("class"=>"form-control")),
        ),
        array(
            'header'=>'Industria',
            'value'=>'$data->fkIdProducto->nota',
        ),
        array(
            'header'=>'Cant.xPaqt.',
            'value'=>'$data->fkIdProducto->cantidadPaquete'
        ),
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