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
            'value'=>function($model) use ($idSucursal) {
                $producto = \app\models\ProductoStock::findOne([
                                                                   'fk_idProducto' => $model->fk_idProducto,
                                                                   'fk_idSucursal' => $idSucursal,
                                                               ]);
                $detalle = $model->fkIdProducto->material . " " . $model->fkIdProducto->formato . " " . $model->fkIdProducto->dimension;
                if (empty($producto))
                    return Html::a("<span class=\"glyphicon glyphicon-ok\"></span>Añadir", array('admin/producto', "op"=>"add", "producto" => $model->fk_idProducto, "id" => $idSucursal), array('class' => 'btn btn-success btn-sm', 'title' => 'Añadir Producto', 'onclick' => "return confirm('Desea añadir el producto " . $detalle . "?')"));
                else
                    return Html::a("<span class=\"glyphicon glyphicon-remove\"></span>Eliminar", array("admin/producto", "op"=>"rem", "producto" => $producto->idProductoStock, "id" => $producto->fk_idSucursal), array('class' => 'btn btn-danger btn-sm', 'title' => 'Eliminar Producto', 'onclick' => "return confirm('Desea eliminar el producto " . $detalle . "?')"));
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
